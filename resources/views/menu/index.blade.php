@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
    {!! Html::style('vendor/cmxperts-menu/style.css') !!}
@endpush

@section('content')
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <div class="navbar-nav flex-column">
                <h1>Menu Manager</h1>
            </div>
            <ul class="navbar-nav d-flex align-center ml-auto right-side-filter flex-column">
                <li>
                    <i class="las la-angle-double-right"></i>
                    <span id="currentDate"></span>
                </li>
            </ul>
        </header>
    </div>

    <div class="content px-3">
        <div class="row layout-top-spacing data-table-container">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="card-body">
                        {!! Menu::render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/table/datatable/datatables.js') !!}
    <!--  The following JS library files are loaded to use Copy CSV Excel Print Options-->
    {!! Html::script('plugins/table/datatable/button-ext/dataTables.buttons.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/jszip.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/buttons.html5.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/buttons.print.min.js') !!}
    <!-- The following JS library files are loaded to use PDF Options-->
    {!! Html::script('plugins/table/datatable/button-ext/pdfmake.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/vfs_fonts.js') !!}
    {!! Menu::scripts() !!}
@endpush
