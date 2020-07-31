<div class="example">
    <div class="example-preview">
        <form class="form" id="formPasienBaru" method="POST">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>No. Rekamedis <span class="text-danger"> * </span></label>
                    <input type="text" class="form-control pasien_norekdis" placeholder="No. Rekamedis " name="pasien_norekdis" readonly/>
                    <span class="form-text text-muted"></span>
                </div>
                <div class="col-lg-4">
                    <label>Dokter <span class="text-danger"> * </span></label>
                    <select name="pastrans_dokter_id" class="form-control slctDokter">
                        <option></option>
                    </select>
                    <span class="form-text text-muted">Silahkan pilih dokter</span>
                </div>
                <div class="col-lg-4">
                    <label>Nama <span class="text-danger"> * </span></label>
                    <input type="email" class="form-control" placeholder="Nama" name="pasien_nama" />
                    <span class="form-text text-muted">Silahkan input nama</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Tanggal Lahir <span class="text-danger"> * </span></label>
                    <input type="text" class="form-control pasien_tgllahir" placeholder="Tanggal lahir" name="pasien_tgllahir" autocomplete="off" />
                    <span class="form-text text-muted">Silahkan input tanggal lahir</span>
                </div>
                <div class="col-lg-4">
                    <label>Umur <span class="text-danger"> * </span></label>
                    <input type="email" class="form-control pasien_umur" readonly placeholder="Umur" name="pasien_umur" />
                    <span class="form-text text-muted">Silahkan input umur</span>
                </div>
                <div class="col-lg-4">
                    <label>Golongan </label>
                    <select name="pasien_golongan_id" class="form-control slctGolongan">
                        <option></option>
                    </select>
                    <span class="form-text text-muted">Silahkan input golongan</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Janis Kelamin <span class="text-danger"> * </span></label>
                    <div class="radio-inline">
                        <label class="radio radio-solid">
                            <input type="radio" name="pasien_jk" value="L"/>
                            <span></span>
                            Laki-laki
                        </label>
                        <label class="radio radio-solid">
                            <input type="radio" name="pasien_jk" value="P"/>
                            <span></span>
                            Perempuan
                        </label>
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
                <div class="col-lg-4">
                    <label>Telp </label>
                    <input type="text" class="form-control" placeholder="Telp" name="pasien_telp" />
                    <span class="form-text text-muted">Silahkan input telp</span>
                </div>
                <div class="col-lg-4">
                    <label>Email <span class="text-danger"> * </span> </label>
                    <input type="email" class="form-control" placeholder="Email" name="pasien_email" />
                    <span class="form-text text-muted">Silahkan input email</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Unit Kerja <span class="text-danger"> * </span></label>
                    <select class="form-control slctUker" name="pasien_uker_id">
                        <option></option>
                    </select>
                    <span class="form-text text-muted">Silahkan unit kerja</span>
                </div>
                <div class="col-lg-4">
                    <label>Alergi Obat </label>
                    <textarea name="pasien_alergi_obat" class="form-control" rows="3" placeholder="Alergi obat"></textarea>
                    <span class="form-text text-muted">Silahkan input jika ada alergi obat</span>
                </div>
                <div class="col-lg-4">
                    <label>Alamat <span class="text-danger"> * </span> </label>
                    <textarea name="pasien_alamat" class="form-control" rows="3" placeholder="Alamat"></textarea>
                    <span class="form-text text-muted">Silahkan input alamat</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>&nbsp;</label>
                    <button type="button" id="btnFormSubmitPasienBaru" class="btn btn-success form-control">Submit Pasien Baru</button>
                </div>
            </div>
        </form>
    </div>
</div>

<a href="<?php echo route($route . '.index'); ?>" class="ajaxify reload"></a>

<script>
    $(document).ready(function(){
        // start hitung umur
        $('.pasien_tgllahir').on('change', function(){
            var dob   = new Date($(this).val());
            var today = new Date();
            var age   = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

            $('.pasien_umur').val(age);
        });
        // end hitung umur

        var prmTglLahir = { 
            autoclose   : true,
            orientation : 'bottom left'
        };

        global.init_dtrp('1', '.pasien_tgllahir', prmTglLahir);

        // start form validation submit
        var form   = document.getElementById('formPasienBaru');
        var urll   = "{{ route($route . '.storePasienBaru') }}";
        var fields = {
            pasien_norekdis    : { validators : { notEmpty : { message : 'No Rekam Medis tidak boleh kosong' } } },
            pasien_nama        : { validators : { notEmpty : { message : 'Nama pasien tidak boleh kosong' } } },
            pasien_tgllahir    : { validators : { notEmpty : { message : 'Tanggal lahir tidak boleh kosong' } } },
            pasien_umur        : { validators : { notEmpty : { message : 'Umur tidak boleh kosong' } } },
            pasien_jk          : { validators : { notEmpty : { message : 'Jenis kelamin tidak boleh kosong' } } },
            pasien_email       : { validators : { notEmpty : { message : 'Email tidak boleh kosong' } } },
            pasien_alamat      : { validators : { notEmpty : { message : 'Alamat tidak boleh kosong' } } },
            pasien_uker_id     : { validators : { notEmpty : { message : 'Unit kerja tidak boleh kosong' } } },
            pastrans_dokter_id : { validators : { notEmpty : { message : 'Dokter tidak boleh kosong' } } }
        };
        
        global.init_formVldtn(form, urll, fields, '#btnFormSubmitPasienBaru');
        // end form validation submit

        // start set select option kategory obat
        var ukerOption = {
            route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_unit_kerja", "prefix" => "uker"]) }}',
            placeholder : 'Pilih Unit Kerja',
            allowClear  : true,
            tag         : true
        };

        global.init_select2('.slctUker', ukerOption);

        $('.slctUker').on('change', function(){
            var val = $(this).val();
            var rte = "{{ route( $route . '.getNorekdis' ) }}";
            var dta = { uker_id : val };

            $.post(rte,dta,function(rst){
                $('.pasien_norekdis').val(rst);
            });
        });
        // end set select option kategory obat

        // start set select option dokter
        var dokterOption = {
            route_to    : '{{ route("globalfunction.getDokter") }}',
            placeholder : 'Pilih Dokter',
            allowClear  : true
        };

        global.init_select2('.slctDokter', dokterOption);
        // end set select option dokter

        // start set select option golongan
        var golonganOption = {
            route_to    : '{{ route("globalfunction.getGolongan") }}',
            placeholder : 'Pilih Golongan',
            allowClear  : true
        };

        global.init_select2('.slctGolongan', golonganOption);
        // end set select option golongan
    });
</script>