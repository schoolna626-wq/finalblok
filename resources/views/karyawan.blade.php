<!DOCTYPE html>
<html lang="en">
<head>
    <title>DATA KARYAWAN</title>
</head>
<body>

<h1>Data Karyawan</h1>

<a href="/tkry"><button>Tambah Karyawan</button></a>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Alamat Karyawan</th>
            <th>Jabatan</th>
            <th>Agama</th>
            
        </tr>

        <?php
        $no=1;
        foreach ($karyawan as $key => $value) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $value->nama_kry ?></td>
            <td><?= $value->alamat_kry ?></td>
            <td><?= $value->id_jabatan ?></td>
            <td><?= $value->id_agama ?></td>
            
        </tr>
        <?php
        }
        ?>
    </table>




<a href="/home"><button>Kembali ke Dashboard</button></a>

</body>
</html>
