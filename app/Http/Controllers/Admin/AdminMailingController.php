<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Requests\StoreComposeRequest;
use App\Models\Message;
use App\Models\Messageuser;
use App\SubTaskFile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminMailingController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.mailing';
    $this->pageIcon = 'icon-people';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $usermessage = Messageuser::where('uid',auth()->user()->id)->where('status', 'direct')->get();
    return view('admin.mailing.index', $this->data)->with('messages',$usermessage);
  }

  public function getMessage(Message $message){
      return $message;
  }

  public function sent() {
      $messages = Message::where('from',auth()->user()->id)->where('status','Delivered')->orderBy('id', 'DESC')->get();
      return view('admin.mailing.sent', $this->data)->with('messages',$messages);
  }

  public function trashsentmessage(Request $request){
      foreach ($request->messages as $messageid){
          $message = Message::where('id',$messageid)->first();
          $message->status = "trash";
          $message->save();
      }
      return [
          'success'=>true
      ];
  }
  public function trashinboxmessage(Request $request){
      foreach ($request->messages as $messageid){
          $message = Messageuser::where('id',$messageid)->first();
          $message->status = "trash";
          $message->save();
      }
      return [
          'success'=>true
      ];
  }

  public function compose(){
      $this->to = User::where('users.company_id', company()->id)->get();
    return view('admin.mailing.compose', $this->data);
  }

  public function composesave(StoreComposeRequest $request){
//      return 'awa';
      $validated = $request->validated();
      $messages = new Message();
      $messages->subject = $validated['subject'];
      $messages->message = $validated['message'];
      $messages->from = auth()->user()->id;

//      dd($_FILES);
// array:1 [
//   "files" => array:5 [
//     "name" => "item-keymoment.png"
//     "type" => "image/png"
//     "tmp_name" => "/tmp/phpipbeeM"
//     "error" => 0
//     "size" => 978274
//   ]
// ]

//      dd($request->files->all());
//      if ($request->hasFile('attachment_file')) {
//          return 'awa';
          foreach ($request->files->all() as $fileData){
              $fileName = time().'_'.$request->file('attachment_file')->getClientOriginalName();
              $filePath = $request->file('attachment_file')->storeAs('uploads', $fileName, 'public');
//                  $filename = Files::uploadLocalOrS3($fileData, 'sub-task-files/' . $request->sub_task_id);

              $messages->attachment = '/storage/' . $filePath;
//                  $file->hashname = $filename;
//                  $file->size = $fileData->getSize();
//                  $file->save();
//          return 'awa';
          }
//      }
//      return 'awe na';
      $messages->status = 'Delivered';
      $messages->save();
      $messageusers = new Messageuser();
      $messageusers->mid = $messages->id;
      $messageusers->uid = $validated['to'];
      $messageusers->status = 'direct';
      $messageusers->save();
//      foreach ($request->cc as $user){
//          $messageusers = new Messageuser();
//          $messageusers->mid = $messages->id;
//          $messageusers->uid = $user;
//          $messageusers->status = 'cc';
//          $messageusers->save();
//      }
      return Redirect::to('admin/mailing/compose');
  }
}
