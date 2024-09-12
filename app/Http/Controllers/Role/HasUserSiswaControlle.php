<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\model_has_user_siswa;

class HasUserSiswaControlle extends Controller
{


    public function show(string $id){

        $hasSiswa = model_has_user_siswa::where('user_id', '=', $id)->first();
        

        $data['hasSiswa'] = $has;
       // $data['permissions'] = $rolePermissions;

        return $this->sendResponse($data, 'Success', 200);
    }


}
