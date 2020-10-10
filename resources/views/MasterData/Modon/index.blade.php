@extends('layouts.content')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
                <h3 class="card-label text-info">
                    {{ (!empty($cardTitle) ? $cardTitle : 'Card Title' ) }}
                    <small>{{ (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) }}</small>
                    <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-icon btn-light-info ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Reload">
                    <i class="flaticon2-reload"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <form class="formSearch">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control generalSearch" placeholder="Search..." name="generalSearch"/>
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <select class="form-control status" name="status">
                                        <option value="">Select Is Active</option>
                                        <option value="0">In Active</option>
                                        <option value="1">Active</option>
                                        <option value="99">Delete Temp</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0 text-right">
                        <button class="btn btn-light-info btn-sm mr-3 viewOdontogram" data-toggle="modal" data-target="#viewOdontogram" data-route="{{ route( $route . '.preview' ) }}">
                            <i class="flaticon2-expand"></i> Odontogram
                        </button>
                        <a href="{{ route( $route . '.show' ) }}" class="btn btn-light-success btn-sm mr-3 ajaxify">
                            <i class="flaticon-file-1"></i>Tambah Data
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--begin: Selected Rows Group Action Form-->
            <div class="mt-10 mb-5 collapse" id="kt_datatable_group_action_form_2">
                <div class="d-flex align-items-center">
                    <div class="font-weight-bold text-danger mr-3">Selected
                    <span id="kt_datatable_selected_records_2">0</span> records :</div>
                    <div class="dropdown mr-2">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Update status</button>
                        <div class="dropdown-menu dropdown-menu-sm">
                            <ul class="nav nav-hover flex-column">
                                <li class="nav-item">
                                    <a href="{{ route( $route . '.changeStatus', ['id' => 'NULL', 'status' => '1'] ) }}" class="nav-link updateStatus" data-value="1">
                                        <span class="nav-text">Active</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( $route . '.changeStatus', ['id' => 'NULL', 'status' => '0'] ) }}" class="nav-link updateStatus" data-value="0">
                                        <span class="nav-text">Inactive</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( $route . '.changeStatus', ['id' => 'NULL', 'status' => '99'] ) }}" class="nav-link updateStatus" data-value="99">
                                        <span class="nav-text">Soft Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{ route( $route . '.delete', [ 'id' => 'NULL' ] ) }}" class="btn btn-sm btn-danger mr-2 kt_datatable_delete_all" type="button" id="kt_datatable_delete_all_2">Delete All</a>
                    <!-- <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#kt_datatable_fetch_modal_2">Fetch Selected Records</button> -->
                </div>
            </div>
            <!--end: Selected Rows Group Action Form-->
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="ktTableModon"></div>
            <!--end: Datatable-->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="kt_datatable_fetch_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="scroll" data-scroll="true" data-height="200">
                        <ul id="kt_datatable_fetch_display_2"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <div class="modal fade" id="viewOdontogram" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: dodgerblue;">
                    <h5 class="modal-title" id="exampleModalLabel">Odontogram</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ctnOdontogram"></div>
                </div>
            </div>
        </div>
    </div>

    <a href="<?php echo route($route . '.index'); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            // start get content odontogram
            $('.viewOdontogram').on('click', function(){
                var option = {
                    route : $(this).data('route'),
                    type  : 'ajax',
                    html  : true,
                    rnder : '#ctnOdontogram'
                };
                
                ajaxProses('post', option);
            });
            // end get content odontogram

            // start set ktable datatable
            var id   = '#ktTableModon';
            var urll   = '{{ route($route . ".ktable" ) }}';
            var column = [
                { field : 'RecordID', title : '#', sortable : false, selector : { class : '' }, textAlign : 'center', width : 30 },
                { field : 'no', title : 'No. ', textAlign : 'center', sortable : false, width : 30 },
                { field : 'modon_kode', title : 'Kode', textAlign : 'center', width : 40 },
                { field : 'modon_tipe', title: 'Tipe', textAlign : 'center', sortable : false, width : 60, 
                    // callback function support for column rendering
                    template: function(row) {
                        var tipe = {
                            1  : { 'title' : 'Box 5', 'class' : ' label-light-success'},
                            2  : { 'title' : 'Box 4', 'class' : ' label-light-danger'},
                        };
                        return '<span class="label label-lg font-weight-bold' + tipe[row.modon_tipe].class + ' label-inline">' + tipe[row.modon_tipe].title + '</span>';
                    },
                },
                { field : 'modon_order', title : 'Order', textAlign : 'center', width : 50 },
                { field : 'modon_transform', title : 'Transform', width : 190 },
                { field : 'modon_status', title: 'Status', textAlign : 'center', sortable : false, 
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            0  : { 'title' : 'Inactive', 'class' : 'label-light-warning'},
                            1  : { 'title' : 'Active', 'class' : ' label-light-success'},
                            99 : { 'title' : 'Delete Temp', 'class' : ' label-light-danger'},
                        };
                        return '<span class="label label-lg font-weight-bold' + status[row.modon_status].class + ' label-inline">' + status[row.modon_status].title + '</span>';
                    },
                },
                { field : 'modon_createddate', title : 'Created At', width : 170, textAlign : 'center' },
                { field : 'action', title : 'Action', textAlign : 'center', sortable : false },
            ];
            var cari = {
                generalSearch : '.generalSearch',
                status        : '.status'
            };

            global.init_ktable(id,urll,column,cari);
            // end set ktable datatable

            // start select2 get flag
            statusOption = {
                placeholder : 'Select Status',
                allowClear  : true,
            }

            global.init_select2('.status', statusOption);
            // end select2 get flag
        });
    </script>
@endsection