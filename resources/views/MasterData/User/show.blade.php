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
                <a href="{{ route($route . '.show') }}" class="btn btn-sm btn-icon btn-light-info ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Reload">
                    <i class="flaticon2-reload"></i>
                </a>
            </div>
        </div>
        <form class="form" id="userFormTambah" method="POST">
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
                            <input type="text" class="form-control" name="name" placeholder="Masukan nama ..." autocomplete="off"/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="flaticon2-edit"></i>
                                </span>
                            </div>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Email <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Masukan email ..." autocomplete="off" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="flaticon-multimedia-2"></i>
                                </span>
                            </div>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Password <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Masukan password ..." autocomplete="off" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="flaticon-safe-shield-protection"></i>
                                </span>
                            </div>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Retype Password <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Masukan kembali password ..." autocomplete="off" name="cnfmPass" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="flaticon2-edit"></i>
                                </span>
                            </div>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Role <span class="text-danger"> * </span></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select class="form-control slctRoleId" name="role_kode">
                                <option></option>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="flaticon-multimedia-2"></i>
                                </span>
                            </div>
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

    <a href="<?php echo route($route . '.show'); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            var roleOption = {
                route_to    : '{{ route("globalfunction.getrole") }}',
                placeholder : 'Select Role',
                allowClear  : true
            };

            global.init_select2('.slctRoleId', roleOption);
            
            // start form validation submit
            var form   = document.getElementById('userFormTambah');
            var urll   = "{{ route($route . '.store') }}";
            var fields = {
                name  : { validators : { notEmpty : { message : 'Nama tidak boleh kosong' } } },
                email : {
                    validators : {
                        notEmpty     : { message : 'Email tidak boleh kosong' },
                        emailAddress : { message : 'Iputan harus berupa email' }
                    }
                },
                password : { validators : { notEmpty : { message : 'Password tidak boleh kosong' } } },
                cnfmPass : {
                    validators: {
                        notEmpty  : { message : 'Inputan ini tidak boleh kosong' },
                        identical : {
                            compare: function() {
                                return form.querySelector('[name="password"]').value;
                            },
                            message : 'Password tidak sama'
                        }
                    }
                },
                role_kode  : { validators : { notEmpty : { message : 'Role tidak boleh kosong' } } },
            };
            
            global.init_formVld(form, urll, fields);
            // end form validation submit
        });
    </script>
@endsection