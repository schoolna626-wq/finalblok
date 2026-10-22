@extends('template')
@section('content')
    <title>DASHBOARD</title>
    <style>
        .print-title {
            display: none;
        }

        @media print {
        @page {
            margin:0;
        }
        body {
            margin: 12mm;
        }

        .no-print,
        input,
        button,
        .btn,
        a,
        #users-table th:last-child,
        #users-table td:last-child:not([colspan]) {
            display: none !important;
        }

        .print-title {
            display: block;
        }
    }
    </style>

<h1 class="no-print">Welcome to the dashboard <?php echo session('u') ?></h1>
<h1 class="print-title">Data Pengguna</h1>

<form class="no-print" action="/tkry" method="GET">
    <button type="submit" class="btn btn-dark">Tambah Karyawan</button>
</form>

<form class="no-print" action="/tplg" method="GET">
    <button type="submit" class="btn btn-light">Tambah Pelanggan</button>
</form>

<form class="no-print" action="/pelanggan" method="GET">
    <button type="submit">Pelanggan</button>
</form>

<form class="no-print" action="/karyawan" method="GET">
    <button type="submit">Karyawan</button>
</form>

<form class="no-print" action="/home" method="GET">
    <label for="from">Dari Tanggal:</label>
    <input type="date" id="from" name="from" value="{{ request('from') }}">

    <label for="to">Sampai Tanggal:</label>
    <input type="date" id="to" name="to" value="{{ request('to') }}">

    <button type="submit">Filter</button>
    <a href="/home">Reset</a>

  
</form>

<p class="no-print">
    <a href="/users/export/excel?from={{ request('from') }}&to={{ request('to') }}">
        <button type="button">Export Excel</button>
    </a>
    <a href="/users/export/pdf?from={{ request('from') }}&to={{ request('to') }}" target="_blank">
        <button type="button">Export PDF</button>
    </a>
    <button type="button" onclick="window.print()">Print</button>
</p>

<br>

<table id="users-table" border="1" width="550">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no=1;
    foreach ($data as $key => $value) {
    ?>

    <tr>
        <td><?= $no++ ?></td>
        <td><?= $value->username ?></td>
        <td><?= $value->email ?></td>
        <td><?= $value->level ?></td>
        <td>
            <form action="/edit/<?= $value->id_user ?>" method="GET" style="display:inline;">
                <button type="submit" class="btn btn-danger" >Edit</button>
            </form>

            <form action="/delete/<?= $value->id_user ?>" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning" >Delete</button>
            </form>
        </td>
    </tr>

    <?php
    }
    ?>

</table>

<br>

<a class="no-print" href="/logout">
    <button>Logout</button>
</a>
@endsection
