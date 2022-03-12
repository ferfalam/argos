@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.spv.edit',$spvDetails->id) }}"  classes="btn btn-cs-blue" icon="fa fa-edit" title="modules.lead.edit"/>
    </x-slot>
</x-main-header>
@endsection


@section('content')

    @include('admin.spv.spv_header')
    
    @include('admin.spv.tabs')

    <x-tab-container title="modules.employees.profile">
        <table>
            
            <tr>
                <td><strong>@lang('app.email')</strong></td>
                <td>{{ $spvDetails->email }}</td>
            </tr>
            <tr>
                <td><strong>@lang('app.mobile')</strong></td>
                <td><span class="color-primary">{{ $spvDetails->mobile ? $spvDetails->mobile : '-'}}</span></td>
            </tr>
            <tr>
                <td><strong>@lang('modules.client.companyName')</strong></td>
                <td>{{ (!empty($spvDetails) ) ? ucwords($spvDetails->company_name) : '-'}}</td>
            </tr>
            
            {{-- <tr>
                <td><strong>@lang('modules.client.website')</strong></td>
                <td>{{ $spvDetails->website ?? '-' }}</td>
            </tr> --}}

            {{-- <tr>
                <td><strong>@lang('app.gstNumber')</strong></td>
                <td>{{ $spvDetails->gst_number ?? '-' }}</td>
            </tr> --}}

            <tr>
                <td><strong>@lang('app.address')</strong></td>
                <td>{!!  (!empty($spvDetails)) ? ucwords($spvDetails->address) : '-' !!}</td>
            </tr>

            {{-- <tr>
                <td><strong>@lang('app.shippingAddress')</strong></td>
                <td>{{ $spvDetails->shipping_address ?? '-' }}</td>
            </tr> --}}

            @if($spvDetails->category_id != null)
            <tr>
                <td><strong>@lang('modules.clients.clientCategory')</strong></td>
                <td>{{ $spvDetails->clientCategory->category_name }}</td>
            </tr>
            @endif

            @if($spvDetails->sub_category_id != null)
            <tr>
                <td><strong>@lang('modules.clients.clientSubCategory')</strong></td>
                <td>{{ $spvDetails->clientSubcategory->category_name }}</td>
            </tr>
            @endif

            {{-- <tr>
                <td><strong>@lang('app.note')</strong></td>
                <td>{{ $spvDetails->note }}</td>
            </tr> --}}

            <tr>
                <td><strong>@lang('app.name_ucfirst')</strong></td>
                <td>{{ $spvDetails->company_name }}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.country')</strong></td>
                <td>{{ $country->name }}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.city')</strong></td>
                <td>{{ $spvDetails->city }}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.observation')</strong></td>
                <td>{{ $spvDetails->description }}</td>
            </tr>

            {{-- <tr>
                <td><strong>@lang('app.email')</strong></td>
                <td>{{ $spvDetails->email}}</td>
            </tr> --}}

            {{-- <tr>
                <td><strong>@lang('app.civility')</strong></td>
                <td>{{ $spvDetails->gender }}</td>
            </tr>--}}

            <tr>
                <td><strong>@lang('app.tel')</strong></td>
                <td>{{ $spvDetails->tel }} </td>
            </tr>
           
            <tr>
                <td><strong>@lang('app.mobile')</strong></td>
                <td>{{ $spvDetails->mobile }}</td>
            </tr>

            <tr>
                <td><strong>Fax</strong></td>
                <td>{{ $spvDetails->fax }}</td>
            </tr>

            <!-- <tr>
                <td><strong>@lang('app.category')</strong></td>
                <td>{{ $category-> category_name}}</td>
            </tr>

            <tr>
                <td><strong>@lang('app.subCategory')</strong></td>
                <td>{{ $sub_category->category_name}}</td>
            </tr> -->

            <tr>
                <td><strong>@lang('app.langue')</strong></td>
                <td>{{ $language->language_name}}</td>
            </tr>
{{-- 
            <tr>
                <td><strong>Function</strong></td>
                <td>{{ $spvDetails->function}}</td>
            </tr> --}}

            <tr>
                <td><strong>Notification Par Mail</strong></td>
                @if($spvDetails->email_notifications == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
            </tr>

            <tr>
                <td><strong>Notification Par SMS</strong></td>
                @if($spvDetails->sms_notification == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
            </tr>


            @if(isset($fields))
                @foreach($fields as $field)
                    <tr class="col-md-4">
                        <td><strong>{{ ucfirst($field->label) }}</strong></td>
                        <td>
                            @if( $field->type == 'text')
                                {{$spvDetails->custom_fields_data['field_'.$field->id] ?? '-'}}
                            @elseif($field->type == 'password')
                                {{$spvDetails->custom_fields_data['field_'.$field->id] ?? '-'}}
                            @elseif($field->type == 'number')
                                {{$spvDetails->custom_fields_data['field_'.$field->id] ?? '-'}}

                            @elseif($field->type == 'textarea')
                                {{$spvDetails->custom_fields_data['field_'.$field->id] ?? '-'}}

                            @elseif($field->type == 'radio')
                                {{ !is_null($spvDetails->custom_fields_data['field_'.$field->id]) ? $spvDetails->custom_fields_data['field_'.$field->id] : '-' }}
                            @elseif($field->type == 'select')
                                {{ (!is_null($spvDetails->custom_fields_data['field_'.$field->id]) && $spvDetails->custom_fields_data['field_'.$field->id] != '') ? $field->values[$spvDetails->custom_fields_data['field_'.$field->id]] : '-' }}
                            @elseif($field->type == 'checkbox')
                            <ul>
                                @foreach($field->values as $key => $value)
                                    @if($spvDetails->custom_fields_data['field_'.$field->id] != '' && in_array($value ,explode(', ', $spvDetails->custom_fields_data['field_'.$field->id]))) <li>{{$value}}</li> @endif
                                @endforeach
                            </ul>
                            @elseif($field->type == 'date')
                                {{ \Carbon\Carbon::parse($spvDetails->custom_fields_data['field_'.$field->id])->format($global->date_format)}}
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
