<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class PDFController extends Controller
{
    public function show($id){
       $nomor_induk = $id;
       ////***get data siswa rombel///
       $data_rombel = DB::connection('mysql2_siak')->table('rombel')
       ->join('kelas','rombel.id_kelas','=','kelas.id_kelas')
       ->join('unit_sekolah','kelas.kode_unit','=','unit_sekolah.kode_unit')
       ->join('siswa','rombel.nomor_induk','=','siswa.nomor_induk')
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
               'status' => 201,
               'pesan' => 'Data Siswa Tidak ditemukan',
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
            ->select('judul',
                DB::raw("DATE_FORMAT(waktu_mulai, '%W') hari"),
                DB::raw("DATE(waktu_mulai) tgl_ujian"),
                DB::raw("TIME_FORMAT(bank_soal.waktu_ujian, '%H:%i') wkt")
                // DB::raw("JSON_ARRAYAGG(JSON_OBJECT('jd',bank_soal.judul,'wkt',TIME_FORMAT(bank_soal.waktu_ujian, '%H:%i:%s'))) as  soal")
                // DB::raw("JSON_ARRAYAGG(JSON_OBJECT('jd',bank_soal.judul ,'wkt',bank_soal.waktu_ujian)) as  soal")
                )
            ->orderBy('waktu_mulai', 'asc')
            ->get();
            }else{
            $dataBankSoal =  DB::connection('mysql3_myistiqomah')->table('bank_soal')
            ->where('id_tingkatan',$id_tingkatan )
            ->where('kd_unit',$kode_unit )
            ->select('waktu_mulai as tgl_mulai',
                DB::raw("DATE_FORMAT(waktu_mulai, '%W') hari"),
                DB::raw("DATE(waktu_mulai) tgl_ujian"),
                DB::raw("TIME_FORMAT(bank_soal.waktu_ujian, '%H:%i') wkt")
                // DB::raw("JSON_ARRAYAGG(JSON_OBJECT('jd',bank_soal.judul,'wkt',TIME_FORMAT(bank_soal.waktu_ujian, '%H:%i:%s'))) as  soal")
                )
            ->orderBy('waktu_mulai', 'asc')
            ->groupBy('waktu_mulai')            
            ->get();
        }


        $pdf = PDF::loadView('print.jadwalUjian', [
            'siswa'=>$data_rombel ,
            'jadwal' => $dataBankSoal
     ]);
        return $pdf->download('BuktiDaftar.pdf');

    }
}
