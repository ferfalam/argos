<?php

namespace Modules\Zoom\DataTables\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Zoom\Entities\Meeting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OfflineMeetingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {

                //                if ($this->zoomSetting->meeting_app == 'in_app') {
                //                    $url = route('admin.zoom-meeting.startMeeting', $row->id);
                //                } else {
                //                    $url = $this->user->id == $row->created_by ? $row->start_link : $row->end_link;
                //                }

                $action = '<div class="btn-group dropdown m-r-10">
                <span aria-expanded="false" data-toggle="dropdown" class=" dropdown-toggle" type="button">
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                </span>
                <ul role="menu" class="dropdown-menu">';

                $action .= '<li>
                    <a href="javascript:;" onclick="getEventDetail(' . $row->idmeeting . ')" >
                        <i class="fa fa-eye"></i> ' . __('app.view') . '
                    </a>
                </li>';
                $action .= '<li>
                    <a href="' . route('admin.off-meeting.invite', $row->idmeeting) . '" >
                        <i class="fa fa-eye"></i> Invite
                    </a>
                </li>';

                if ($row->status == 'waiting') {
                    $nowDate = Carbon::now(company_setting()->timezone)->toDateString();
                    $meetingDate = $row->start_date_time->toDateString();


                    $action .= '<li>
                        <a href="javascript:;" class="cancel-meeting" data-meeting-id="' . $row->idmeeting . '" >
                            <i class="fa fa-times"></i> ' . __('zoom::modules.zoommeeting.cancelMeeting') . '
                        </a>
                    </li>';
                    $action .= '<li>
                        <a href="javascript:;" class="btnedit" data-id="' . $row->idmeeting . '"  >
                            <i class="fa fa-pencil"></i> ' . __('app.edit') . '
                        </a>
                    </li>';
                }

                if ($row->status == 'live') {
                    $action .= '<li>
                        <a href="javascript:;" class="end-meeting" data-meeting-id="' . $row->idmeeting . '" >
                            <i class="fa fa-stop"></i> ' . __('zoom::modules.zoommeeting.endMeeting') . '
                        </a>
                    </li>';
                }

                if ($row->status != 'live') {
                    $action .= '<li>
                        <a href="javascript:;" class="sa-params" data-occurrence="' . $row->occurrence_order . '" data-meeting-id="' . $row->idmeeting . '">
                            <i class="fa fa-trash"></i> ' . __('app.delete') . '
                        </a>
                    </li>';
                }

                $action .= '</ul></div>';

                return $action;
            })
            ->editColumn('meeting_id', function ($row) {
                $meetingId = $row->meeting_id;

                if (!is_null($row->occurrence_id)) {
                    $meetingId .= '<br><span class="text-muted">' . __('zoom::modules.zoommeeting.occurrence') . ' - ' . $row->occurrence_order . '</span>';
                }
                return $meetingId;
            })
            ->editColumn('meeting_name', function ($row) {
                return '<span style="width: 15px; height: 15px;"
                class="btn ' . $row->label_color . ' btn-small btn-circle">&nbsp;</span> <a href="javascript:;" onclick="getEventDetail(' . $row->id . ')">' . ucfirst($row->meeting_name) . '</a>';
            })
            ->editColumn('start_date_time', function ($row) {
                return $row->start_date_time->format(company_setting()->date_format . ' ' . company_setting()->time_format);
            })
            ->editColumn('end_date_time', function ($row) {
                return $row->end_date_time->format(company_setting()->date_format . ' ' . company_setting()->time_format);
            })
            ->editColumn('status', function ($row) {

                if ($row->status == 'waiting') {
                    $status = '<label class="label label-warning">' . __('zoom::modules.zoommeeting.waiting') . '</label>';
                } else if ($row->status == 'live') {
                    $status = '<i class="fa fa-circle Blink" style="color: red"></i> <span class="font-semi-bold">' . __('zoom::modules.zoommeeting.live') . '</span>';
                } else if ($row->status == 'canceled') {
                    $status = '<label class="label label-danger">' . __('app.canceled') . '</label>';
                } else if ($row->status == 'finished') {
                    $status = '<label class="label label-success">' . __('app.finished') . '</label>';
                }
                return $status;
            })
            ->rawColumns(['action', 'status', 'meeting_name', 'meeting_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Meeting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Meeting $model)
    {
        $id = Auth::id();
        $model->whereHas('user_has_meetings', function ($query) use ($id) {
            $query->where('users_id', $id);
        });
        $request = $this->request();
        if (request()->has('startDate') && $request->startDate != 0) {
            $startDate = Carbon::createFromFormat(company_setting()->date_format, $request->startDate)->toDateString();
            $model->whereDate('start_date_time', '>=', $startDate);
        }

        if (request()->has('endDate') && $request->endDate != 0) {
            $endDate = Carbon::createFromFormat(company_setting()->date_format, $request->endDate)->toDateString();
            $model->whereDate('end_date_time', '<=', $endDate);
        }

        if (request()->has('status') && $request->status != 'all') {
            if ($request->status == 'not finished') {
                $model->where('status', '<>', 'finished');
            } else {
                $model->where('status', $request->status);
            }
        }


        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('meeting-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            __('app.id') => ['data' => 'idmeeting', 'name' => 'idmeeting', 'visible' => false],
            '#' => ['data' => 'idmeeting', 'orderable' => false, 'searchable' => false],
            __('zoom::modules.meetings.meetingId') => ['data' => 'idmeeting', 'name' => 'idmeeting'],
            __('zoom::modules.meetings.meetingName') => ['data' => 'title', 'name' => 'title'],
            __('zoom::modules.meetings.startOn')  => ['data' => 'start_date_time', 'name' => 'start_date_time'],
            __('zoom::modules.meetings.endOn')  => ['data' => 'end_date_time', 'name' => 'end_date_time'],
            __('app.status') => ['data' => 'status', 'name' => 'status'],
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(150)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OfflineMeeting_' . date('YmdHis');
    }
}
