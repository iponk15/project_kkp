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
                                <div class="col-md-3 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control generalSearch" placeholder="Search..." name="generalSearch"/>
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 my-2 my-md-0">
                                    <select class="form-control katobat_id" name="katobat_id">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-3 my-2 my-md-0">
                                    <select class="form-control jenobat_id" name="jenobat_id">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-2 my-2 my-md-0">
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
                        <!-- <div class="dropdown dropdown-inline">
                            <a href="javascript:void(0);" class="btn btn-light-secondary btn-sm mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon2-file-1 text-dark"></i> <span class="text-dark">Export Data</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm">
                                <ul class="navi navi-hover py-2">
                                    <li class="navi-item">
                                        <a href="" class="navi-link exportFile" data-tipe="excel">
                                            <span class="navi-icon">
                                                <i class="fas fa-file-excel text-success"></i>
                                            </span>
                                            <span class="navi-text text-success">File Excel</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="" class="navi-link exportFile" data-tipe="pdf">
                                            <span class="navi-icon">
                                                <i class="fas fa-file-pdf text-danger"></i>
                                            </span>
                                            <span class="navi-text text-danger">File PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
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
            <div class="datatable datatable-bordered datatable-head-custom" id="ktTableObat"></div>
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

    {{-- start form input stok --}}
    <div class="modal fade" id="formInputStok" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="ctnFormStok">
                
            </div>
        </div>
    </div>
    {{-- start form input stok --}}

    <a href="<?php echo route($route . '.index'); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            // start set ktable datatable
            var id     = '#ktTableObat';
            var urll   = '{{ route($route . ".ktable" ) }}';
            var column = [
                { field : 'RecordID', title : '#', sortable : false, selector : { class : '' }, textAlign : 'center', width : 20 },
                { field : 'no', title : 'No. ', textAlign : 'center', sortable : false, width : 30 },
                { field : 'obat_nama', title : 'Nama' },
                { field : 'katobat_nama', title : 'Kategori', width : 220 },
                { field : 'jenobat_nama', title : 'Jenis', width : 80 },
                { field : 'obat_deskripsi', title : 'Deskripsi', width : 180},
                { field : 'obat_stok', title : 'Stok', width : 80, textAlign : 'center' },
                { field: 'status', title: 'Status', textAlign : 'center', sortable : false, width : 80,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            0  : { 'title' : 'Inactive', 'class' : 'label-light-warning'},
                            1  : { 'title' : 'Active', 'class' : ' label-light-success'},
                            99 : { 'title' : 'Delete Temp', 'class' : ' label-light-danger'},
                        };
                        return '<span class="label label-lg font-weight-bold' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
                    },
                },
                { field : 'action', title : 'Action', textAlign : 'center', sortable : false },
            ];
            var cari = {
                generalSearch : '.generalSearch',
                katobat_id    : '.katobat_id',
                jenobat_id    : '.jenobat_id',
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

            // start set select option kategory obat
            var roleOption = {
                route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_kategori_obat", "prefix" => "katobat"]) }}',
                placeholder : 'Select Kategori Obat',
                allowClear  : true
            };

            global.init_select2('.katobat_id', roleOption);
            // end set select option kategory obat

            // start set select option jenis obat
            var roleOption = {
                route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_jenis_obat", "prefix" => "jenobat"]) }}',
                placeholder : 'Select Jenis Obat',
                allowClear  : true
            };

            global.init_select2('.jenobat_id', roleOption);
            // end set select option jenis obat
        });

        function f_action(ele,eve,flag){
            eve.preventDefault();
            
            var option = {
                route : $(ele).attr('href'),
                blkUi : '#body-content',
                type  : 'swal',
                attr  : {
                    title: 'Anda yakin ?',
                    text: (flag == undefined) ? 'akan menghapus data ini.' : (flag == 1) ? "akan mengaktifkan kembali data ini." : (flag == 0) ? "akan me non aktifkan data ini. " : "akan menghapus sementara data ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }
            };
            
            ajaxProses('post', option);
        }

        function f_stokObat(ele,eve){
            var option = {
                route : $(ele).data('route'),
                blkUi : '#body-content',
                type  : 'ajax',
                html  : true,
                rnder : '#ctnFormStok',
                data  : { obat_id : $(ele).data('id') }
            }

            ajaxProses('post', option);
        }
    </script>
@endsection