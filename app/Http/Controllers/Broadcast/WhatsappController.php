<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function api_whatsapp($listpesan){

        foreach($listpesan as $values) {
            $no_hp = $values['nomor'];
            $pesan = $values['pesan'];

            
            //--------------------------------------------------------------------------------------
            $dataSending = Array();
            $dataSending["api_key"] = "BSJLT4IHU9TDWHQE";
            $dataSending["number_key"] = "9dKV8HxHzE6mTB30";
            $dataSending["phone_no"] = $no_hp;
            $dataSending["message"] = $pesan;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($dataSending),
                CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            //dd($response);
            return $response ;


        }
    }
}
