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
    <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Menu Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Data Master</li>

    <!-- Menu Karyawan -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/karyawan') }}">
        <i class="bi bi-people"></i>
        <span>Data Karyawan</span>
      </a>
    </li>

    <!-- Menu Pelanggan -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/pelanggan') }}">
        <i class="bi bi-person-lines-fill"></i>
        <span>Data Pelanggan</span>
      </a>
    </li>

    <li class="nav-heading">Pengaturan</li>

    <!-- Menu Profile -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/profile') }}">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li>

    <!-- Menu Logout -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/logout') }}">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Logout</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar-->

        
        <nav class="navbar navbar-dark bg-dark no-print">
        <div class="container-fluid d-flex flex-wrap">
            <a class="navbar-brand" href="/home">Garage Motorcycle</a>

            <div class="navbar-nav flex-row flex-wrap gap-3">
                <a class="nav-link active" href="/home">Home</a>
                <a class="nav-link" href="/karyawan">Karyawan</a>
                <a class="nav-link" href="/pelanggan">Pelanggan</a>
                <a class="nav-link" href="/logout">Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">



<h1 class="no-print">Welcome to the dashboard <?php echo session('u') ?></h1>
<h1 class="print-title">Data Pengguna</h1>



<p class="no-print">
    <a href="/users/export/excel">
        <button type="button" class="btn btn-secondary" >Export Excel</button>
    </a>
    <a href="/users/export/pdf" target="_blank">
        <button type="button" class="btn btn-primary">Export PDF</button>
    </a>
    <button type="button" onclick="window.print()" class="btn btn-dark">Print</button>
</p>

<br>

<table id="users-table" class="table table-bordered table-striped">
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



</div>
@endsection