<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use DB;

class PermohonanController extends Controller
{
    public function show(string $id){

        ///*** cek Apakah Ada stimulus //  
    $getCekPermohonan = DB::connection('mysql2_siak')->table('permohonan')
    ->where('nomor_induk',$id)
    ->where('is_status_aktif',1)
    ->orderBy('created_at','DESC')
    ->limit(1)->get();

        if($getCekPermohonan->count())
        {
            foreach ($getCekPermohonan as $key => $arr_s) {
                $tanggal_berakhir = $arr_s->tanggal_berakhir;

                ///////***Suarat Permohonana dalam waktu periode */
                $date = new DateTime("now", new DateTimeZone('Asia/jakarta') );
                $currentDate = $date->format('Y-m-d H:i:s');
                $currentDate = date('Y-m-d H:i:s', strtotime($currentDate));          
                $endDate = date('Y-m-d H:i:s', strtotime($tanggal_berakhir));      
                if ($currentDate >= $endDate){         
                return response()->json([
                    'status' => 101,
                    'pesan' => 'Gagal Surat Permohonan Sudah tidak berlaku atau belum di validasi dan segera urus administrasi',
                    ]); 
                }else{       
                // berhasil          
                    return response()->json([
                        'status' => 200,
                        'pesan' => 'Surat Permohonan di setujui'
                    ]);   
                }    
            }
        }else{
            return response()->json([
                'status' => 100,
                'pesan' => 'permohonan tidak ada'
            ]);   
        }
            
    }
}
