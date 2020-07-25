<form method="POST" class="form" id="formEditRjkSps">
    {{ csrf_field() }}
    <div class="modal-header" style="background-color: #173f5f;">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">{!! $modalTitle !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="example">
            <div class="example-preview">
                <div class="form-group">
                    <label>Dokter Spesialis <span class="text-danger"> * </span></label>
                    <select name="rjksps_dokter_id" class="form-control slctDktrSps">
                        <option value="{{ $records->id }}">{{ $records->name }}</option>
                    </select>
                    <span class="form-text text-muted"></span>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>RS / Jalan <span class="text-danger"> * </span></label>
                        <textarea name="rjksps_rs" class="form-control form-control-solid" rows="4" placeholder="Silahkan input RS / Jalan ...">{{ $records->rjksps_rs }}</textarea>
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-6">
                        <label>Keluhan / diagnosa sementara <span class="text-danger"> * </span></label>
                        <textarea name="rjksps_keluhan" class="form-control form-control-solid" rows="4" placeholder="Keluhan / diagnosa sementara ...">{{ $records->rjksps_keluhan }}</textarea>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Sudah saya berikan</label>
                        <textarea name="rjksps_ssb" class="form-control form-control-solid" rows="4" placeholder="Sudah saya berikan ...">{{ $records->rjksps_ssb }}</textarea>
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-6">
                        <label>Keterangan lain</label>
                        <textarea name="rjksps_keterangan" class="form-control form-control-solid" rows="4" placeholder="Keterangan lain ...">{{ $records->rjksps_keterangan }}</textarea>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success font-weight-bold" id="btnResepObat">Update</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        // start select2 dokter spesialis
        var dktrSpsOption = {
            route_to    : '{{ route("globalfunction.getDokterSps") }}',
            placeholder : 'Pilih Dokter Spesialis',
            allowClear  : true
        };

        global.init_select2('.slctDktrSps', dktrSpsOption);
        // end select2 dokter spesialis

        // start form validation submit
        var form   = document.getElementById('formEditRjkSps');
        var urll   = "{{ route( $route . '.updateFormRjkSps', ['rjksps_id' => $rjksps_id] ) }}";
        var fields = {
            rjksps_dokter_id  : { validators : { notEmpty : { message : 'Dokter tidak boleh kosong' } } },
            rjksps_rs         : { validators : { notEmpty : { message : 'Rs / Jalan tidak boleh kosong' } } },
            rjksps_keluhan    : { validators : { notEmpty : { message : 'Keluhan / diagnosa tidak boleh kosong' } } },
            rjksps_ssb        : { validators : { notEmpty : { message : 'Sudah saya berikan tidak boleh kosong' } } },
            rjksps_keterangan : { validators : { notEmpty : { message : 'Keterangan tidak boleh kosong' } } }
        };
        
        global.init_formVld(form, urll, fields);
        // end form validation submit
    });
</script>