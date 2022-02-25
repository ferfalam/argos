@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.clients.edit',$clientDetail->id) }}"  classes="btn btn-cs-blue" icon="fa fa-edit" title="modules.lead.edit"/>
    </x-slot>
</x-main-header>
@endsection


@section('content')

    @include('admin.clients.client_header')
    
    @include('admin.clients.tabs')

    <x-tab-container title="modules.employees.profile">
        <table>
            <tr>
                <td><strong>@lang('modules.employees.fullName')</strong></td>
                <td>{{ ucwords($clientDetail->name) }}</td>
            </tr>
            <tr>
                <td><strong>@lang('app.email')</strong></td>
                <td>{{ $clientDetail->email }}</td>
            </tr>
            <tr>
                <td><strong>@lang('app.mobile')</strong></td>
                <td><span class="color-primary">{{ $clientDetail->mobile ? $clientDetail->mobile : '-'}}</span></td>
            </tr>
            <tr>
                <td><strong>@lang('modules.client.companyName')</strong></td>
                <td>{{ (!empty($clientDetail) ) ? ucwords($clientDetail->company_name) : '-'}}</td>
            </tr>
            
            <tr>
                <td><strong>@lang('modules.client.website')</strong></td>
                <td>{{ $clientDetail->website ?? '-' }}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.gstNumber')</strong></td>
                <td>{{ $clientDetail->gst_number ?? '-' }}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.address')</strong></td>
                <td>{!!  (!empty($clientDetail)) ? ucwords($clientDetail->address) : '-' !!}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.shippingAddress')</strong></td>
                <td>{{ $clientDetail->shipping_address ?? '-' }}</td>
            </tr>

            @if($clientDetail->category_id != null)
            <tr>
                <td><strong>@lang('modules.clients.clientCategory')</strong></td>
                <td>{{ $clientDetail->clientCategory->category_name }}</td>
            </tr>
            @endif

            @if($clientDetail->sub_category_id != null)
            <tr>
                <td><strong>@lang('modules.clients.clientSubCategory')</strong></td>
                <td>{{ $clientDetail->clientSubcategory->category_name }}</td>
            </tr>
            @endif

            <tr>
                <td><strong>@lang('app.note')</strong></td>
                <td>{{ $clientDetail->note }}</td>
            </tr>

            @if(isset($fields))
                @foreach($fields as $field)
                    <tr class="col-md-4">
                        <td><strong>{{ ucfirst($field->label) }}</strong></td>
                        <td>
                            @if( $field->type == 'text')
                                {{$clientDetail->custom_fields_data['field_'.$field->id] ?? '-'}}
                            @elseif($field->type == 'password')
                                {{$clientDetail->custom_fields_data['field_'.$field->id] ?? '-'}}
                            @elseif($field->type == 'number')
                                {{$clientDetail->custom_fields_data['field_'.$field->id] ?? '-'}}

                            @elseif($field->type == 'textarea')
                                {{$clientDetail->custom_fields_data['field_'.$field->id] ?? '-'}}

                            @elseif($field->type == 'radio')
                                {{ !is_null($clientDetail->custom_fields_data['field_'.$field->id]) ? $clientDetail->custom_fields_data['field_'.$field->id] : '-' }}
                            @elseif($field->type == 'select')
                                {{ (!is_null($clientDetail->custom_fields_data['field_'.$field->id]) && $clientDetail->custom_fields_data['field_'.$field->id] != '') ? $field->values[$clientDetail->custom_fields_data['field_'.$field->id]] : '-' }}
                            @elseif($field->type == 'checkbox')
                            <ul>
                                @foreach($field->values as $key => $value)
                                    @if($clientDetail->custom_fields_data['field_'.$field->id] != '' && in_array($value ,explode(', ', $clientDetail->custom_fields_data['field_'.$field->id]))) <li>{{$value}}</li> @endif
                                @endforeach
                            </ul>
                            @elseif($field->type == 'date')
                                {{ \Carbon\Carbon::parse($clientDetail->custom_fields_data['field_'.$field->id])->format($global->date_format)}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </x-tab-container>

@endsection

@push('footer-script')
    <script>
        $('ul.showClientTabs .clientProfile').addClass('tab-current');
    </script>
@endpush
