
<?php
// DATA SIMULASI, TANPA DATABASE
$dataBansos = [
    [
        "nama" => "Budi Santoso",
        "bantuan" => "PKH",
        "status" => "Contoh: Terdaftar"
    ],
    [
        "nama" => "Siti Aminah",
        "bantuan" => "BPNT",
        "status" => "Contoh: Dalam Simulasi"
    ],
    [
        "nama" => "Andi Saputra",
        "bantuan" => "PBI-JK",
        "status" => "Contoh: Terdaftar"
    ]
];

$hasil = null;
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $bantuan = $_POST["bantuan"] ?? "";

    $jenisValid = ["PKH", "BPNT", "PBI-JK"];

    if ($nama === "" || !in_array($bantuan, $jenisValid, true)) {
        $pesan = "Silakan isi nama dan pilih jenis bantuan.";
    } else {
        foreach ($dataBansos as $data) {
            if (
                strcasecmp($data["nama"], $nama) === 0 &&
                $data["bantuan"] === $bantuan
            ) {
                $hasil = $data;
                break;
            }
        }

        if ($hasil === null) {
            $pesan = "Data contoh tidak ditemukan. Periksa kembali nama dan jenis bantuan.";
        }
    }
}

function e($teks) {
    return htmlspecialchars(
        (string) $teks,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cek Bansos | Simulasi</title>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f8f5;
    color: #24352e;
    line-height: 1.6;
}

header {
    background: white;
    padding: 17px 6%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 10px #00000008;
}

.logo {
    color: #087f5b;
    font-size: 21px;
    font-weight: bold;
}

nav a {
    color: #34443c;
    text-decoration: none;
    margin-left: 15px;
    font-size: 14px;
}

.hero {
    padding: 65px 7%;
    background: linear-gradient(135deg, #087f5b, #10a879);
    color: white;
}

.hero span {
    display: inline-block;
    background: #ffffff25;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 12px;
    margin-bottom: 15px;
}

.hero h1 {
    font-size: clamp(30px, 5vw, 45px);
    line-height: 1.2;
    max-width: 650px;
    margin-bottom: 16px;
}

.hero p {
    max-width: 600px;
    color: #e4fff2;
    margin-bottom: 24px;
}

.btn {
    display: inline-block;
    background: #087f5b;
    color: white;
    border: none;
    border-radius: 9px;
    padding: 13px 18px;
    font-size: 15px;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
}

.hero .btn {
    background: white;
    color: #087f5b;
}

.container {
    width: 90%;
    max-width: 1050px;
    margin: 40px auto;
}

.judul {
    font-size: 26px;
    margin-bottom: 7px;
}

.deskripsi {
    color: #718078;
    margin-bottom: 24px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 45px;
}

.card {
    background: white;
    padding: 22px;
    border-radius: 14px;
    border: 1px solid #e4eee7;
}

.card .icon {
    font-size: 28px;
    margin-bottom: 8px;
}

.card h3 {
    margin-bottom: 7px;
}

.card p {
    color: #718078;
    font-size: 14px;
}

.content {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 22px;
    align-items: start;
}

.panel {
    background: white;
    padding: 25px;
    border-radius: 15px;
    border: 1px solid #e4eee7;
    box-shadow: 0 5px 20px #00000005;
}

label {
    display: block;
    margin: 17px 0 7px;
    font-size: 14px;
    font-weight: bold;
}

input, select {
    width: 100%;
    padding: 13px;
    border: 1px solid #d6e2da;
    border-radius: 8px;
    font-size: 15px;
    background: white;
}

input:focus, select:focus {
    outline: 2px solid #a8dfc3;
    border-color: #087f5b;
}

.submit {
    width: 100%;
    margin-top: 20px;
}

.result {
    margin-top: 22px;
    padding: 18px;
    background: #eaf8ef;
    border: 1px solid #c8e8d3;
    border-radius: 11px;
    overflow-wrap: anywhere;
}

.result h3 {
    color: #087f5b;
    margin-bottom: 10px;
}

.result p {
    margin: 6px 0;
    font-size: 14px;
}

.error {
    background: #fff0ef;
    border-color: #ffd2ce;
}

.error h3 {
    color: #b42318;
}

.status {
    display: inline-block;
    background: #d4f3df;
    color: #08633f;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.note {
    color: #718078;
    font-size: 12px;
    margin-top: 14px;
}

.info-list {
    padding-left: 20px;
}

.info-list li {
    margin: 13px 0;
    color: #68766e;
    font-size: 14px;
}

.warning {
    margin-top: 20px;
    padding: 15px;
    border-radius: 10px;
    background: #fff8df;
    border: 1px solid #efdfa5;
    font-size: 13px;
}

footer {
    text-align: center;
    padding: 25px 15px;
    background: #103d30;
    color: white;
    font-size: 13px;
}

footer p + p {
    color: #c9e3d7;
    margin-top: 5px;
}

@media (max-width: 700px) {
    header {
        align-items: flex-start;
        flex-direction: column;
    }

    nav a {
        margin: 0 12px 0 0;
    }

    .hero {
        padding: 48px 6%;
    }

    .cards, .content {
        grid-template-columns: 1fr;
    }

    .container {
        margin: 30px auto;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">🌿 CekBansos</div>

    <nav>
        <a href="#beranda">Beranda</a>
        <a href="#cek">Cek Bansos</a>
        <a href="#informasi">Informasi</a>
    </nav>
</header>

<section class="hero" id="beranda">
    <span>APLIKASI DEMONSTRASI PHP</span>

    <h1>Cek Informasi Bantuan Sosial</h1>

    <p>
        Simulasi pengecekan data bantuan sosial dengan tampilan
        sederhana, modern, dan mudah digunakan.
    </p>

    <a href="#cek" class="btn">Mulai Pengecekan →</a>
</section>

<main class="container">

    <h2 class="judul">Layanan Kami</h2>
    <p class="deskripsi">
        Fitur simulasi untuk belajar membuat aplikasi PHP.
    </p>

    <section class="cards">
        <div class="card">
            <div class="icon">🔎</div>
            <h3>Pencarian Data</h3>
            <p>Mencari nama pada data contoh yang tersedia.</p>
        </div>

        <div class="card">
            <div class="icon">📋</div>
            <h3>Informasi Bantuan</h3>
            <p>Mempelajari contoh kategori bantuan sosial.</p>
        </div>

        <div class="card">
            <div class="icon">📱</div>
            <h3>Responsif</h3>
            <p>Dapat dibuka melalui HP dan komputer.</p>
        </div>
    </section>

    <h2 class="judul" id="cek">Cek Data Penerima</h2>
    <p class="deskripsi">
        Gunakan nama contoh untuk mencoba fitur pencarian.
    </p>

    <section class="content">

        <div class="panel">
            <h3>Formulir Pengecekan</h3>

            <form method="POST" action="#cek">
                <label for="nama">Nama Penerima</label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    maxlength="80"
                    placeholder="Contoh: Budi Santoso"
                    value="<?= e($_POST['nama'] ?? '') ?>"
                    required
                >

                <label for="bantuan">Jenis Bantuan</label>

                <select id="bantuan" name="bantuan" required>
                    <option value="">-- Pilih bantuan --</option>

                    <?php
                    $jenisBantuan = [
                        "PKH" => "PKH",
                        "BPNT" => "BPNT",
                        "PBI-JK" => "PBI-JK"
                    ];

                    foreach ($jenisBantuan as $kode => $namaBantuan):
                    ?>
                        <option
                            value="<?= e($kode) ?>"
                            <?= (($_POST['bantuan'] ?? '') === $kode)
                                ? 'selected' : '' ?>
                        >
                            <?= e($namaBantuan) ?> (Simulasi)
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="btn submit">
                    🔍 Periksa Data
                </button>
            </form>

            <p class="note">
                Gunakan data contoh. Jangan masukkan NIK atau
                informasi pribadi asli.
            </p>

            <?php if ($hasil !== null): ?>
                <div class="result" role="status">
                    <h3>Hasil Simulasi</h3>

                    <p>
                        <strong>Nama:</strong>
                        <?= e($hasil['nama']) ?>
                    </p>

                    <p>
                        <strong>Jenis bantuan:</strong>
                        <?= e($hasil['bantuan']) ?>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <span class="status">
                            <?= e($hasil['status']) ?>
                        </span>
                    </p>

                    <p class="note">
                        Hasil ini hanya berasal dari data simulasi,
                        bukan status penerima bansos resmi.
                    </p>
                </div>

            <?php elseif ($pesan !== ""): ?>
                <div class="result error" role="alert">
                    <h3>Informasi Pencarian</h3>
                    <p><?= e($pesan) ?></p>
                    <p class="note">
                        Contoh: Budi Santoso / PKH,
                        Siti Aminah / BPNT,
                        atau Andi Saputra / PBI-JK.
                    </p>
                </div>
            <?php endif; ?>

        </div>

        <aside class="panel" id="informasi">
            <h3>Informasi Jenis Bantuan</h3>

            <ul class="info-list">
                <li>
                    <strong>PKH</strong><br>
                    Program Keluarga Harapan.
                </li>

                <li>
                    <strong>BPNT</strong><br>
                    Bantuan Pangan Non Tunai.
                </li>

                <li>
                    <strong>PBI-JK</strong><br>
                    Bantuan iuran Jaminan Kesehatan bagi peserta
                    yang memenuhi ketentuan.
                </li>
            </ul>

            <div class="warning">
                <strong>⚠️ Perhatian</strong><br>
                Aplikasi ini hanya simulasi untuk pembelajaran.
                Hasilnya bukan informasi resmi dari Kementerian Sosial.
            </div>
        </aside>

    </section>

</main>

<footer>
    <p><strong>CekBansos — Simulasi PHP</strong></p>
    <p>Dibuat untuk latihan pemrograman web.</p>
</footer>

</body>
</html>
