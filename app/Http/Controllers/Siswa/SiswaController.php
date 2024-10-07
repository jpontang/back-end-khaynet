<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
            
           $user =  DB::connection('mysql')->table('users')->where('email','=', $email)->limit(1)->get();
           if (!$user->isEmpty()) {
             $userEmpty = 1; //data tersedia
           }else{
                $userEmpty = 0;//data kosong
           }
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
           'level_role' => 3,
           'userEmpty' => $userEmpty
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
        $siswa = DB::connection('mysql2_siak')->table('siswa')
            ->join('unit_sekolah','siswa.kd_unit','=','unit_sekolah.kode_unit')
            ->leftjoin('rombel', 'siswa.nomor_induk','=','rombel.nomor_induk')
            ->leftjoin('kelas', 'rombel.id_kelas','=','kelas.id_kelas')
            ->Where("siswa.nomor_induk","=",$id )
            ->select('siswa.*','unit_sekolah.*','kelas.nama_kelas')
            ->limit(1)->get();

        $data_tunggakanAll = DB::connection('mysql2_siak')->table('tagihan')
            ->leftjoin('detil_tagihan', 'tagihan.id_record_tagihan','=','detil_tagihan.id_record_tagihan')
            ->leftjoin('rombel', 'tagihan.nomor_induk','=','rombel.nomor_induk')
            ->leftjoin('kelas', 'rombel.id_kelas','=','kelas.id_kelas')
            ->select(
              DB::raw('tagihan.nomor_induk, tagihan.nama'),
              DB::raw('kelas.nama_kelas'),
              DB::raw('SUM(tagihan.total_nilai_tagihan) as total'),
              DB::raw("(GROUP_CONCAT(detil_tagihan.label_jenis_biaya_panjang SEPARATOR ', ')) as `rincian`")
              )
            ->where('rombel.nomor_induk',$id)
           ->where('tagihan.is_tagihan_aktif',1)
           ->groupBY('tagihan.nomor_induk','tagihan.nama','kelas.nama_kelas')
           ->get();

           $data_subTunggakan = DB::connection('mysql2_siak')->table('tagihan')
            ->leftjoin('detil_tagihan', 'tagihan.id_record_tagihan','=','detil_tagihan.id_record_tagihan')
            ->leftjoin('rombel', 'tagihan.nomor_induk','=','rombel.nomor_induk')
            ->leftjoin('kelas', 'rombel.id_kelas','=','kelas.id_kelas')
            ->select(
              DB::raw('tagihan.nomor_induk, tagihan.nama, tagihan.nomor_pembayaran'),
              DB::raw('kelas.nama_kelas'),
              DB::raw('SUM(tagihan.total_nilai_tagihan) as total'),
             // DB::raw("(GROUP_CONCAT(detil_tagihan.label_jenis_biaya_panjang SEPARATOR ', ')) as `rincian`")
              )
            ->where('rombel.nomor_induk',$id)
           ->where('tagihan.is_tagihan_aktif',1)
           //->where('tagihan.nomor_pembayaran','like','3%')
           ->groupBY('tagihan.nomor_induk','tagihan.nomor_pembayaran','tagihan.nama','kelas.nama_kelas')
           ->get();

            $data_siswa['siswa'] = $siswa;
            $data_siswa['tagihanAll_siswa'] = $data_tunggakanAll;
            $data_siswa['tagihanSub_siswa'] = $data_subTunggakan;

            return response()->json(['status' => 200,
            'data' => $data_siswa
            ]);
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
