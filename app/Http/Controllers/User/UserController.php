<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        /**
         * Start cari data siswa
         * ==================================================================================================*/
        $user =  DB::connection('mysql')->table('users')->select('id','name','email','level','updated_at')->get();

        if (!$user->isEmpty()) {
            return response()->json(['status' => 0,
                'pesan' => 'Data user tersedia',
                'dataUser' => $user,
            ]); //data tersedia
          }else{
            return response()->json(['status' => 1,
                'pesan' => 'Data user tidak tersedia',
            ]);
        }


    }

}
