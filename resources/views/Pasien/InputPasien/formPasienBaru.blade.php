<div class="example">
    <div class="example-preview">
        <form class="form" id="formPasienBaru" method="POST">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>No. Rekamedis</label>
                    <input type="email" class="form-control" placeholder="No. Rekamedis " name="pasien_norekdis" value="{{ $norekdis . date('dmYhi') }}" readonly/>
                    <span class="form-text text-muted"></span>
                </div>
                <div class="col-lg-4">
                    <label>Nama <span class="text-danger"> * </span></label>
                    <input type="email" class="form-control" placeholder="Nama" name="pasien_nama" />
                    <span class="form-text text-muted">Silahkan input nama</span>
                </div>
                <div class="col-lg-4">
                    <label>Tanggal Lahir <span class="text-danger"> * </span></label>
                    <input type="text" class="form-control pasien_tgllahir" placeholder="Tanggal lahir" name="pasien_tgllahir" />
                    <span class="form-text text-muted">Silahkan input tanggal lahir</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Umur <span class="text-danger"> * </span></label>
                    <input type="email" class="form-control" placeholder="Umur" name="pasien_umur" />
                    <span class="form-text text-muted">Silahkan input umur</span>
                </div>
                <div class="col-lg-4">
                    <label>Pangkat / Golongan </label>
                    <input type="text" class="form-control" placeholder="Pangkat / golongan" name="pasien_pangkat" />
                    <span class="form-text text-muted">Silahkan input pangkat / golongan</span>
                </div>
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
            </div>
            <div class="form-group row">
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
                <div class="col-lg-4">
                    <label>Unit Kerja </label>
                    <select class="form-control slctUker" name="pasien_uker[]" multiple>
                        <option></option>
                    </select>
                    <span class="form-text text-muted">Silahkan unit kerja</span>
                </div>
            </div>
            <div class="form-group row">
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
                <div class="col-lg-4">
                    <label>&nbsp;</label>
                    <button type="button" id="btnFormSubmitPasienBaru" class="btn btn-success form-control" style="height: 60%;">Submit Daftar Pasien Baru</button>
                </div>
            </div>
        </form>
    </div>
</div>

<a href="<?php echo route($route . '.index'); ?>" class="ajaxify reload"></a>

<script>
    $(document).ready(function(){
        var prmTglLahir = { autoclose : true }

        global.init_dtrp('1', '.pasien_tgllahir', prmTglLahir);

        // start form validation submit
        var form   = document.getElementById('formPasienBaru');
        var urll   = "{{ route($route . '.storePasienBaru') }}";
        var fields = {
            pasien_nama     : { validators : { notEmpty : { message : 'Nama pasien tidak boleh kosong' } } },
            pasien_tgllahir : { validators : { notEmpty : { message : 'Tanggal lahir tidak boleh kosong' } } },
            pasien_umur     : { validators : { notEmpty : { message : 'Umur tidak boleh kosong' } } },
            pasien_jk       : { validators : { notEmpty : { message : 'Jenis kelamin tidak boleh kosong' } } },
            pasien_email    : { validators : { notEmpty : { message : 'Email tidak boleh kosong' } } },
            pasien_alamat   : { validators : { notEmpty : { message : 'Alamat tidak boleh kosong' } } }
        };
        
        global.init_formVldtn(form, urll, fields, '#btnFormSubmitPasienBaru');
        // end form validation submit

        // start set select option kategory obat
        var ukerOption = {
            route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_unit_kerja", "prefix" => "uker"]) }}',
            placeholder : 'Select Unit Kerja',
            allowClear  : true,
            tag         : true
        };

        global.init_select2('.slctUker', ukerOption);
        // end set select option kategory obat
    });
</script>