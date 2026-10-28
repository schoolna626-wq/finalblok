
<!DOCTYPE html>
<html>
<head>
    <title>Input Pelanggan</title>
</head>
<body>

<h1>Input Pelanggan</h1>

<form action="/aksi_tplg" method="POST">
    @csrf

    Nama Pelanggan:
    <input type="text" name="nama" required><br>

    Alamat:
    <input type="text" name="alamat" required><br>

    No HP:
    <input type="text" name="no_hp" required><br>

    <button type="submit" class="btn btn-warning">Simpan</button>

</form>

</body>
</html>
