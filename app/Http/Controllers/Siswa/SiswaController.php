<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
      /**  
     * =============================================================*
     * 
     * Function Cari Siswa
     * 
     * ==============================================================*/
    public function CariSiswa(Request $req)
        {
            $email = $req->inputEmail;
            $Captcha = $req->inputCaptcha;

            if($email == ''){
                return response()->json(['status' => 2,
                'pesan' => 'Email dan Password tidak boleh kosong'.$email.$Captcha,
            ]);
            }elseif ($Captcha == ''){
                    return response()->json(['status' => 2,
                    'pesan' => 'captcha tidak boleh kosong',
                ]);                
            }
             // /**  Verifikasi Kode Captcha
            //  * ==================================================================================================*/
            if (!captcha_api_check($req->inputCaptcha, $req->key)){
                return response()->json(['status' => 2, 'pesan' => 'Verifikasi kode captcha tidak sesuai' ]);
            }

            /**  
             * Start cari data siswa
             * ==================================================================================================*/
            $data_siswa = DB::connection('mysql2_siak')->table('siswa')
            ->join('unit_sekolah','siswa.kd_unit','=','unit_sekolah.kode_unit')
            ->Where("siswa.email","=",$email )
            ->select('siswa.*','unit_sekolah.*')
            ->limit(1)->get();
            
            /**  
         * Selection data siswa atau data walas
         * ==================================================================================================*/
         if (!$data_siswa->isEmpty()) {
            //berhasil ada data siswa
            foreach ($data_siswa as $key => $arr_p) 
            {
               $nomor_induk = ($arr_p->nomor_induk);
               $nm_siswa = ($arr_p->nm_siswa);
               $email = ($arr_p->email);
               $nama_unit = ($arr_p->nama_unit);
               $hp = ($arr_p->hp);
            }

           return response()->json(['status' => 1,
           'nomor_induk' => $nomor_induk,
           'nama_siswa' => $nm_siswa,
           'email' => $email,
           'nama_unit' =>$nama_unit,
           'hp' => $hp,
           'level_role' => 3
           ]);


        }else{
            //Gagal respon
            return response()->json(['status' => 2,
            'pesan' => 'Email tidak ditemukan di database my istiqomah silakan Hub Walas'
            ]);
        }
       

  
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
