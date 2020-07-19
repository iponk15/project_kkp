<div class="example">
    <div class="example-preview">
    <form class="form" id="formPasienTerdaftar" method="POST">
        {{ csrf_field() }}
        <div class="form-group row">
            <div class="col-lg-4">
                <label>No. Rekamedis <span class="text-danger"> * </span></label>
                <select name="pasien_id" class="form-control pasien_norekdis">
                    <option></option>
                </select>
                <span class="form-text text-muted"></span>
            </div>
            <div class="col-lg-4">
                <label>Dokter <span class="text-danger"> * </span></label>
                <select name="pastrans_dokter_id" class="form-control slctDokter formDisabled">
                    <option></option>
                </select>
                <span class="form-text text-muted">Silahkan pilih dokter</span>
            </div>
            <div class="col-lg-4">
                <label>Nama <span class="text-danger"> * </span></label>
                <input type="email" class="form-control formDisabled pasien_nama" placeholder="Nama" name="pasien_nama" />
                <span class="form-text text-muted">Silahkan input nama</span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4">
                <label>Tanggal Lahir <span class="text-danger"> * </span></label>
                <input type="text" class="form-control pasien_tgllahir formDisabled" placeholder="Tanggal lahir" name="pasien_tgllahir" />
                <span class="form-text text-muted">Silahkan input tanggal lahir</span>
            </div>
            <div class="col-lg-4">
                <label>Umur <span class="text-danger"> * </span></label>
                <input type="email" class="form-control formDisabled pasien_umur" placeholder="Umur" name="pasien_umur" />
                <span class="form-text text-muted">Silahkan input umur</span>
            </div>
            <div class="col-lg-4">
                <label>Pangkat / Golongan </label>
                <input type="text" class="form-control formDisabled pasien_pangkat" placeholder="Pangkat / golongan" name="pasien_pangkat" />
                <span class="form-text text-muted">Silahkan input pangkat / golongan</span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4">
                <label>Janis Kelamin <span class="text-danger"> * </span></label>
                <div class="radio-inline">
                    <label class="radio radio-solid">
                        <input type="radio" name="pasien_jk" value="L" class="formDisabled pasien_jk_L" />
                        <span></span>
                        Laki-laki
                    </label>
                    <label class="radio radio-solid">
                        <input type="radio" name="pasien_jk" value="P" class="formDisabled pasien_jk_P" />
                        <span></span>
                        Perempuan
                    </label>
                </div>
                <span class="form-text text-muted"></span>
            </div>
            <div class="col-lg-4">
                <label>Telp </label>
                <input type="text" class="form-control formDisabled pasien_telp" placeholder="Telp" name="pasien_telp" />
                <span class="form-text text-muted">Silahkan input telp</span>
            </div>
            <div class="col-lg-4">
                <label>Email <span class="text-danger"> * </span> </label>
                <input type="email" class="form-control formDisabled pasien_email" placeholder="Email" name="pasien_email" />
                <span class="form-text text-muted">Silahkan input email</span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4">
                <label>Unit Kerja </label>
                <select class="form-control formDisabled slctUker" name="pasien_uker[]" multiple>
                    <option></option>
                    <option class="tempUker"></option>
                </select>
                <span class="form-text text-muted">Silahkan unit kerja</span>
            </div>
            <div class="col-lg-4">
                <label>Alergi Obat </label>
                <textarea name="pasien_alergi_obat" class="form-control formDisabled pasien_alergi_obat" rows="3" placeholder="Alergi obat"></textarea>
                <span class="form-text text-muted">Silahkan input jika ada alergi obat</span>
            </div>
            <div class="col-lg-4">
                <label>Alamat <span class="text-danger"> * </span> </label>
                <textarea name="pasien_alamat" class="form-control formDisabled pasien_alergi_obat" rows="3" placeholder="Alamat"></textarea>
                <span class="form-text text-muted">Silahkan input alamat</span>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <label>&nbsp;</label>
                <button type="button" id="btnFormSubmitPasienTerdaftar" class="btn btn-success form-control">Submit</button>
            </div>
        </div>
    </form>
    </div>
</div>

<a href="<?php echo route($route . '.index'); ?>" class="ajaxify reload"></a>

