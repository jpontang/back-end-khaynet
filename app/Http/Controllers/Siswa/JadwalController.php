<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JadwalController extends Controller
{
    public function show(string $nomor_induk)
    {
        ////***get data siswa rombel///
        $data_rombel = DB::connection('mysql2_siak')->table('rombel')
        ->join('kelas','rombel.id_kelas','=','kelas.id_kelas')
        ->join('unit_sekolah','kelas.kode_unit','=','unit_sekolah.kode_unit')
        ->where('rombel.nomor_induk',$nomor_induk)
        ->get();
        if($data_rombel->count()){
        foreach ($data_rombel as $key => $arr_s) {
            $kode_unit = $arr_s->kode_unit;
            $nama_unit = $arr_s->nama_unit;
            $kepala_unit = $arr_s->kepala_unit;
            $id_kelas = ltrim($arr_s->id_kelas,'0');
            $nm_kelas = $arr_s->nama_kelas;
            $id_tingkatan = $arr_s->id_tingkatan;
            }
        }else{
            return response()->json([
                'status' => 200,
                'pesan' => 'Surat Permohonan di setujui rombel',
                'data' => $data_rombel
            ]);

        }

         //////////************** Start data soal **************//////////
        ///****get data soal
        if($kode_unit == 4 || $kode_unit == 7)
        {
            $unit = [4,7];
            $dataBankSoal =  DB::connection('mysql3_myistiqomah')->table('bank_soal')
            ->where('id_tingkatan',$id_tingkatan )
            ->whereIn('kd_unit', $unit)
            ->select(
                DB::raw("DATE_FORMAT(waktu_mulai, '%W') hari"),
                DB::raw("DATE(waktu_mulai) tgl_ujian"),
                DB::raw("JSON_ARRAYAGG(JSON_OBJECT('jd',bank_soal.judul,'wkt',TIME_FORMAT(bank_soal.waktu_ujian, '%H:%i'))) as  soal")
                // DB::raw("JSON_ARRAYAGG(JSON_OBJECT('jd',bank_soal.judul ,'wkt',bank_soal.waktu_ujian)) as  soal")
                )
            ->orderBy('waktu_mulai', 'asc')
            ->groupBy('waktu_mulai') 
            ->get()->toArray();
            }else{
            $dataBankSoal =  DB::connection('mysql3_myistiqomah')->table('bank_soal')
            ->where('id_tingkatan',$id_tingkatan )
            ->where('kd_unit',$kode_unit )
            ->select('waktu_mulai as tgl_mulai',
                DB::raw("DATE_FORMAT(waktu_mulai, '%W') hari"),
                DB::raw("DATE(waktu_mulai) tgl_ujian"),
                DB::raw("JSON_ARRAYAGG(JSON_OBJECT('jd',bank_soal.judul,'wkt',TIME_FORMAT(bank_soal.waktu_ujian, '%H:%i'))) as  soal")
                )
            ->orderBy('waktu_mulai', 'asc')
            ->groupBy('waktu_mulai')            
            ->get()->toArray();
        }

        return response()->json([
            'status' => 200,
            'pesan' => 'Surat Permohonan di setujui',
            'data' => $dataBankSoal
        ]);
    }
}
