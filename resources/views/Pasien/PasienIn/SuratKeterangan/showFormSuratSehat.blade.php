<form method="POST" class="form" id="formSuratSehat">
    {{ csrf_field() }}
    <input type="hidden" name="ssht_psnrekdis_id" value="{{ !empty($records) ? Hashids::encode($records->ssht_psnrekdis_id) : '' }}">
    <div class="modal-header" style="background-color: #173f5f;">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">{!! $modalTitle !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="example">
            <div class="example-preview">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Keperluan</label>
                    <div class="col-lg-7 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select name="ssht_keperluan" class="form-control ssht_keperluan">
                                <option></option>
                                <option {{ ( !empty($records) ? $records->ssht_keperluan == '1' ? 'selected' : '' : '' ) }} value="1" >Diklat Perjabatan</option>
                                <option {{ ( !empty($records) ? $records->ssht_keperluan == '2' ? 'selected' : '' : '' ) }} value="2" >Diklat PIM</option>
                                <option {{ ( !empty($records) ? $records->ssht_keperluan == '3' ? 'selected' : '' : '' ) }} value="3" >Mengikuti Training</option>
                                <option {{ ( !empty($records) ? $records->ssht_keperluan == '4' ? 'selected' : '' : '' ) }} value="4" >Lain - lain</option>
                            </select>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row formKeterangan">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
                    <div class="col-lg-7 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="ssht_keterangan" value="{{ ( !empty($records) ? $records->ssht_keterangan : '' ) }}" />
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success font-weight-bold btnSimpan" id="btnSuratSehat">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        var xxx = '{{ ( !empty($records) ? $records->ssht_keperluan : "" ) }}';

        if(xxx == 4){
            $('.formKeterangan').show();
        }else{
            $('.formKeterangan').hide();
        }

        $('.ssht_keperluan').on('change', function(){
            var val = $(this).val();

            if(val == 4){
                $('.formKeterangan').show();
            }else{
                $('.formKeterangan').hide();
            }
        });

        var prm = {
            placeholder : 'Pilih Keperluan',
            allowClear  : true
        }
        global.init_select2('.ssht_keperluan', prm);

        // start form validation submit
        var form   = document.getElementById('formSuratSehat');
        var urll   = "{{ route( $route . '.storeFormSuratSehat', [ 'psnrekdis_id' => $psnrekdis_id ] ) }}";
        var fields = { ssht_keperluan : { validators : { notEmpty : { message : 'Keperluan tidak boleh kosong' } } } };
        
        global.init_formVldtn(form, urll, fields, '#btnSuratSehat');
        // end form validation submit
    });
</script>