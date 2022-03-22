<?php

namespace Modules\Zoom\DataTables\Member;

use App\DataTables\BaseDataTable;
use App\User;
use Carbon\Carbon;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Entities\ZoomSetting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class MeetingDataTable extends BaseDataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->zoomSetting = ZoomSetting::where('user_id', user()->id)->first();
    }

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
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if ($this->user->id == $row->created_by) {
                    if ($this->zoomSetting->meeting_app == 'in_app') {
                        $url = route('admin.zoom-meeting.startMeeting', $row->id);
                    } else {
                        $url = $row->start_link;
                    }
                } else {
                    $url = $row->join_link;
                }

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button">
                    <i class="fa fa-gears "></i>
                </button>
                <ul role="menu" class="dropdown-menu">';

                $action .= '<li>
                    <a href="javascript:;" onclick="getEventDetail(' . $row->id . ')" >
                        <i class="fa fa-eye"></i> ' . __('app.view') . '
                    </a>
                </li>';

                if ($row->created_by == user()->id) {
                    $action .= '<li>
                        <a href="javascript:;" class="btnedit" data-id="' . $row->id . '"  >
                            <i class="fa fa-pencil"></i> ' . __('app.edit') . '
                        </a>
                    </li>';
                }


                if ($row->status == 'waiting' && !$row->end_date_time->lt(Carbon::now())) {
                    $nowDate = Carbon::now(company_setting()->timezone)->toDateString();
                    $meetingDate = $row->start_date_time->toDateString();
                    if ($row->created_by == user()->id) {
                        $action .= '<li>
                            <a href="' . route('member.zoom-meeting.invite', $row->id) . '" >
                                <i class="fa fa-eye"></i> Invite
                            </a>
                            </li>';
                        if (is_null($row->occurrence_id) || $nowDate == $meetingDate) {
                            $action .= '<li>
                                <a target="_blank" href="' . $url . '" >
                                    <i class="fa fa-play"></i> ' . __('zoom::modules.zoommeeting.startUrl') . '
                                </a>
                            </li>';
                        }
                        $action .= '<li>
                            <a href="javascript:;" class="cancel-meeting" data-meeting-id="' . $row->id . '" >
                                <i class="fa fa-times"></i> ' . __('zoom::modules.zoommeeting.cancelMeeting') . '
                            </a>
                        </li>';
                    }
                }

                if ($row->status == "finished") {
                    if ($row->created_by == $this->user->id) {
                        $action .= '<li>
                            <a href="javascript:;" class="btnedit" data-id="' . $row->id . '"  >
                                <i class="fa fa-pencil"></i> ' . __('app.edit') . '
                            </a>
                        </li>';
                    }
                }

                if ($row->status == 'live') {
                    if ($row->created_by == $this->user->id) {
                        $action .= '<li>
                            <a href="javascript:;" class="end-meeting" data-meeting-id="' . $row->id . '" >
                                <i class="fa fa-stop"></i> ' . __('zoom::modules.zoommeeting.endMeeting') . '
                            </a>
                        </li>';
                    }else{
                        $action .= '<li>
                            <a target="_blank" href="' . $url . '" >
                                <i class="fa fa-play"></i> Rejoindre
                            </a>
                        </li>';
                    }
                }

                if ($row->status != 'live') {
                    if ($row->created_by == $this->user->id) {
                        $action .= '<li>
                            <a href="javascript:;" class="sa-params" data-occurrence="' . $row->occurrence_order . '" data-meeting-id="' . $row->id . '">
                                <i class="fa fa-trash"></i> ' . __('app.delete') . '
                            </a>
                        </li>';
                    }
                }

                $action .= '</ul></div>';

                return $action;
            })
            ->editColumn('created_by', function ($row) {
                $host = User::find($row->created_by);
                return '<img data-toggle="tooltip" data-placement="right" data-original-title="' . $host->name . '" src="' . $host->image_url . '"
                                alt="user" class="img-circle" width="25" height="25"> ';
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
            })->editColumn('duree', function ($row) {
                if ($row->status == 'waiting') {
                    if ($row->end_date_time->lt(Carbon::now())) {
                        return  '00 : 00';
                    }
                }
                return $row->duree;
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'waiting') {
                    if ($row->end_date_time->lt(Carbon::now())) {
                        return  '<label class="label label-success">' . __('app.finished') . '</label>';
                    }

                    if ($row->invite) {
                        return  '<label class="label label-success">Confirmé</label>';
                    }else{
                        return  '<label class="label label-warning">'.__('zoom::modules.zoommeeting.waiting').'</label>';
                    }
                    // if ($row->attendees) {
                    //     return  '<label class="label label-info">Confirmé</label>';
                    // }
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
            ->rawColumns(['action', 'status', 'meeting_name', 'meeting_id', 'created_by']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ZoomMeeting $model)
    {
        $request = $this->request();
        $model = $model->select('id', 'meeting_id', 'created_by', 'meeting_name', 'start_date_time', 'end_date_time', 'start_link', 'join_link', 'status', 'label_color', 'occurrence_id', 'source_meeting_id', 'occurrence_order', 'duree', 'invite')
        ->whereHas('attendees', function ($query) {
            //if (!user()->cans('view_zoom_meetings')) {
                return $query->where('user_zoom_meeting.user_id', user()->id);
            //}
        });
        if (request()->has('startDate') && $request->startDate != 0) {
            $startDate = Carbon::createFromFormat($this->global->date_format, $request->startDate)->toDateString();
            $model->whereDate('start_date_time', '>=', $startDate);
        }
        
        if (request()->has('endDate') && $request->endDate != 0) {
            $endDate = Carbon::createFromFormat($this->global->date_format, $request->endDate)->toDateString();
            $model->whereDate('end_date_time', '<=', $endDate);
        }
        
        if (request()->has('status') && $request->status != 'all') {
            if ($request->status == 'not finished') {
                $model->where('status', '<>', 'finished');
            } else {
                $model->where('status', $request->status);
            }
        }
        if (request()->has('category') && $request->category != 0) {   
            $model->whereHas('category', function ($query)use($request) {
                return $query->where('id',  $request->category);
               
            });
        }
        if (request()->has('project') && $request->project != 0) {   
            $model->whereHas('project', function ($query)use($request) {
                return $query->where('id',  $request->project);
               
            });
        }
        return $model;
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
            ->dom("<'row'<'col-md-6'l><'col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(0)
            ->destroy(true)
            ->responsive(true)
            ->serverSide(true)
            ->processing(true)
            ->language(__("app.datatable"))
            ->buttons(
                Button::make(['extend' => 'export', 'buttons' => ['excel', 'csv'], 'text' => '<i class="fa fa-download"></i> ' . trans('app.exportExcel') . '&nbsp;<span class="caret"></span>'])
            )
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["meeting-table"].buttons().container()
                    .appendTo( ".bg-title .text-right")
                }',
                'fnDrawCallback' => 'function( oSettings ) {
                    $("body").tooltip({
                        selector: \'[data-toggle="tooltip"]\'
                    })
                }',
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            __('app.id') => ['data' => 'id', 'name' => 'id', 'visible' => false],
            //'#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            __('zoom::modules.zoommeeting.meetingHost') => ['data' => 'created_by', 'name' => 'created_by'],
            __('zoom::modules.meetings.meetingId') => ['data' => 'meeting_id', 'name' => 'meeting_id'],
            __('zoom::modules.meetings.meetingName') => ['data' => 'meeting_name', 'name' => 'meeting_name'],
            __('zoom::modules.meetings.startOn')  => ['data' => 'start_date_time', 'name' => 'start_date_time'],
            __('zoom::modules.meetings.endOn')  => ['data' => 'end_date_time', 'name' => 'end_date_time'],
            __('zoom::modules.meetings.duree')  => ['data' => 'duree', 'name' => 'duree'],
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
        return 'Tickets_' . date('YmdHis');
    }

    public function pdf()
    {
        set_time_limit(0);
        if ('snappy' == config('datatables-buttons.pdf_generator', 'snappy')) {
            return $this->snappyPdf();
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('datatables::print', ['data' => $this->getDataForPrint()]);

        return $pdf->download($this->getFilename() . '.pdf');
    }
}
