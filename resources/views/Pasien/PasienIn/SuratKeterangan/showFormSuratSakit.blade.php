<form method="POST" class="form" id="formSuratSakit">
    {{ csrf_field() }}
    <input type="hidden" name="sskt_psnrekdis_id" value="{{ !empty($records) ? Hashids::encode($records->sskt_psnrekdis_id) : '' }}">
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
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Terhitung Tanggal</label>
                    <div class="col-lg-7 col-md-9 col-sm-12">
                        <div class="input-daterange input-group" id="kt_datepicker_5">
                            <input type="text" class="form-control sskt_tgl_mulai" name="sskt_tgl_mulai" value="{{ !empty($records) ? date('m/d/Y', strtotime($records->sskt_tgl_mulai)) : '' }}" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                            </div>
                            <input type="text" class="form-control sskt_tgl_akhir" name="sskt_tgl_akhir" value="{{ !empty($records) ? date('m/d/Y', strtotime($records->sskt_tgl_akhir)) : '' }}" />
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Istirahat Selama</label>
                    <div class="col-lg-3 col-md-9 col-sm-12">
                        <div class="input-daterange input-group">
                            <input type="text" class="form-control jmlHari" readonly name="sskt_jmlhari" value="{{ !empty($records) ? $records->sskt_jmlhari : '' }}" />
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success font-weight-bold btnSimpan" id="btnSuratSakit">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('formSuratSakit');
        var urll   = "{{ route( $route . '.storeFormSuratSakit', [ 'psnrekdis_id' => $psnrekdis_id ] ) }}";
        var fields = {
            sskt_tgl_mulai : { validators : { notEmpty : { message : 'Tanggal Mulai tidak boleh kosong' } } },
            sskt_tgl_akhir : { validators : { notEmpty : { message : 'Tanggal Akhir tidak boleh kosong' } } },
            sskt_jmlhari   : { validators : { notEmpty : { message : 'Jumlah hari tidak boleh kosong' } } }
        };
        
        global.init_formVldtn(form, urll, fields, '#btnSuratSakit');
        // end form validation submit
        var prm = {
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: {
                leftArrow  : '<i class="la la-angle-right"></i>',
                rightArrow : '<i class="la la-angle-left"></i>'
            }
        }
        global.init_dtrp('1', '#kt_datepicker_5', prm);

        $('.sskt_tgl_awal, .sskt_tgl_akhir').on('change', function(){
            var startDay = new Date($('.sskt_tgl_mulai').val());
            var endDay   = new Date($('.sskt_tgl_akhir').val());
        
            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = millisBetween / (1000 * 3600 * 24);
            var res  = Math.round(Math.abs(days)) + 1;
        
            $('.jmlHari').val(res);
        }); 
    });
</script>