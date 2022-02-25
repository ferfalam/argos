<?php

namespace Modules\Zoom\DataTables\Admin;

use App\DataTables\BaseDataTable;
use Modules\Zoom\Entities\Room;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoomDataTable extends BaseDataTable
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
                $action = '<div class="btn-group dropdown m-r-10">
                <span aria-expanded="false" data-toggle="dropdown" class=" dropdown-toggle" type="button">
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                </span>
                <ul role="menu" class="dropdown-menu">';
                $action .= '<li>
                    <a href="javascript:;" class="btnedit" data-id="' . $row->idroom . '" >
                        <i class="fa fa-pencil"></i> ' . __('app.edit') . '
                    </a>
                </li>';
                $action .= '<li>
                    <a href="javascript:;" class="sa-params" data-occurrence="' . $row->occurrence_order . '" data-meeting-id="' . $row->idroom . '" >
                        <i class="fa fa-trash"></i> ' . __('app.delete') . '
                    </a>
                </li>';
                $action .= '</ul></div>';
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RoomDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model)
    {
        return $model->where('company_id', company()->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('roomdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
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
            Column::make('name'),
            Column::make('location'),
            Column::make('capacity'),
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Room_' . date('YmdHis');
    }
}
