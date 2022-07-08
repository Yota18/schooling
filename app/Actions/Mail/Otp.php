<?php 
namespace App\Actions\Mail;

use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Otp as OtpModels;
use Illuminate\Support\Facades\Mail;

class Otp{


    public function send(Request $request)
    {

        if ($old = OtpModels::where('email',$request->email)->first()) {
            $old->delete();
        }
        
        $code=random_int(100000, 999999);

        OtpModels::create([
            'email' => $request->email,
            'code' => $code,
            'expired_date' => Carbon::now()->addMinute(5),
        ]);

        $maildata = [
            'code' => $code,
        ];

        Mail::to($request->email)->send(new OtpMail($maildata));

        return true;
    }
} 

?>