<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class database extends Model
{

    public function tampil($table)
    {
        return DB::table($table)
        ->get();
    }

    public function tambah($table, $data)
    {
        return DB::table($table)->insert($data);
    }

    public function ubah($table, $where, $data)
    {
        return DB::table($table)->where($where)->update($data);
    }

    public function hapus($table, $where)
    {
        return DB::table($table)->where($where)->delete();
    }

    public function tarik($table, $where)
    {
        return DB::table($table)->where($where)->first();
    }

    public function joins()
    {
        return DB::table('karyawan')
            ->join('user', 'karyawan.id_user', '=', 'user.id_user')
            ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->join('agama', 'karyawan.id_agama', '=', 'agama.id_agama')
            ->get();
    }

   
}