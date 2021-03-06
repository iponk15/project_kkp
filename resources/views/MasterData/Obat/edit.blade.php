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
                <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-icon btn-light-warning ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Kembali">
                    <i class="flaticon2-left-arrow-1"></i>
                </a>
                <a href="{{ route($route . '.edit', ['id' => $id]) }}" class="btn btn-sm btn-icon btn-light-info ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Reload">
                    <i class="flaticon2-reload"></i>
                </a>
            </div>
        </div>
        <form class="form" id="obatFormEdit" method="POST" data-cofirm="1">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <div class="alert alert-custom alert-light-warning fade mb-5 d-none formAlert" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">A simple primary alert—check it out!</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-right">Nama <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="obat_nama" placeholder="Masukan sekolah / universitas ..." autocomplete="off"/ value="{{ $records->obat_nama }}">
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Kategori Obat <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select class="form-control slctKatobatId" name="obat_katobat_id">
                                <option value="{{ $records->katobat_id }}">{{ $records->katobat_nama }}</option>
                            </select>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Jenis Obat </label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select class="form-control slctJenobatId" name="obat_jenobat_id">
                                <option value="{{ $records->jenobat_id }}">{{ $records->jenobat_nama }}</option>
                            </select>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Deskripsi <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="obat_deskripsi" placeholder="Masukan jenjang ..." autocomplete="off" value="{{ $records->obat_deskripsi }}"/>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-7 ml-lg-auto">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <a href="<?php echo route($route . '.edit', ['id' => $id]); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            // start set select option kategory obat
            var ktgrOption = {
                route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_kategori_obat", "prefix" => "katobat"]) }}',
                placeholder : 'Select Kategori Obat',
                allowClear  : true
            };

            global.init_select2('.slctKatobatId', ktgrOption);
            // end set select option kategory obat

            // start set select option jenis obat
            var jenbatOption = {
                route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_jenis_obat", "prefix" => "jenobat"]) }}',
                placeholder : 'Select Jenis Obat',
                allowClear  : true
            };

            global.init_select2('.slctJenobatId', jenbatOption);
            // end set select option jenis obat

            // start form validation submit
            var form   = document.getElementById('obatFormEdit');
            var urll   = "{{ route($route . '.update', ['id' => $id]) }}";
            var fields = {
                obat_nama       : { validators : { notEmpty : { message : 'Nama tidak boleh kosong' } } },
                obat_deskripsi  : { validators : { notEmpty : { message : 'De tidak boleh kosong' } } },
                obat_katobat_id : { validators : { notEmpty : { message : 'Kategori obat tidak boleh kosong' } } }
            };
            
            global.init_formVld(form, urll, fields);
            // end form validation submit
        });
    </script>
@endsection