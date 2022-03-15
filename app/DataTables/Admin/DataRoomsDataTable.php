<?php

namespace App\DataTables\Admin;

use App\DataRoom;
use App\DataTables\BaseDataTable;
use App\Payment;
use App\Project;
use App\ProjectCategory;
use App\User;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class DataRoomsDataTable extends BaseDataTable
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
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '<a target="_blank" href="'.$row->file()->file_url.'"
                            data-toggle="tooltip" data-original-title="View"
                            class="btn btn-info btn-circle"><i
                                    class="fa fa-search"></i></a>
                <a href="'.route("admin.task-files.download", $row->file()->id).'
                    data-toggle="tooltip" data-original-title="Download"
                    class="btn btn-inverse btn-circle"><i
                            class="fa fa-download"></i></a>';
                if (user()->isSupervisor(company()->supervisor_id)){
                    $action.=' <a href="javascript:;"
                        data-toggle="tooltip" data-original-title="Edit" data-doc-id="'.$row->id.'"
                        class="btn btn-warning btn-circle edit-doc"><i
                                class="fa fa-edit"></i></a>
                    <a href="javascript:;"
                        data-toggle="tooltip" data-original-title="Delete" data-doc-id="'.$row->id.'"
                        class="btn btn-danger btn-circle delete-doc"><i
                                class="fa fa-times"></i></a>';
                }
                return $action;
            })
            ->editColumn('project_name', function ($row) {
                return $row->project_name;
            })

            ->editColumn('task_name', function ($row) {
                return $row->task_name;
            })
            ->editColumn('doc_name', function ($row) {
                return $row->doc_name;
            })

            ->editColumn('created_at', function ($row) {
                return \Carbon\Carbon::parse($row->created_at)->format(company()->date_format);
            })
            ->editColumn('visible_by', function ($row) {
                if ($row->canSee() == ''){
                    return '<span></span>';
                }elseif ($row->canSee() == 'all')
                    return '<span>'.__("app.all").'</span>';
                else{
                    $res = "";
                    foreach ($row->canSee() as $cs){
                        $res.='<img src="'.$cs->image_url.'" style="width:30px; height:30px; border-radius: 50%;">';
                    }
                    return $res;
                }
            })
            ->editColumn('publish', function ($row) {
                $res = "";
                if ($row->publish) {
                    $res .= __('app.yes');
                } else {
                    $res.=__('app.no');
                }
                $temp = $row->publish_date ? \Carbon\Carbon::parse($row->publish_date)->format(company()->date_format) : '';
                return $res." || ".$temp;
            })
            ->rawColumns(['project_name', 'task_name', 'visible_by', 'publish', 'action']);
            // ->removeColumn('project_summary')
            // ->removeColumn('notes')
            // ->removeColumn('feedback')
            // ->removeColumn('start_date');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\DataRoom $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DataRoom $model)
    {

        $request = $this->request();

        $model = $model
            //->with('members', 'members.user', 'client', 'clientdetails', 'currency')
            ->leftJoin('espaces', 'espaces.id', 'data_rooms.espace_id')
            ->selectRaw('data_rooms.*, espaces.espace_name');

        if (!is_null($request->project) && $request->project != 'all') {
            $model->where('project_name', $request->project);
        }
        if (!is_null($request->publish) && $request->publish != 'all') {
            $model->where('publish', $request->publish);
        }
        if (!is_null($request->espace_id)) {
            $model->where('espace_id', $request->espace_id);
        }
        if (!user()->isSupervisor(company()->supervisor_id) || !User::isAdmin(user()->id)) {
            $model->where('visible_by', 'like', '%'.user()->id.'%')
            ->orWhere('visible_by', 'all');
        }
        // if (!is_null($request->start_date) && !is_null($request->end_date)) {
        //     $startDate = \Carbon\Carbon::parse($request->start_date)->format("Y-m-d");
        //     $endDate = \Carbon\Carbon::parse($request->end_date)->format("Y-m-d");
        //     Log::info(json_encode(array($startDate, $endDate)));
        //     $model->whereBetween('data_rooms.created_at', [$startDate, $endDate]);
        // }

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
            ->setTableId('projects-table')
            ->columns($this->processTitle($this->getColumns()))
            ->minifiedAjax()
            ->dom("<'row'<'col-md-6'l><'col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(0)
            ->destroy(true)
            ->responsive(true)
            ->serverSide(true)
            ->stateSave(true)
            ->processing(true)
            ->language(__('app.datatable'))
            ->buttons(
                Button::make(['extend' => 'export', 'buttons' => ['excel', 'csv'], 'text' => '<i class="fa fa-download"></i> ' . trans('app.exportExcel') . '&nbsp;<span class="caret"></span>'])
            )
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["projects-table"].buttons().container()
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
            __('app.id') => ['data' => 'id', 'name' => 'id', 'visible' => false, 'exportable' => false],
            //'#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            __('app.created_at') => ['data' => 'created_at', 'name' => 'created_at'],
            __('app.documentName') => ['data' => 'doc_name', 'name' => 'doc_name'],
            __('modules.projects.projectName') => ['data' => 'project_name', 'name' => 'project_name'],
            __('app.taskName') => ['data' => 'task_name', 'name' => 'task_name'],
            __('app.visibility') => ['data' => 'visible_by', 'name' => 'visible_by'],
            __('app.publication')."||". __('app.date') => ['data' => 'publish', 'name' => 'publish'],
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
        return 'DataRooms_' . date('YmdHis');
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
