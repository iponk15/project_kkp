<!--begin::Advance Table: Widget 7-->
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
            <h3 class="card-label text-info">
                {{ (!empty($cardTitle) ? $cardTitle : 'Card Title' ) }}
                <small>{!! (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) !!}</small>
                <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
            </h3>
        </div>
        <div class="card-toolbar">
            
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-5">
        <div class="example">
            <div class="example-preview">
                <div class="row">
                    <div class="col-md-6">
                        Master Odontogram
                        <div class="example">
                            <div class="example-preview">
                                <?php
                                    echo '<pre>';
                                    print_r($modon);
                                    echo '</pre>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        Hasil Data Inputan
                        <div class="example">
                            <div class="example-preview">
                                <?php
                                    echo '<pre>';
                                    print_r($odontogram->toArray());
                                    echo '</pre>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        
    });
</script>