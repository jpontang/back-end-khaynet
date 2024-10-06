<?php

namespace App\Http\Controllers\TokenOTP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TokenOTP\password_reset_tokens;
use \App\Http\Controllers\Broadcast\WhatsappController;
use DB;
use DateTime;
use DateTimeZone;

class PasswordResetTokensController extends Controller
{

    public function cekTokenReset(Request $request){
        $token = password_reset_tokens::where('email', $request->email)->first();
        
        try{

            if($token->token !== $request->kodeOTP){
               return response()->json(['status' =>  10 ,'pesan' => 'Kode OTP tidak di kenal']);
            }else {
                return response()->json(['status' =>  11 ]);
            }
        }catch(Exception $e){
            return $this->sendError( 'Error '. $e->getMessage(), 422);
        }
        
       
    }

    public function store(Request $request){
     
            $request->validate([
                'email' => 'required',
                'hp' => 'required',
            ]);

            $hp = $request->hp;

            $kodeOtp = $this->quickRandom();

            $token = password_reset_tokens::where('email', $request->email)->first();
 
            if ($token !== null) {
                
                $token = password_reset_tokens::where('email' , request('email'))->update([                
                'token'=> $kodeOtp]);
            } else {
                $token = password_reset_tokens::create([
                'email' => request('email'),
                'token'=> $kodeOtp
                ]);
            }

            $this->sendWhatsapp($hp,$kodeOtp);

            return response()->json(['status' => 'resetTokenPassword'.$token]);
       
        
    }

    
    public function sendWhatsapp($hp,$kodeOtp){

        $listpesan[] = array('nomor'=>$hp,'pesan'=>("".$kodeOtp." adalah kode verifikasi Anda. Demi keamanan, jangan bagikan kode ini."));
         
        if(!empty($listpesan)){
          $sendWhatsapp = new WhatsappController;
          $res = $sendWhatsapp->api_whatsapp($listpesan);  

          $names_str = serialize($res);
          $listpesan_str = serialize($listpesan);
          $date = new DateTime("now", new DateTimeZone('Asia/jakarta') );
            $log = [];
            $log['nomor_induk'] = 1;
            $log['hp'] = 2;
            $log['subject'] = $names_str . $listpesan_str;
            $log['url'] = "Request::fullUrl()";
            $log['method'] =" Request::method()";
            $log['ip'] = "Request::ip()";
            $log['agent'] = "Request::header('user-agent')";
            $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    	
          DB::table('log_whatsappremainder')->insert($log);
        }
    }

    public static function quickRandom($length = 5)
    {
        $pool = '0123456789';

        return substr(str_shuffle($pool), 0, $length);
    }


}
