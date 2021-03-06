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
        <form class="form" id="userFormEdit" method="POST" data-cofirm="1">
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
                            <input type="text" class="form-control" name="name" placeholder="Masukan nama ..." autocomplete="off"/ value="{{ $records->name }}">
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
                            <input type="text" class="form-control" name="email" placeholder="Masukan email ..." autocomplete="off" value="{{ $records->email }}" />
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
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Password</label>
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
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Retype Password</label>
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
                                <option value="{{ $records->role_kode }}">{{ $records->role_nama }}</option>
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
                <div class="form-group row formInputPoli">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Poli</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select class="form-control slctPoliId" name="poli_id">
                                @if( $records->poli_id != '' )
                                    <option value="{{ $records->poli_id }}">{{ $records->poli_nama }}</option>
                                @else
                                    <option></option>
                                @endif
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

    <a href="<?php echo route($route . '.edit', ['id' => $id]); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            var poli = '{{ $records->poli_id }}';

            if(poli != ''){
                $('.formInputPoli').show();
            }else{
                $('.formInputPoli').hide();
            }

            var roleOption = {
                route_to    : '{{ route("globalfunction.getrole") }}',
                placeholder : 'Select Role',
                allowClear  : true
            };

            global.init_select2('.slctRoleId', roleOption);

            $('.slctRoleId').on('change', function(){
                var val = $(this).val();
                
                if(val == 'KKPDKT'){
                    $('.formInputPoli').show();

                    var poliOption = {
                        route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_poli", "prefix" => "poli" ]) }}',
                        placeholder : 'Select Poli',
                        allowClear  : true
                    };

                    global.init_select2('.slctPoliId', poliOption);
                }else{
                    $('.formInputPoli').hide();
                    $('.slctPoliId').val('');
                }
            });

            var poliOption = {
                route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_poli", "prefix" => "poli" ]) }}',
                placeholder : 'Select Poli',
                allowClear  : true
            };

            global.init_select2('.slctPoliId', poliOption);

            // start form validation submit
            var form   = document.getElementById('userFormEdit');
            var urll   = "{{ route($route . '.update', ['id' => $id]) }}";
            var fields = {
                name  : { validators : { notEmpty : { message : 'Nama tidak boleh kosong' } } },
                email : {
                    validators : {
                        notEmpty     : { message : 'Email tidak boleh kosong' },
                        emailAddress : { message : 'Iputan harus berupa email' }
                    }
                },
                cnfmPass : {
                    validators: {
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

            var params = ['_token','name','email','password'];
            
            global.init_formVld(form, urll, fields, params);
            // end form validation submit
        });
    </script>
@endsection