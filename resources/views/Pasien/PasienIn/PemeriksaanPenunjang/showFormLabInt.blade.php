<form method="POST" class="form" id="formResepObat">
    {{ csrf_field() }}
    <div class="modal-header" style="background-color: #173f5f;">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">{!! $cardTitle !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="example">
            <div class="example-preview">
                <div class="form-group">
                    <label>Diagnosa <span class="text-danger"> * </span></label>
                    <textarea name="rjklab_diagnosa" class="form-control" rows="5"></textarea>
                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                </div>
                <div class="table-responsive-lg">
                    <table class="table">
                        <thead style="background-color: gainsboro;">
                            <tr>
                                <th colspan="3" class="text-center">HEMATOLOGI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_rutin">
                                            <span></span>
                                            Rutin (HB,HT,TR,Lc)
                                        </label>
                                    </div>
                                </td>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_lekosit">
                                            <span></span>
                                            Lekosit
                                        </label>
                                    </div>
                                </td>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_dc">
                                            <span></span>
                                            Diff Count
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_hb">
                                            <span></span>
                                            HB
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_trombosit">
                                            <span></span>
                                            Trombosit
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_gd">
                                            <span></span>
                                            Golongan Darah
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_hematokrit">
                                            <span></span>
                                            Hematokrit
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_led">
                                            <span></span>
                                            LED
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_rhesus">
                                            <span></span>
                                            Rhesus
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_eritrosit">
                                            <span></span>
                                            Eritrosit
                                        </label>
                                    </div>
                                </td>
                                <td colspan="2">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_htg_mmm">
                                            <span></span>
                                            MVC, MCH, MCHC
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive-lg">
                    <table class="table">
                        <thead style="background-color: gainsboro;">
                            <tr>
                                <th colspan="4" class="text-center">KIMIA KLINIK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><b>LEMAK HATI</b></td>
                                <td class="text-center"><b>FAAL HATI</b></td>
                                <td class="text-center"><b>FAAL GINJAL</b></td>
                                <td class="text-center"><b>GULA DARAH</b></td>
                            </tr>
                            <tr>
                                <td width="25%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_ld_kt">
                                            <span></span>
                                            Kolesterol Total *
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_fh_ast">
                                            <span></span>
                                            AST/SGOT
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_fg_ureum">
                                            <span></span>
                                            Ureum
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_gd_gds">
                                            <span></span>
                                            Gula Darah Sewaktu
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_ld_kh">
                                            <span></span>
                                            Kolesterol HDL *
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_fh_alt">
                                            <span></span>
                                            ALT/SGPT
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_fg_kreatinin">
                                            <span></span>
                                            Kreatinin
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_gd_gdp">
                                            <span></span>
                                            Gula Darah Puasa *
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" colspan="2">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_ld_kl">
                                            <span></span>
                                            Kolesterol LDL *
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_fg_au">
                                            <span></span>
                                            Asam Urat
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_gd_gdj">
                                            <span></span>
                                            Gula Darah 2 JPP
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" colspan="3">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_ld_trig">
                                            <span></span>
                                            Trigliserida *
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_kk_gd_hba">
                                            <span></span>
                                            HBA!C *
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive-lg">
                    <table class="table">
                        <thead style="background-color: gainsboro;">
                            <tr>
                                <th colspan="3" class="text-center">IMUNOLOGI & SEROLOGI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_is_widal">
                                            <span></span>
                                            Widal
                                        </label>
                                    </div>
                                </td>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_is_hbs">
                                            <span></span>
                                            HBsAg
                                        </label>
                                    </div>
                                </td>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_is_ah">
                                            <span></span>
                                            Anti HBs
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive-lg">
                    <table class="table">
                        <thead style="background-color: gainsboro;">
                            <tr>
                                <th colspan="3" class="text-center">URINE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_urine_hcg">
                                            <span></span>
                                            HCG
                                        </label>
                                    </div>
                                </td>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_urine_narkoba">
                                            <span></span>
                                            Narkoba
                                        </label>
                                    </div>
                                </td>
                                <td width="33.3333333%">
                                    <div class="checkbox-inline"> 
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="rjklab_urine_ul">
                                            <span></span>
                                            Urine Lengkap
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success font-weight-bold btnSimpan" id="btnResepObat">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('formResepObat');
        var urll   = "{{ route( $route . '.storeLabInt', ['psnrekdis_id' => $psnrekdis_id] ) }}";
        var fields = { rjklab_diagnosa : { validators : { notEmpty : { message : 'Diagnosa tidak boleh kosong' } } }, };
        
        global.init_formVldtn(form, urll, fields, '#btnResepObat');
        // end form validation submit
    });
</script>