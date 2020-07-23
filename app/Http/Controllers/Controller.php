<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendEmail($tplName, $params, $attach=""){    	

    	$from = (isset($params['from'])&&$params['from'])? $params['from'] : env('SUPPORT_EMAIL');
        $to = (isset($params['to'])&&$params['to'])? $params['to'] : env('HZG_EMAIL');
        $name = (isset($params['name'])&&$params['name'])? $params['name'] : "Husqvarna Support";
        $subject = (isset($params['subject'])&&$params['subject'])? $params['subject'] : "Subject";

        Mail::send('email.'.$tplName, $params,
            function($mail) use ($from, $to, $name, $subject, $attach){
                $mail->from($from, $name);
                $mail->to($to, $to);
                $mail->subject($subject);

                if($attach){
                	$mail->attach($attach['path'], array(
				        'as' => $attach['name'], 
				        'mime' => $attach['mime'])
				    );
                }                
        });
        return;
    }
}
