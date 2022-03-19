@extends('layouts.mailing')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle)
    </x-slot>

    {{-- <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.projects.create') }}" classes="btn btn-cs-blue" icon="fa fa-plus"
            title="app.createProject" />
    </x-slot> --}}
</x-main-header>
@endsection

@push('head-script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterange-picker/daterangepicker.css') }}" />
<link rel="stylesheet" href="{{asset('vendor/font-awesome/css/all.min.css')}}">

<style>
    .col-md-3,
    .col-sm-6,
    .col-md-9 {
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    @media (min-width: 768px) {
        .col-sm-6 {
            float: left;
        }

        .col-sm-6 {
            width: 50%;
        }
    }

    @media (min-width: 992px) {

        .col-md-3,
        .col-md-9 {
            float: left;
        }

        .col-md-9 {
            width: 75%;
        }

        .col-md-3 {
            width: 25%;
        }
    }

    table {
        background-color: transparent;
    }

    th {
        text-align: left;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .table>thead>tr>th,
    .table>tbody>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .table>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }

    .table>thead:first-child>tr:first-child>th {
        border-top: 0;
    }

    .table-condensed>thead>tr>th,
    .table-condensed>tbody>tr>td {
        padding: 5px;
    }

    .table-hover>tbody>tr:hover {
        background-color: #f5f5f5;
    }

    .table-responsive {
        min-height: 0.01%;
        overflow-x: auto;
    }

    @media screen and (max-width: 767px) {
        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            border: 1px solid #ddd;
        }

        .table-responsive>.table {
            margin-bottom: 0;
        }

        .table-responsive>.table>thead>tr>th,
        .table-responsive>.table>tbody>tr>td {
            white-space: nowrap;
        }
    }

    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="search"] {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    input[type="checkbox"] {
        margin: 4px 0 0;
        margin-top: 1px \9;
        line-height: normal;
    }

    input[type="checkbox"]:focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: var(--color-white);
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
        -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }

    .form-control:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }

    .form-control::-moz-placeholder {
        color: #999;
        opacity: 1;
    }

    .form-control:-ms-input-placeholder {
        color: #999;
    }

    .form-control::-webkit-input-placeholder {
        color: #999;
    }

    .form-control::-ms-expand {
        background-color: transparent;
        border: 0;
    }

    input[type="search"] {
        -webkit-appearance: none;
    }

    @media (min-width: 768px) {
        .form-inline .form-control {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .btn:focus,
    .btn:active:focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .btn:hover,
    .btn:focus {
        color: #333;
        text-decoration: none;
    }

    .btn:active {
        background-image: none;
        outline: 0;
        -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    }

    .btn-default {
        color: #333;
        background-color: var(--color-white);
        border-color: #ccc;
    }

    .btn-default:focus {
        color: #333;
        background-color: #e6e6e6;
        border-color: #8c8c8c;
    }

    .btn-default:hover {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }

    .btn-default:active {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }

    .btn-default:active:hover,
    .btn-default:active:focus {
        color: #333;
        background-color: #d4d4d4;
        border-color: #8c8c8c;
    }

    .btn-default:active {
        background-image: none;
    }

    .btn-danger {
        color: var(--color-white);
        background-color: #d9534f;
        border-color: #d43f3a;
    }

    .btn-danger:focus {
        color: var(--color-white);
        background-color: #c9302c;
        border-color: #761c19;
    }

    .btn-danger:hover {
        color: var(--color-white);
        background-color: #c9302c;
        border-color: #ac2925;
    }

    .btn-danger:active {
        color: var(--color-white);
        background-color: #c9302c;
        border-color: #ac2925;
    }

    .btn-danger:active:hover,
    .btn-danger:active:focus {
        color: var(--color-white);
        background-color: #ac2925;
        border-color: #761c19;
    }

    .btn-danger:active {
        background-image: none;
    }

    .btn-block {
        display: block;
        width: 100%;
    }

    .btn-group {
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }

    .btn-group>.btn {
        position: relative;
        float: left;
    }

    .btn-group>.btn:hover,
    .btn-group>.btn:focus,
    .btn-group>.btn:active {
        z-index: 2;
    }

    .btn-group .btn+.btn {
        margin-left: -1px;
    }

    .btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {
        border-radius: 0;
    }

    .btn-group>.btn:first-child {
        margin-left: 0;
    }

    .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .btn-group>.btn:last-child:not(:first-child) {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }

    .nav>li {
        position: relative;
        display: block;
    }

    .nav>li>a {
        position: relative;
        display: block;
        padding: 10px 15px;
    }

    .nav>li>a:hover,
    .nav>li>a:focus {
        text-decoration: none;
        background-color: #eee;
        border-radius: 5px;
    }

    .nav-pills>li {
        float: left;
    }

    .nav-pills>li>a {
        border-radius: 4px;
    }

    .nav-pills>li+li {
        margin-left: 2px;
    }

    .nav-pills>li.active>a,
    .nav-pills>li.active>a:hover,
    .nav-pills>li.active>a:focus {
        color: var(--color-white);
        background-color: #337ab7;
    }

    .nav-stacked>li {
        float: none;
    }

    .nav-stacked>li+li {
        margin-top: 2px;
        margin-left: 0;
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: var(--color-white);
        border: 1px solid #ddd;
    }

    .pagination>li:first-child>a {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .pagination>li:last-child>a {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .pagination>li>a:hover,
    .pagination>li>a:focus {
        z-index: 2;
        color: #23527c;
        background-color: #eee;
        border-color: #ddd;
    }

    .pagination>.disabled>a,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>a:focus {
        color: #777;
        cursor: not-allowed;
        background-color: var(--color-white);
        border-color: #ddd;
    }

    .label {
        display: inline;
        padding: 0.2em 0.6em 0.3em;
        font-size: 75%;
        font-weight: bold;
        line-height: 1;
        color: var(--color-white);
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;
    }

    .label:empty {
        display: none;
    }

    /* .panel {
        margin-bottom: 20px;
        background-color: var(--color-white);
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    } */

    /* .panel-body {
        padding: 15px;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        color: inherit;
    } */

    .row:before,
    .row:after,
    .nav:before,
    .nav:after,
    .panel-body:before,
    .panel-body:after {
        display: table;
        content: " ";
    }

    .row:after,
    .nav:after,
    .panel-body:after {
        clear: both;
    }

    .pull-right {
        float: right !important;
    }

    /*! CSS Used from: http://localhost/SMS/assets/vendor/font-awesome/css/all.min.css */
    .fa,
    .far,
    .fas {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
    }

    .fa-bell:before {
        content: "\f0f3";
    }

    .fa-chevron-left:before {
        content: "\f053";
    }

    .fa-chevron-right:before {
        content: "\f054";
    }

    .fa-columns:before {
        content: "\f0db";
    }

    .fa-copy:before {
        content: "\f0c5";
    }

    .fa-envelope:before {
        content: "\f0e0";
    }

    .fa-file-alt:before {
        content: "\f15c";
    }

    .fa-file-excel:before {
        content: "\f1c3";
    }

    .fa-file-pdf:before {
        content: "\f1c1";
    }

    .fa-print:before {
        content: "\f02f";
    }

    .fa-share-square:before {
        content: "\f14d";
    }

    .fa-sync:before {
        content: "\f021";
    }

    .fa-trash-alt:before {
        content: "\f2ed";
    }

    .far {
        font-weight: 400;
    }

    .fa,
    .far,
    .fas {
        font-family: "Font Awesome 5 Free";
    }

    .fa,
    .fas {
        font-weight: 900;
    }

    /*! CSS Used from: http://localhost/SMS/assets/vendor/datatables/media/css/dataTables.bootstrap.min.css */
    table.dataTable {
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }

    table.dataTable td,
    table.dataTable th {
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
    }

    table.dataTable td.dataTables_empty {
        text-align: center;
    }

    div.dataTables_wrapper div.dataTables_filter {
        text-align: right;
    }

    div.dataTables_wrapper div.dataTables_filter label {
        font-weight: normal;
        white-space: nowrap;
        text-align: left;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin: 0;
        white-space: nowrap;
        text-align: right;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin: 2px 0;
        white-space: nowrap;
    }

    table.dataTable thead>tr>th:active {
        outline: none;
    }

    @media screen and (max-width: 767px) {

        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_paginate {
            text-align: center;
        }
    }

    table.dataTable.table-condensed>thead>tr>th {
        padding-right: 20px;
    }

    /*! CSS Used from: http://localhost/SMS/assets/vendor/magnific-popup/magnific-popup.css */
    button::-moz-focus-inner {
        padding: 0;
        border: 0;
    }

    /*! CSS Used from: http://localhost/SMS/assets/css/skins/default.css */
    a {
        color: var(--color-blue);
    }

    a:hover,
    a:focus {
        color: var(--color-blue-light);
    }

    a:active {
        color: var(--color-blue-dark);
    }

    body .btn-danger {
        color: var(--color-white);
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        background-color: var(--color-red);
        border-color: var(--color-red);
    }

    body .btn-danger:hover {
        border-color: var(--color-red-light) !important;
        background-color: var(--color-red-light);
    }

    body .btn-danger:active,
    body .btn-danger:focus {
        border-color: var(--color-red-dark) !important;
        background-color: var(--color-red-dark);
    }

    .form-control:focus {
        border-color: var(--color-blue-border);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(0, 136, 204, 0.3);
    }

    .nav-pills>.active a,
    .nav-pills>.active a:hover,
    .nav-pills>.active a:focus {
        background-color: var(--color-yellow);
    }

    .pagination>li a {
        color: var(--color-yellow);
    }

    .pagination>li a:hover,
    .pagination>li a:focus {
        color: var(--color-blue-light);
    }

    /*! CSS Used from: http://localhost/SMS/assets/css/custom-style.css */
    a {
        color: #ccc;
    }

    a:hover,
    a:focus {
        color: #d9d9d9;
    }

    a:active {
        color: #bfbfbf;
    }

    @media screen and (max-width: 991px) {
        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            border: 1px solid #ddd;
        }

        .table-responsive>.table {
            margin-bottom: 0;
        }

        .table-responsive>.table>thead>tr>th,
        .table-responsive>.table>tbody>tr>td {
            white-space: nowrap;
        }
    }

    h3 {
        letter-spacing: -1px;
    }

    h3 {
        font-size: 2.4rem;
    }

    h4 {
        font-size: 1.8rem;
    }

    input {
        outline: none;
    }

    label {
        font-weight: normal;
    }

    body a,
    body a:focus,
    body a:hover,
    body a:active,
    body a:visited {
        outline: none !important;
    }

    ul {
        margin-bottom: 0;
        padding-left: 27px;
    }

    .text-dark {
        color: var(--color-black) !important;
    }

    .text-weight-normal {
        font-weight: 400;
    }

    .mb-none {
        margin-bottom: 0 !important;
    }

    .mb-xs {
        margin-bottom: 5px !important;
    }

    .mb-md {
        margin-bottom: 15px !important;
    }

    input[type="search"] {
        -webkit-appearance: none;
    }

    .form-control::-webkit-input-placeholder,
    input[type="search"]::-webkit-input-placeholder {
        color: #bdbdbd;
    }

    .form-control::-moz-placeholder,
    input[type="search"]::-moz-placeholder {
        color: #bdbdbd;
    }

    .form-control:-ms-input-placeholder,
    input[type="search"]:-ms-input-placeholder {
        color: #bdbdbd;
    }

    .form-control:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }

    .checkbox-replace .i-checks {
        padding-left: 20px;
        cursor: pointer;
        margin-bottom: 0;
    }

    .checkbox-replace .i-checks input {
        position: absolute;
        margin-left: -20px;
        opacity: 0;
    }

    .checkbox-replace .i-checks>i {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-top: -2px;
        margin-right: 4px;
        margin-left: -20px;
        line-height: 1;
        vertical-align: middle;
        background-color: transparent;
        border: 1px solid #cfdadd;
        -webkit-transition: all 0.2s;
        transition: all 0.2s;
    }

    .checkbox-replace .i-checks>i:before {
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 10px;
        height: 10px;
        background-color: var(--color-yellow);
        -webkit-transform: scale(0);
        -moz-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
        -webkit-transition: all 0.2s;
        transition: all 0.2s;
    }

    .checkbox-replace .i-checks input:checked+i {
        border-color: var(--color-yellow);
    }

    .checkbox-replace .i-checks input:checked+i:before {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .checkbox-replace .i-checks input:disabled+i {
        cursor: not-allowed;
        border-color: #dee5e7;
    }

    .checkbox-replace .i-checks input:disabled+i:before {
        background-color: #dee5e7;
    }

    body .btn:focus,
    body .btn:active:focus {
        outline: none;
    }

    body .btn {
        white-space: normal;
        transition: 0.3s;
    }

    body .btn-danger {
        border-color: var(--color-red);
        background-color: var(--color-red);
        border-color: var(--color-red) var(--color-red) #a82824;
        color: var(--color-white);
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    }

    body .btn-danger:hover {
        border-color: #d74742;
        background-color: #d74742;
        color: var(--color-white);
    }

    body .btn-danger:active,
    body .btn-danger:focus {
        border-color: var(--color-red-dark);
        background-color: var(--color-red-dark);
        color: var(--color-white);
    }

    .nav-pills>.active a,
    .nav-pills>.active a:hover,
    .nav-pills>.active a:focus {
        background-color: #ccc;
    }

    .pagination>li a {
        color: #ccc;
    }

    .pagination>li a:hover,
    .pagination>li a:focus {
        color: #d9d9d9;
    }

    /* .panel {
        background-color: #fdfdfd;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-color: #d1d1d1;
        border-radius: 5px;
    } */

    /* .panel-heading {
        background: #f6f6f6;
        border-radius: 5px 5px 0 0;
        position: relative;
        border-bottom: 2px solid var(--color-yellow);
    }

    .panel-title {
        color: #33353f;
        font-weight: 400;
        line-height: 20px;
        padding: 0;
        text-transform: none;
        font-size: 17px;
    }

    .panel-body {
        background: #fdfdfd;
        -webkit-box-shadow: none;
        border-radius: 5px;
    }

    .panel-heading+.panel-body {
        border-radius: 0 0 5px 5px;
    } */

    .table {
        width: 100%;
    }

    .table.mb-none {
        margin-bottom: 0 !important;
    }

    .table>thead>tr>th {
        background-color: #eee;
    }

    .table tr th {
        font-weight: 600 !important;
    }

    .dataTables_wrapper {
        position: relative;
        padding: 0;
        margin: 0;
    }

    .table>thead>tr>th {
        vertical-align: top !important;
    }

    table.dataTable.table-condensed>thead>tr>th {
        padding-right: 8px !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
        margin: 0 !important;
    }

    .dataTables_wrapper .pagination {
        margin-top: 13px !important;
    }

    .dataTables_wrapper .dataTables_filter label {
        width: 50%;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 100% !important;
    }

    @media only screen and (max-width: 991px) {
        .dataTables_wrapper .dataTables_filter label {
            width: 100% !important;
        }
    }

    .dataTables_wrapper .dataTables_empty {
        padding: 50px 0;
    }

    /*! CSS Used from: http://localhost/SMS/assets/css/ramom.css */
    .mailbox .nav-pills>li>a {
        border-left: 3px solid transparent;
        color: #717171;
    }

    .mailbox .nav-pills>li>a:hover,
    .mailbox .nav-pills>li>a:focus {
        background: #f2f7f8;
        border-left-color: var(--color-yellow);
        color: #747d8a;
    }

    .mailbox .nav-pills>li.active>a,
    .mailbox .nav-pills>li.active>a:hover,
    .mailbox .nav-pills>li.active>a:focus {
        background: #e7eaea;
        border-left: 3px solid var(--color-yellow);
        color: #747d8a;
    }

    .mailbox .nav-pills a .label {
        font-weight: normal;
        font-size: 1.1rem;
        padding: 0.3em 0.7em 0.4em;
        margin: 0.2em 0.3em 0 0;
        background: var(--color-yellow);
    }

    .btn-circle {
        padding: 5px 13px;
        font-size: 13px;
        line-height: 1.4;
        text-align: center;
        border-radius: 500px;
        height: 29px;
        min-width: 29px;
        margin: 0 1.6px;
    }

    .btn-circle.icon {
        padding: 5px 6px !important;
    }

    .dataTables_wrapper table thead th {
        padding-right: 8px !important;
    }

    .panel-btn {
        float: right !important;
        position: absolute;
        right: 13px;
        top: 5px;
    }

    .dt-buttons {
        display: flex !important;
    }

    .dataTables_filter {
        display: block !important;
    }

    .table-responsive {
        width: 100%;
    }

    .dt-buttons .btn {
        color: #555;
        border: 0;
        border-bottom: 1px solid #d8d8d8;
        border-radius: 0;
        margin: 4px;
        padding: 5px 10px;
    }

    .dt-buttons .btn-default {
        background-color: #f7f3f2;
    }

    .dt-buttons .btn-default:hover {
        background-color: #e6e6e6;
        border-color: #adadad;
    }

    @media only screen and (max-width: 767px) {
        div.dt-buttons {
            display: flex;
            justify-content: center;
        }
    }


    .panel-default .pane-heading {
        display: flex;
        align-content: center;
        justify-content: space-between;
        padding: 20px 12px;
    }

    .panel-default .pane-title {
        font-size: 18px;
        color: white;
    }
</style>

<style>
    .panel-default .panel-title {
        font-size: 20px !important;
        color: white !important;
    }

    .panel-default .panel-heading {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 14px !important;
    }

    .panel-default .panel-title {}

    .panel-default .btn-default {
        /* color: white !important; */
        font-weight: bold !important;
        -ms-flex-item-align: stretch !important;
        -ms-grid-row-align: stretch !important;
        align-self: stretch !important;
        font-size: 14px !important;
        padding: 5px 10px !important;
        border-radius: 4px !important;
    }

    .panel-default .btn-default.btn-circle {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0px;
        border-radius: 1000px !important;
    }

    .panel-default .btn-default.btn-circle .fas {
        margin-left: 0px !important;
    }

    .panel-default .panel-body .nav-pills>li.active>a,
    .panel-default .panel-body .nav-pills>li.active>a:hover {
        background: #00a2f2 !important;
        background-color: #00a2f2 !important;
        border-radius: 5px !important;
    }

    #DataTables_Table_0_wrapper > div.row > div.col-sm-6.mb-xs > div{
        float: none !important;
    }

    .panel .panel-heading .panel-title{
        color: white;
        text-transform: capitalize !important;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Mailbox Folder</h4>
            </div>
            <div class="panel-body">
                <a href="{{route('admin.mailing.compose')}}" class="btn btn-default btn-block mb-md"><i
                        class="fas fa-envelope"></i> Compose</a>

                <ul class="nav nav-pills nav-stacked">
                    <li class="active">
                        <a href="{{route('admin.mailing.index')}}">
                            <i class="far fa-envelope"></i>
                            Inbox <span class="label text-weight-normal pull-right">{{\App\Models\Messageuser::where('uid',auth()->user()->id)->where('status', 'direct')->count()}}</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.mailing.sent')}}"> <i class="fas fa-share-square"></i>
                            Sent <span class="label text-weight-normal pull-right">{{\App\Models\Message::where('from',auth()->user()->id)->where('status','Delivered')->count()}}</span>
                        </a>
                    </li>
{{--                    <li class="">--}}
{{--                        <a href="#!"> <i--}}
{{--                                class="far fa-bell text-yellow"></i>--}}
{{--                            Important </a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a href="#!">--}}
{{--                            <i class="far fa-trash-alt"></i> Trash </a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <section class="panel panel-default">
            <header class="panel-heading">
                <div class="panel-btn">
                    <a class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="Refresh Mail"
                        href="#!">
                        <i class="fas fa-sync"></i>
                    </a>
                    <button onclick="deleteMessage()" class="btn btn-circle btn-danger icon" id="msgAction" data-type="delete"><i
                            class="far fa-trash-alt"></i></button>
                </div>
                <h4 class="panel-title">
                    <i class="far fa-envelope"></i> Inbox
                </h4>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="messages-table" class="table text-dark table-hover table-condensed mb-none table-export dataTable no-footer">
                        <thead>
                            <tr role="row">
                                <th class="sorting_disabled" rowspan="1" colspan="1">
                                </th>
                                <th>Sender</th>
                                <th >Subjects</th>
                                <th >Message</th>
                                <th >Time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($messages as $message)
                            <tr class="odd">
                                <td><input type="checkbox" value="{{$message->id}}" /></td>
                                <td>{{$message->message->users()->first()->name}}</td>
                                <td>{{$message->message->subject}}</td>
                                <td>{!! $message->message->message !!}</td>
                                <td>{{$message->message->created_at}}</td>
                                <td><button onclick="viewmessage('{{$message->message->id}}')" class="dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_0" type="button" title="View Message"><span><i class="fa fa-eye"></i></span></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modelmessage">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script> --}}
<script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/daterange-picker/daterangepicker.js') }}"></script>
<script>
    function deleteMessage(){
        var token = "{{ csrf_token() }}";
        var searchIDs = $("#messages-table input:checkbox:checked").map(function(){
            return $(this).val();
        }).get(); // <----
        if(searchIDs.length == 0){
            alert("Please select Messages");
        }else {
            let confirmAction = confirm("Are you sure to execute this action?");
            if (confirmAction) {
                //mailing.trashsentmessage
                $.easyAjax({
                    url: '{{route('admin.mailing.trashinboxmessage')}}',
                    type: "POST",
                    data: {messages: searchIDs, _token : token},
                    success: function (response) {
                        // if(response.status == "success"){
                            window.location.reload();
                        // }
                    }
                });
            }
        }
        console.log(searchIDs);
    }
    function viewmessage(id) {
        $.easyAjax({
            url: '{{url('admin/mailing/message')}}/'+id,
            type: "GET",
            success: function (response) {
                // $.easyBlockUI('#employees-table');
                $('#exampleModalLongTitle').html(response.from);
                var mes = response.message;
                if (response.attachment){
                    mes+='<hr><h4>Attachment</h4><a style="width: 100px" class="btn btn-primary" href="'+response.attachment+'" target="_blank">View Attachment</a>';
                }
                $('#modelmessage').html(mes);
                $('#exampleModalCenter').modal('show');
                // $.easyUnblockUI('#employees-table');
            }
        })
    }
</script>
<script>
    (function($) {

    'use strict';

        // we overwrite initialize of all datatables here
        // because we want to use select2, give search input a bootstrap look
        // keep in mind if you overwrite this fnInitComplete somewhere,
        // you should run the code inside this function to keep functionality.
        //
        // there's no better way to do this at this time :(
        if ( $.isFunction( $.fn[ 'DataTable' ] ) ) {

            $.extend(true, $.fn.DataTable.defaults, {
                language: {
                    lengthMenu: '_MENU_ rows per page',
                    processing: '<i class="fas fa-spinner fa-spin"></i> Loading',
                    paginate: {'next': '<i class="fa fa-chevron-right"></i>', 'previous': '<i class="fa fa-chevron-left"></i>'},
                    search: ''
                },
                fnInitComplete: function( settings, json ) {
                    // select 2
                    if ( $.isFunction( $.fn[ 'select2' ] ) ) {
                        $('.dataTables_length select', settings.nTableWrapper).select2({
                            theme: 'bootstrap',
                            minimumResultsForSearch: -1
                        });
                    }
                    var options = $( 'table', settings.nTableWrapper ).data( 'plugin-options' ) || {};
                    
                    // search
                    var $search = $('.dataTables_filter input', settings.nTableWrapper);
                    $search
                        .attr({
                            placeholder: typeof options.searchPlaceholder !== 'undefined' ? options.searchPlaceholder : 'Search...'
                        })
                        .removeClass('input-sm').addClass('form-control pull-right');

                    if ( $.isFunction( $.fn.placeholder ) ) {
                        $search.placeholder();
                    }
                }
            });
        }
        }).apply(this, [jQuery]);

        $(".dataTable").DataTable({
            "dom": '<"row"<"col-sm-6 mb-xs"B><"col-sm-6"f>><"table-responsive"t>p',
            "ordering": false,
            "autoWidth": false,
            select: true,
            "pageLength": 25,
            "buttons": [
			{
				extend: 'copyHtml5',
				text: '<i class="far fa-copy"></i>',
				titleAttr: 'Copy',
				title: $('.export_title').html(),
				exportOptions: {
					columns: ':visible'
				}
			},
			{
				extend: 'excelHtml5',
				text: '<i class="fa fa-file-excel"></i>',
				titleAttr: 'Excel',
				title: $('.export_title').html(),
				exportOptions: {
					columns: ':visible'
				}
			},
			{
				extend: 'csvHtml5',
				text: '<i class="fa fa-file-alt"></i>',
				titleAttr: 'CSV',
				title: $('.export_title').html(),
				exportOptions: {
					columns: ':visible'
				}
			},
			{
				extend: 'pdfHtml5',
				text: '<i class="fa fa-file-pdf"></i>',
				titleAttr: 'PDF',
				title: $('.export_title').html(),
				footer: true,
				customize: function ( win ) {
					win.styles.tableHeader.fontSize = 10;
					win.styles.tableFooter.fontSize = 10;
					win.styles.tableHeader.alignment = 'left';
				},
				exportOptions: {
					columns: ':visible'
				}
			},
			{
				extend: 'print',
				text: '<i class="fa fa-print"></i>',
				titleAttr: 'Print',
				title: $('.export_title').html(),
				customize: function ( win ) {
					$(win.document.body)
						.css( 'font-size', '9pt' );

					$(win.document.body).find( 'table' )
						.addClass( 'compact' )
						.css( 'font-size', 'inherit' );

					$(win.document.body).find( 'h1' )
						.css( 'font-size', '14pt' );
				},
				footer: true,
				exportOptions: {
					columns: ':visible'
				}
			},
			// {
			// 	extend: 'colvis',
			// 	text: '<i class="fas fa-columns"></i>',
			// 	titleAttr: 'Columns',
			// 	title: $('.export_title').html(),
			// 	postfixButtons: ['colvisRestore']
			// },
		]
        });
</script>
@endpush