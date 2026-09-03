<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ strtoupper($submission->letter_type) }} - {{ $submission->reference_number }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; color: #000; padding: 40px; background: #fff; margin: 0; }
        
        /* === KOP SURAT === */
        .kop-wrapper { width: 100%; margin-bottom: 0; }
        .kop-table { width: 100%; border-collapse: collapse; }
        .kop-logo-left { width: 90px; vertical-align: middle; text-align: center; padding-right: 10px; }
        .kop-logo-left img { width: 80px; height: auto; }
        .kop-center { text-align: center; vertical-align: middle; }
        .kop-logo-right { width: 90px; vertical-align: middle; text-align: center; padding-left: 10px; }
        .kop-logo-right img { width: 75px; height: auto; }

        .kop-center .yayasan { font-size: 11pt; font-weight: bold; text-transform: uppercase; margin: 0; letter-spacing: 1px; }
        .kop-center .sekolah { font-size: 18pt; font-weight: bold; text-transform: uppercase; margin: 0; }
        .kop-center .sekolah-quote { font-family: 'Georgia', 'Times New Roman', serif; font-style: italic; }
        .kop-center .akreditasi { font-size: 11pt; font-weight: bold; text-transform: uppercase; margin: 0; letter-spacing: 2px; }
        .kop-center .nss-npsn { font-size: 10pt; font-weight: bold; margin: 2px 0 0 0; }

        /* Kompetensi Keahlian */
        .kompetensi-box { margin: 6px auto 0 auto; width: 100%; }
        .kompetensi-box table { width: 100%; border-collapse: collapse; }
        .kompetensi-label { font-size: 8pt; font-weight: bold; text-transform: uppercase; vertical-align: top; white-space: nowrap; padding-right: 4px; }
        .kompetensi-list { font-size: 8pt; text-transform: uppercase; }
        .kompetensi-col { width: 33%; padding: 0 4px; vertical-align: top; }

        /* Alamat bar */
        .address-bar { 
            background: #1e295b; 
            color: #fff; 
            text-align: center; 
            font-size: 8.5pt; 
            font-weight: bold; 
            padding: 5px 10px; 
            margin-top: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .address-bar .website { font-size: 8pt; text-transform: none; }

        /* Garis pemisah kop */
        .kop-divider { border: none; border-top: 3px double #000; margin: 0 0 20px 0; }

        /* === JUDUL SURAT === */
        .title-surat { text-align: center; margin-bottom: 25px; margin-top: 20px; }
        .title-surat h3 { margin: 0; font-size: 13pt; text-decoration: underline; text-transform: uppercase; font-weight: bold; }
        .title-surat p { margin: 4px 0 0 0; font-size: 11pt; }

        /* === TABEL DATA === */
        .table-data { width: 100%; margin: 15px 0; border-collapse: collapse; }
        .table-data td { padding: 4px 0; vertical-align: top; }

        /* === QR & TANDA TANGAN === */
        .qr-container { display: flex; align-items: center; justify-content: space-between; margin-top: 40px; page-break-inside: avoid; }
        .qr-box { text-align: center; border: 1px solid #cbd5e1; padding: 10px; border-radius: 8px; width: 140px; }
        .qr-box p { font-size: 8pt; margin-top: 5px; font-family: sans-serif; color: #475569; }
        .signature-box { text-align: center; width: 220px; }

        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <!-- Floating Print Button -->
    <div class="no-print" style="position: fixed; top: 20px; right: 20px;">
        <button onclick="window.print()" style="background: #2563eb; color: #fff; border: none; padding: 10px 18px; font-weight: bold; border-radius: 8px; cursor: pointer;">
            Cetak Surat (PDF)
        </button>
    </div>

    <!-- ============================================ -->
    <!-- KOP SURAT RESMI SMK ANTARTIKA 2 SIDOARJO     -->
    <!-- ============================================ -->
    <div class="kop-wrapper">
        <table class="kop-table">
            <tr>
                <!-- LOGO KIRI: Taruh file logo di public/kop_logo_left.png -->
                <td class="kop-logo-left">
                    @if(file_exists(public_path('kop_logo_left.png')))
                        <img src="{{ asset('kop_logo_left.png') }}" alt="Logo Kiri">
                    @else
                        <div style="width:80px;height:80px;border:2px dashed #ccc;display:flex;align-items:center;justify-content:center;font-size:7pt;color:#999;text-align:center;">LOGO<br>KIRI</div>
                    @endif
                </td>
                <!-- TEKS KOP TENGAH -->
                <td class="kop-center">
                    <p class="yayasan">Yayasan Pendidikan Wahyuhana Surabaya</p>
                    <p class="sekolah">SMK <span class="sekolah-quote">"Antartika 2"</span> Sidoarjo</p>
                    <p class="akreditasi">Terakreditasi "A"</p>
                    <p class="nss-npsn">NSS. 344050202038 &nbsp;&nbsp; NPSN. 20540077</p>
                </td>
                <!-- LOGO KANAN: Taruh file logo di public/kop_logo_right.png -->
                <td class="kop-logo-right">
                    @if(file_exists(public_path('kop_logo_right.png')))
                        <img src="{{ asset('kop_logo_right.png') }}" alt="Logo Kanan">
                    @else
                        <div style="width:75px;height:75px;border:2px dashed #ccc;display:flex;align-items:center;justify-content:center;font-size:7pt;color:#999;text-align:center;">LOGO<br>KANAN</div>
                    @endif
                </td>
            </tr>
        </table>

        <!-- KOMPETENSI KEAHLIAN -->
        <div class="kompetensi-box">
            <table>
                <tr>
                    <td class="kompetensi-label" rowspan="2" style="vertical-align: middle;">Kompetensi Keahlian :</td>
                    <td class="kompetensi-col kompetensi-list">1. Rekayasa Perangkat Lunak</td>
                    <td class="kompetensi-col kompetensi-list">2. Teknik Komputer dan Jaringan</td>
                    <td class="kompetensi-col kompetensi-list">3. Teknik Mekatronika (TM)</td>
                </tr>
            </table>
        </div>

        <!-- ALAMAT BAR -->
        <div class="address-bar">
            Jalan Siwalanpanji Kec. Buduran Telp/Fax. (031) 8065117 Kodepos 61252 Sidoarjo
            <br>
            <span class="website">WEBSITE : http://smkantartika2-sda.sch.id</span>
        </div>
    </div>

    <hr class="kop-divider">

    <!-- JUDUL SURAT -->
    <div class="title-surat">
        <h3>{{ strtoupper($submission->letter_type) }}</h3>
        <p>Nomor : {{ $submission->reference_number }}</p>
    </div>

    @php
        $bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $tglMulai = date('d', strtotime($submission->start_date)) . ' ' . $bulanIndo[(int)date('n', strtotime($submission->start_date)) - 1] . ' ' . date('Y', strtotime($submission->start_date));
        $tglSelesai = date('d', strtotime($submission->end_date)) . ' ' . $bulanIndo[(int)date('n', strtotime($submission->end_date)) - 1] . ' ' . date('Y', strtotime($submission->end_date));
        $tglRange = ($submission->start_date == $submission->end_date) ? $tglMulai : $tglMulai . ' - ' . $tglSelesai;
        
        $hariIndo = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $hariStart = $hariIndo[date('l', strtotime($submission->start_date))];
        $hariEnd = $hariIndo[date('l', strtotime($submission->end_date))];
        $hariRange = ($submission->start_date == $submission->end_date) ? $hariStart : $hariStart . ' - ' . $hariEnd;
    @endphp

    <!-- DINAMIS SESUAI JENIS SURAT -->
    @if($submission->letter_type === 'Surat Rekomendasi')
        <!-- ==================== SURAT REKOMENDASI ==================== -->
        <p>Sehubungan dengan adanya event <strong>"{{ $submission->event_name }}"</strong>, maka kami yang bertanda tangan di bawah ini :</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="25%">Nama</td>
                <td width="3%">:</td>
                <td><strong>Drs. Mujib, M.Pd</strong></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Kepala Sekolah</td>
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td>SMK Antartika 2 Sidoarjo</td>
            </tr>
        </table>

        <p>Dengan ini memberikan rekomendasi kepada siswa SMK Antartika 2 Sidoarjo di bawah ini:</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="25%">Nama Siswa</td>
                <td width="3%">:</td>
                <td><strong>{{ $submission->student->name }}</strong></td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $submission->student->nis_nip }}</td>
            </tr>
            <tr>
                <td>Kelas / Jurusan</td>
                <td>:</td>
                <td>{{ $submission->student->class_name }} ({{ $submission->student->major }})</td>
            </tr>
        </table>

        <p>Untuk mengikuti kejuaraan / kegiatan tersebut di atas pada :</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="25%">Hari</td>
                <td width="3%">:</td>
                <td>{{ $hariRange }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><strong>{{ $tglRange }}</strong></td>
            </tr>
            <tr>
                <td>Tempat / Penyelenggara</td>
                <td>:</td>
                <td>{{ $submission->event_organizer ?? 'GOR / Tempat Penyelenggara' }}</td>
            </tr>
        </table>

        <p>Demikian surat rekomendasi ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

    @elseif($submission->letter_type === 'Surat Pernyataan Sekolah')
        <!-- ==================== SURAT PERNYATAAN SEKOLAH ==================== -->
        <p>Yang bertanda tangan di bawah ini, Kepala Sekolah SMK "Antartika 2" Sidoarjo menerangkan dan menyatakan bahwa:</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="30%">Nama Siswa</td>
                <td width="3%">:</td>
                <td><strong>{{ $submission->student->name }}</strong></td>
            </tr>
            <tr>
                <td>NIS / NIP</td>
                <td>:</td>
                <td>{{ $submission->student->nis_nip }}</td>
            </tr>
            <tr>
                <td>Kelas / Jurusan</td>
                <td>:</td>
                <td>{{ $submission->student->class_name }} ({{ $submission->student->major }})</td>
            </tr>
        </table>

        <p>Adalah benar-benar siswa aktif terdaftar di SMK "Antartika 2" Sidoarjo. Dengan ini sekolah menyatakan bahwa yang bersangkutan diberikan izin/pernyataan resmi terkait kegiatan:</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="30%">Nama Kegiatan</td>
                <td width="3%">:</td>
                <td><strong>{{ $submission->event_name }}</strong></td>
            </tr>
            <tr>
                <td>Penyelenggara</td>
                <td>:</td>
                <td>{{ $submission->event_organizer ?? 'Panitia Resmi' }}</td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td>:</td>
                <td><strong>{{ $tglRange }}</strong></td>
            </tr>
            <tr>
                <td>Keterangan / Alasan</td>
                <td>:</td>
                <td>{{ $submission->reason }}</td>
            </tr>
        </table>

        <p>Demikian surat pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

    @else
        <!-- ==================== SURAT DISPENSASI (DEFAULT) ==================== -->
        <p>Yang bertanda tangan di bawah ini, Kepala Sekolah / Wali Kelas SMK "Antartika 2" Sidoarjo menerangkan bahwa:</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="30%">Nama Lengkap</td>
                <td width="3%">:</td>
                <td><strong>{{ $submission->student->name }}</strong></td>
            </tr>
            <tr>
                <td>NIS / NIP</td>
                <td>:</td>
                <td>{{ $submission->student->nis_nip }}</td>
            </tr>
            <tr>
                <td>Kelas / Jurusan</td>
                <td>:</td>
                <td>{{ $submission->student->class_name }} ({{ $submission->student->major }})</td>
            </tr>
        </table>

        <p>Diberikan perizinan / dispensasi untuk tidak mengikuti kegiatan belajar mengajar (KBM) pada:</p>

        <table class="table-data" style="margin-left: 20px;">
            <tr>
                <td width="30%">Nama Kegiatan/Lomba</td>
                <td width="3%">:</td>
                <td><strong>{{ $submission->event_name }}</strong></td>
            </tr>
            <tr>
                <td>Penyelenggara</td>
                <td>:</td>
                <td>{{ $submission->event_organizer ?? 'Panitia Penyelenggara Resmi' }}</td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td>:</td>
                <td><strong>{{ $tglRange }}</strong></td>
            </tr>
            <tr>
                <td>Keterangan / Perihal</td>
                <td>:</td>
                <td>{{ $submission->reason }}</td>
            </tr>
        </table>

        <p>Demikian surat perizinan ini diterbitkan secara sah untuk dipergunakan sebagaimana mestinya.</p>
    @endif

    <!-- QR CODE & TANDA TANGAN DIGITAL -->
    <div class="qr-container">
        <div class="qr-box">
            {!! $qrCode !!}
            <p>Scan QR Code di atas untuk verifikasi keaslian surat digital</p>
        </div>

        <div class="signature-box">
            @php
                $tglCetak = date('d') . ' ' . $bulanIndo[(int)date('n') - 1] . ' ' . date('Y');
            @endphp
            <p>Sidoarjo, {{ $tglCetak }}<br>Kepala SMK Antartika 2 Sidoarjo</p>
            <div style="height: 40px;"></div>
            <p style="text-decoration: underline; font-weight: bold; margin-bottom: 0;">Drs. Mujib, M.Pd</p>
            <p style="font-size: 10pt; margin-top: 0;">NIP. 123401012010011002</p>
        </div>
    </div>

</body>
</html>
