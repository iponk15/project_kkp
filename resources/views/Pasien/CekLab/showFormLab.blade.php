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
    <form class="form" id="formCekLab" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
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
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-success mr-2" id="submitFormLab">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('formCekLab');
        var urll   = "{{ route( $route . '.storeCekLab', ['psnrekdis_id' => $psnrekdis_id] ) }}";
        var fields = {};
        
        global.init_formVldtn(form, urll, fields, '#submitFormLab');
        // end form validation submit
    });
</script>