<script>
    $(document).ready(function(){
        $('.formDisabled').attr('disabled', true);
        $('#btnFormSubmitPasienTerdaftar').hide();

        var prmTglLahir = { 
            autoclose   : true,
            orientation : 'bottom left'
        }

        global.init_dtrp('1', '.pasien_tgllahir', prmTglLahir);

        // start form validation submit
        var form   = document.getElementById('formPasienTerdaftar');
        var urll   = "{{ route($route . '.updatePasienTerdaftar') }}";
        var fields = {
            pasien_norekdis : { validators : { notEmpty : { message : 'No Rekamedis tidak boleh kosong' } } },
            pasien_nama     : { validators : { notEmpty : { message : 'Nama pasien tidak boleh kosong' } } },
            pasien_tgllahir : { validators : { notEmpty : { message : 'Tanggal lahir tidak boleh kosong' } } },
            pasien_umur     : { validators : { notEmpty : { message : 'Umur tidak boleh kosong' } } },
            pasien_jk       : { validators : { notEmpty : { message : 'Jenis kelamin tidak boleh kosong' } } },
            pasien_email    : { validators : { notEmpty : { message : 'Email tidak boleh kosong' } } },
            pasien_alamat   : { validators : { notEmpty : { message : 'Alamat tidak boleh kosong' } } }
        };
        
        global.init_formVldtn(form, urll, fields, '#btnFormSubmitPasienTerdaftar');
        // end form validation submit

        // start set select option kategory obat
        var rekdisOption = {
            route_to       : '{{ route("globalfunction.getNoRekamedis") }}',
            placeholder    : 'Pilih No. Rekamedis',
            allowClear     : true,
            MininputLength : 3
        };

        global.init_select2('.pasien_norekdis', rekdisOption);
        // end set select option kategory obat

        $('.pasien_norekdis').on('change', function(){
            if($(this).val() != ''){
                var data  = { pasien_id : $(this).val() };
                var route = '{{ route( $route . ".getDataPsien" ) }}';

                $.post(route, data, function(res){
                    $('.formDisabled').attr('disabled', false);
                    $('#btnFormSubmitPasienTerdaftar').show();

                    // set pasien
                    $('.pasien_nama').val(res.pasien.pasien_nama);
                    $('.pasien_umur').val(res.pasien.pasien_umur);
                    $('.pasien_pangkat').val(res.pasien.pasien_pangkat);
                    $('.pasien_telp').val(res.pasien.pasien_telp);
                    $('.pasien_email').val(res.pasien.pasien_email);
                    $('.pasien_alergi_obat').val(res.pasien.pasien_alergi_obat);
                    $('.pasien_alamat').val(res.pasien.pasien_alamat);

                    const date = new Date(res.pasien.pasien_tgllahir)
                    const dateTimeFormat = new Intl.DateTimeFormat('en', { year: 'numeric', month: '2-digit', day: '2-digit' }) 
                    const [{ value: month },,{ value: day },,{ value: year }] = dateTimeFormat .formatToParts(date ) 

                    $('.pasien_tgllahir').val(`${month}/${day}/${year}`);

                    if(res.pasien.pasien_jk == 'P'){
                        $('.pasien_jk_P').attr('checked', true);
                        $('.pasien_jk_L').attr('checked', false);
                    }else{
                        $('.pasien_jk_P').attr('checked', false);
                        $('.pasien_jk_L').attr('checked', true);
                    }

                    // start set select option kategory obat
                    var ukerOption = {
                        route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_unit_kerja", "prefix" => "uker"]) }}',
                        placeholder : 'Select Unit Kerja',
                        allowClear  : true,
                        tag         : true
                    };

                    global.init_select2('.slctUker', ukerOption);
                    // end set select option kategory obat

                    jQuery.each( res.uker, function( i, val ) {
                        var option = '<option selected value="'+ val.uker_id +'">'+ val.uker_nama +'</option>';

                        $('.slctUker').append(option);
                    });
                },'json');
            }else{
                $('.formDisabled').attr('disabled', true).val('');
                $('#btnFormSubmitPasienTerdaftar').hide();
            }
        });

        var dokterOption = {
            route_to    : '{{ route("globalfunction.getDokter") }}',
            placeholder : 'Pilih Dokter',
            allowClear  : true
        };

        global.init_select2('.slctDokter', dokterOption);
        // end set select option dokter
    });
</script>