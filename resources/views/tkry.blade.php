
<!DOCTYPE html>
<html>
<head>
    <title>Input Karyawan</title>
</head>
<body>

<h1>Input Karyawan</h1>

<form action="/aksi_tkry" method="POST">
    @csrf

    Username:
    <input type="text" name="u" required><br>

    Password:
    <input type="password" name="p" required><br>

    Email:
    <input type="email" name="e" required><br>

    Level:
    <select name="l" required>
        <option value="">-Pilih-</option>
        <option value="admin">Admin</option>
        <option value="karyawan">Karyawan</option>
        <option value="pelanggan">Pelanggan</option>
    </select><br>

    Nama Karyawan:
    <input type="text" name="nama" required><br>

    Alamat:
    <input type="text" name="alamat" required><br>

    Jenis Kelamin:
    <input type="radio" name="jk" value="L" required>Pria
    <input type="radio" name="jk" value="P">Wanita<br>

    Jabatan:
    <select name="jabatan">
        <option value="">-Pilih-</option>
        <?php
        foreach ($jabatan as $key => $value) {
        ?>
        <option value="<?= $value->id_jabatan ?>">
            <?= $value->nama_jabatan ?>
        </option>
        <?php
        }
        ?>
    </select><br>

    Agama:
    <select name="agama">
        <option value="">-Pilih-</option>
        <?php
        foreach ($agama as $key => $value) {
        ?>
        <option value="<?= $value->id_agama ?>">
            <?= $value->nama_agama ?>
        </option>
        <?php
        }
        ?>
    </select><br>

    <button type="submit" class="btn btn-warning">Simpan</button>
</form>

</body>
</html>
