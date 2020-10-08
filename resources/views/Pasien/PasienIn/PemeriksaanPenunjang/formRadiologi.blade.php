<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
            <h3 class="card-label text-info">
                {!! (!empty($cardTitle) ? $cardTitle : 'Card Title' ) !!}
                <small>{!! (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) !!}</small>
                <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
            </h3>
        </div>
        <div class="card-toolbar"></div>
    </div>
    <form class="form" id="formRadiologi" method="POST">
        <input type="hidden" name="radio_id" value="{{ $radioid }}">
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
                <label class="col-form-label col-lg-3 col-sm-12 text-right">Tanggal <span class="text-danger"> * </span></label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-group">
                        <input readonly type="text" class="form-control radio_tanggal" name="radio_tanggal" placeholder="Masukan tanggal ..." value="{{ empty($radiologi->radio_tanggal) ? '' : date('d/m/Y', strtotime($radiologi->radio_tanggal)) }}" />
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12 text-right">Rumah Sakit <span class="text-danger"> * </span></label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="radio_rs" placeholder="Masukan rumah sakit ..." value="{{ @$radiologi->radio_rs }}" />
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12 text-right">Pekerjaan <span class="text-danger"> * </span></label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="radio_pekerjaan" placeholder="Masukan pekerjaan ..." value="{{ @$radiologi->radio_pekerjaan }}" />
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12 text-right">Jenis <span class="text-danger"> * </span></label>
                <div class="col-9 col-form-label">
                    <div class="input-group">
                        <div class="radio-inline">
                            <label class="radio radio-success">
                                <input type="radio" name="radio_jenis" value="1" {{ @$radiologi->radio_jenis == '1' ? 'checked' : '' }} >
                                <span></span>Diagnostik
                            </label>
                                <label class="radio radio-success">
                                <input type="radio" name="radio_jenis" value="2" {{ @$radiologi->radio_jenis == '2' ? 'checked' : '' }}>
                                <span></span>Intervensi
                            </label>
                        </div>
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12 text-right">Ragio</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="radio_ragio" placeholder="Masukan Ragio ..." value="{{ @$radiologi->radio_ragio }}" />
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-group">
                        <textarea name="radio_keterangan" class="form-control" rows="3" placeholder="Masukan keterangan ...">{{ @$radiologi->radio_keterangan }}</textarea>
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-2 ml-lg-auto">
                    <button type="submit" id="submitFormRadio" class="btn btn-success mr-2">{{ empty($radioid) ? 'Simpan' : 'Update'}}</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('formRadiologi');
        var urll   = "{{ route( $route . '.storeFormRadiologi', ['psnrekdis_id' => $psnrekdis_id] ) }}";
        var fields = {
            radio_rs        : { validators : { notEmpty : { message : 'Rumah sakit tidak boleh kosong' } } },
            radio_jenis     : { validators : { notEmpty : { message : 'Jenis tidak boleh kosong' } } },
            radio_pekerjaan : { validators : { notEmpty : { message : 'Pekerjaan tidak boleh kosong' } } }
        };
        
        global.init_formVldtn(form, urll, fields, '#submitFormRadio');
        // end form validation submit
        
        var optTanggal = {
            autoclose : true
            // orientation : 'left bottom'
        };

        global.init_dtrp('1', '.radio_tanggal',optTanggal);
    });
</script>