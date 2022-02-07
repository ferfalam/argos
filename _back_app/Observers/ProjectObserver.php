<?php

namespace App\Observers;

use App\Events\NewProjectEvent;
use App\Project;
use App\UniversalSearch;
use Illuminate\Support\Facades\File;
use App\Notification;

class ProjectObserver
{

    public function saving(Project $project)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $project->company_id = company()->id;
        }
    }

    public function created(Project $project)
    {
        if (!isRunningInConsoleOrSeeding()) {
            //Send notification to user
            if ($project->client_id != null) {
                event(new NewProjectEvent($project));
            }
        }
    }

    public function deleting(Project $project)
    {
        File::deleteDirectory('user-uploads/project-files/' . $project->id);

        $universalSearches = UniversalSearch::where('searchable_id', $project->id)->where('module_type', 'project')->get();
        if ($universalSearches){
            foreach ($universalSearches as $universalSearch){
                UniversalSearch::destroy($universalSearch->id);
            }
        }
        $notifiData = ['App\Notifications\NewProject', 'App\Notifications\NewProjectMember', 'App\Notifications\ProjectReminder','App\Notifications\NewTask','App\Notifications\TaskComment','App\Notifications\TaskCommentClient','App\Notifications\TaskCompleted','App\Notifications\TaskCompletedClient','App\Notifications\TaskNote','App\Notifications\TaskNoteClient','App\Notifications\TaskReminder','App\Notifications\TaskUpdated','App\Notifications\TaskUpdatedClient','App\Notifications\SubTaskCompleted','App\Notifications\SubTaskCreated','App\Notifications\NewRating'];

        $notifications = Notification::
        whereIn('type', $notifiData)
            ->whereNull('read_at')
            ->whereJsonContains('data->id', $project->id )
            ->orwhereJsonContains('data->project_id', $project->id )
            ->delete();
    }

}
