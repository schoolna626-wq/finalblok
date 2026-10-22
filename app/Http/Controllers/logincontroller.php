<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\database;

class logincontroller extends Controller
{
    public function index(){
        return view ('/login');
    }

    public function aksilogin(Request $Request){
        $username= $Request->input('u');
        $password= $Request->input('p');
        $where= array(
        'username'=>$username,
        'password'=> $password
    );

        $jalur= new database;
        $hasilcek = $jalur->tarik('user', $where);

        if($hasilcek){
            session(['u'=>$hasilcek->username]);
            return redirect ()->intended('/home');
        }
        else{
            return redirect ()->intended('/');
        }
    }

    public function home(Request $request)
{
    if (session('u')) {
        $from = $request->input('from');
        $to = $request->input('to');

        $jalur = new database;
        $hello['data'] = $jalur->tampilTanggal('user', $from, $to);
        
        $hello['filters'] = [
            'from' => $from,
            'to' => $to
        ];

        return view('home', $hello);
    } else {
        return redirect()->intended('/');
    }
}

    public function exportUsersExcel(Request $Request)
    {
        if (!session('u')) {
            return redirect('/');
        }

        return Excel::download(
            new UsersExport($this->filteredUsers($Request)),
            'data-users.xlsx'
        );
    }

    public function exportUsersPdf(Request $Request)
    {
        if (!session('u')) {
            return redirect('/');
        }

        $data = $this->filteredUsers($Request);
        $pdf = new \TCPDF();
        $pdf->SetTitle('Data User');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
        $pdf->writeHTML(view('users-pdf', ['data' => $data])->render(), true, false, true, false, '');

        return response($pdf->Output('data-user.pdf', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="data-user.pdf"');
    }

  private function filteredUsers(Request $request)
{
    $query = DB::table('user')
        ->select('id_user', 'username', 'email', 'level', 'created_at')
        ->orderBy('created_at')
        ->orderBy('id_user');

    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    return $query->get();
}

    public function logout(){
        session()->flush();
        return redirect()->intended('/');
    }

    
public function zano(Request $Request)
    {
    $us = $Request->input('u');
    $ps = $Request->input('p');
    $em = $Request->input('e');
    

   $data = array(
    'username' => $us,
    'password' => $ps,
    'email' => $em,
    'level' => 'pelanggan',
    'created_at' => now(),
    'updated_at' => now()
    );

    $jalur = new database;
    $jalur->tambah('user', $data);

    return redirect()->intended('/');
    }

    public function tampil(){
        return view ('/girasya');
    }

    
    
    public function editview($id)
    {
        $jalur = new database;
        $user = $jalur->tarik('user', ['id_user' => $id]);

        return view('edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $jalur = new database;
        $data['updated_at'] = now();
        $jalur->ubah('user', ['id_user' => $id], $data);

        return redirect('/home');
    }

    public function delete($id)
{
    $jalur = new database;

    $jalur->hapus('karyawan', ['id_user' => $id]);

    $jalur->hapus('user', ['id_user' => $id]);

    return redirect('/home');
}



    public function karyawan()
    {
        $jalur = new database;

        $data['karyawan'] = $jalur->tampil('karyawan');
        $data['jabatan'] = $jalur->tampil('jabatan');
        $data['agama'] = $jalur->tampil('agama');

        return view('karyawan', $data);
    }


    public function tkry()
    {
        $jalur = new database;

        $data['jabatan'] = $jalur->tampil('jabatan');
        $data['agama'] = $jalur->tampil('agama');

        return view('tkry', $data);
    }
 
    

    public function aksi_tkry(Request $Request)
    {
        $nama = $Request->input('nama');
        $alamat = $Request->input('alamat');
        $jk = $Request->input('jk');
        $jb = $Request->input('jabatan');
        $ag = $Request->input('agama');

        $Kelvin = new database;

        $y = array('username' => session('u'));
        $cek = $Kelvin->tarik('user', $y);

        if (!$cek) {
            return redirect()->intended('/');
        }

        $kry = array(
            'id_user' => $cek->id_user,
            'nama_kry' => $nama,
            'alamat_kry' => $alamat,
            'jk_kry' => $jk,
            'id_jabatan' => $jb,
            'id_agama' => $ag
        );

        $Kelvin->tambah('karyawan', $kry);

        return redirect()->intended('/karyawan');
    }

    public function tplg()
    {
        $jalur = new database;
        $data['user'] = $jalur->tampil('user');

        return view('tplg', $data);
    }

    
    public function aksi_tplg(Request $Request)
    {
        $nama = $Request->input('nama');
        $alamat = $Request->input('alamat');
        $no_hp = $Request->input('no_hp');

        $data = array(
            'nama_plg' => $nama,
            'alamat_plg' => $alamat,
            'no_hp' => $no_hp
        );

        $jalur = new database;
        $jalur->tambah('pelanggan', $data);

        return redirect('/pelanggan');
    }
    public function pelanggan()
    {
        $jalur = new database;

        $data['pelanggan'] = $jalur->tampil('pelanggan');

        return view('pelanggan', $data);
    }



}