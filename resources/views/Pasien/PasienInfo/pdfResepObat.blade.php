<table style="width: 100%; border: 1px solid black;">
    <tr>
        <td align="center">
            <img src="assets/media/logos/kkp-log-min.jpg" alt="" style="height: 100px; text-align: center;">
        </td>
        <td align="center">
            <h4>
                <strong>KLINIK KEMENTERIAN KELAUTAN DAN PERIKANAN</strong><br>
                Medan Merdeka Timur No.16, Gedung Mina Bahari<br>
                Jakarta Pusat 10110<br>
                Telp. 021-3519070 Ext. 7044 / 7045
            </h4>
        </td>
    </tr>
</table>
<table style="width: 100%; border: 1px solid black;">
    <tr>
        <td style="width: 20%;">
            <strong>Nama Dokter</strong>
        </td>
        <td style="width: 2%;">
            :
        </td>
        <td style="width: 30%;">
            {{ $getTras->{'name'} }}
        </td>
        <td style="width: 20%;">
            <strong>Tanggal</strong>
        </td>
        <td style="width: 2%;">
            :
        </td>
        <td style="width: 30%;">
            {{ date('d F Y', strtotime($getTras->{'pastrans_created_date'})) }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%;">
            <strong>SIP</strong>
        </td>
        <td style="width: 2%;">
            :
        </td>
        <td style="width: 28%;">
        </td>
        <td style="width: 20%;">
            <strong>Riwayat Alergi</strong>
        </td>
        <td style="width: 2%;">
            :
        </td>
        <td style="width: 28%;">
            {{ $pasien->{'pasien_riwayat_alergi'} }}
        </td>
    </tr>
    <tr>
        <td colspan="3" style="width: 72%;">
        </td>
        <td colspan="3" style="width: 28%;">
            <table>
                <tr>
                    <td style="width: 20px; height:20px; border: 1px solid black"><div></div></td>
                    <td>Ya, Nama Obat:</td>
                </tr>
                <tr>
                    <td style="width: 20px; height:20px; border: 1px solid black"></td>
                    <td>Tidak</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table style="width: 100%; border: 1px solid black;">
    <tr>
        <td style="width: 50%; vertical-align: top;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="5" style="border: 1px solid black; background-color: #abf2cb;"><strong>Resep Obat</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; text-align: center;">No.</td>
                    <td style="border: 1px solid black; text-align: center;">Obat</td>
                    <td style="border: 1px solid black; text-align: center;">Jenis Obat</td>
                    <td style="border: 1px solid black; text-align: center;">Jumlah Obat</td>
                    <td style="border: 1px solid black; text-align: center;">Keterangan</td>
                </tr>
                @foreach ($records as $key => $item)
                <tr>
                    <td style="border: 1px solid black; vertical-align:top; text-align: center;">{{ $key+1 }}</td>
                    <td style="border: 1px solid black; vertical-align:top;">{{ ucwords($item->{'obat_nama'}) }}</td>
                    <td style="border: 1px solid black; vertical-align:top;">{{ ucwords($item->{'jenobat_nama'}) }}</td>
                    <td style="border: 1px solid black; vertical-align:top;">{{ ucwords($item->{'resep_jumlah'}) }}</td>
                    <td style="border: 1px solid black; vertical-align:top;">{{ ucwords($item->{'resep_keterangan'}) }}</td>
                </tr>
                @endforeach
            </table>
        </td>
        <td style="width: 50%; vertical-align: top;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="border: 1px solid black; background-color: #abeef2;"><strong>Telaah Resep</strong></td>
                </tr>
                @php
                    $telaah_resep = [
                        'kejelasan penulisan resep',
                        'kelengkapan administrasi resep',
                        'benar pasien',
                        'benar obat',
                        'benar dosis',
                        'benar aturan pakai',
                        'benar cara pemberian',
                        'duplikasi',
                        'alergi',
                        'interaksi obat',
                        'kontraindikasi',
                    ];
                    $telaah_obat = [
                        'benar pasien',
                        'benar indikasi',
                        'benar obat',
                        'benar dosis',
                        'benar waktu pemakaian',
                        'benar cara pemberian',
                        'benar dokumentasi',
                        'benar informasi',
                        'waspada efek samping obat',
                    ];
                @endphp
                @foreach ($telaah_resep as $item)
                <tr>
                    <td style="border: 1px solid black; width: 70%;">{{ ucwords($item) }}</td>
                    <td style="border: 1px solid black"></td>
                </tr>
                @endforeach
            </table>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="border: 1px solid black; background-color: #abeef2;"><strong>Telaah Obat</strong></td>
                </tr>
                @foreach ($telaah_obat as $item)
                <tr>
                    <td style="border: 1px solid black; width: 70%;">{{ ucwords($item) }}</td>
                    <td style="border: 1px solid black"></td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black; width: 50%;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%;">Nama Pasien</td>
                    <td style="width: 2%;">:</td>
                    <td colspan="4" style="width: 15%;">{{ $pasien->{'pasien_nama'} }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;">Tanggal Lahir</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 35%;">{{ date('d F Y', strtotime($pasien->{'pasien_tgllahir'})) }}</td>
                    <td style="width: 15%;">Umur</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 16%;">{{ $pasien->{'pasien_umur'} }}thn</td>
                </tr>
                <tr>
                    <td style="width: 30%;">Berat Badan</td>
                    <td style="width: 2%;">:</td>
                    <td colspan="4" style="width: 15%;">{{ $pasien->{'pasien_berat_badan'} }}kg</td>
                </tr>
            </table>
        </td>
        <td style="width: 50%;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid black; width: 50%; text-align: center;">Paraf & Nama Petugas Farmasi</td>
                    <td style="border: 1px solid black; width: 50%; text-align: center;">Paraf & Nama Pasien</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; height: 75px;" align="center"><div style="padding-top: 50px">(.............................)</div></td>
                    <td style="border: 1px solid black; height: 75px;" align="center"><div style="padding-top: 50px">(.............................)</div></td>
                </tr>
            </table>
        </td>
    </tr>
</table>