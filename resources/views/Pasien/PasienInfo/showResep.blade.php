<style>
    .bckg{
        background-color: cornsilk;
    }
</style>

@if($records->isEmpty())
    <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Mohon maaf belum ada informasi yang bisa ditampilkan</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@else
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
            <div class="card-toolbar">
                <button class="btn btn-sm btn-light-danger font-weight-bold">
                    <i class="fas fa-file-pdf"></i> Cetak Resep
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">        
                <table class="table table-bordered table-sm">
                    <thead style="background-color: papayawhip;">
                        <tr>
                            <th class="text-center" width="1%">No. </th>
                            <th class="text-center">Obat</th>
                            <th class="text-center" width="15%">Jenis Obat</th>
                            <th class="text-center" width="12%">Jumlah Obat</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key => $value)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $value->obat_nama }}</td>
                                <td>{{ $value->jenobat_nama }}</td>
                                <td class="text-center">{{ $value->resep_jumlah }}</td>
                                <td>{{ $value->resep_keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif