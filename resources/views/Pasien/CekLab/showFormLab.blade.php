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
                            <th class="text-center">Diagnosa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $records->rjklab_diagnosa }}</td>
                        </tr>
                    </tbody>
                </table>
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
                                        <input disabled type="checkbox" name="rjklab_htg_rutin" {{ $records->rjklab_htg_rutin == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Rutin (HB,HT,TR,Lc)
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_lekosit" {{ $records->rjklab_htg_lekosit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Lekosit
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_dc" {{ $records->rjklab_htg_dc == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_htg_hb" {{ $records->rjklab_htg_hb == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HB
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_trombosit" {{ $records->rjklab_htg_trombosit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Trombosit
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_gd" {{ $records->rjklab_htg_gd == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_htg_hematokrit" {{ $records->rjklab_htg_hematokrit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Hematokrit
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_led" {{ $records->rjklab_htg_led == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        LED
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_rhesus" {{ $records->rjklab_htg_rhesus == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_htg_eritrosit" {{ $records->rjklab_htg_eritrosit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Eritrosit
                                    </label>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_htg_mmm" {{ $records->rjklab_htg_mmm == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_kk_ld_kt" {{ $records->rjklab_kk_ld_kt == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kolesterol Total *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_fh_ast" {{ $records->rjklab_kk_fh_ast == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        AST/SGOT
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_fg_ureum" {{ $records->rjklab_kk_fg_ureum == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Ureum
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_gd_gds" {{ $records->rjklab_kk_gd_gds == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_kk_ld_kh" {{ $records->rjklab_kk_ld_kh == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kolesterol HDL *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_fh_alt" {{ $records->rjklab_kk_fh_alt == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        ALT/SGPT
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_fg_kreatinin" {{ $records->rjklab_kk_fg_kreatinin == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kreatinin
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_gd_gdp" {{ $records->rjklab_kk_gd_gdp == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_kk_ld_kl" {{ $records->rjklab_kk_ld_kl == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kolesterol LDL *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_fg_au" {{ $records->rjklab_kk_fg_au == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Asam Urat
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_gd_gdj" {{ $records->rjklab_kk_gd_gdj == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_kk_ld_trig" {{ $records->rjklab_kk_ld_trig == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Trigliserida *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_kk_gd_hba" {{ $records->rjklab_kk_gd_hba == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_is_widal" {{ $records->rjklab_is_widal == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Widal
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_is_hbs" {{ $records->rjklab_is_hbs == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HBsAg
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_is_ah" {{ $records->rjklab_is_ah == '1' ? 'checked' : '' }} />
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
                                        <input disabled type="checkbox" name="rjklab_urine_hcg" {{ $records->rjklab_urine_hcg == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HCG
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_urine_narkoba" {{ $records->rjklab_urine_narkoba == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Narkoba
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input disabled type="checkbox" name="rjklab_urine_ul" {{ $records->rjklab_urine_ul == '1' ? 'checked' : '' }} />
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