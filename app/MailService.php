<?php
namespace App;
use DB;


use Carbon\Carbon;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
class MailService
{

    protected $mailer;
    protected $email_address;

    public function __construct(Mailer $mailer)
    {
    	$this->mailer 				= $mailer;
        $this->email_address        = 'pillfinder@shigroup.org';
    }

    public function sendRegistrationEMail($data){
        
        $pharmacy = DB::table('pharmacy')->where('id',$data['store'])->first();
        $email_address = $this->email_address;
        $this->mailer->send('email.register',['user' => $data,'pharmacy'=>$pharmacy], function (Message $m) use ($email_address) {
            $m->to($email_address)->subject('New App User Registration');
        });
    }
    public function sendPaymentEMail($user,$details){
        $email_address = $this->email_address;
        $this->mailer->send('email.payment',['user' => $user,'details'=>$details], function (Message $m) use ($email_address) {
            $m->to($email_address)->subject('New Payment Request');
        });
    }

    public function sendFeedback($data){
        $email_address = $this->email_address;
        $user = DB::table('users')->where('id',$data['user_id'])->first();
        $this->mailer->send('email.feedback',['user' => $user,'feedback'=>$data['feedback'],'feedback_type'=>$data['feedback_type']], function (Message $m) use ($email_address) {
            $m->to($email_address)->subject('Feedback From App');
        });
    }

    public function sendMail($data,$case){
        if($case=='new')
        $subject = 'A New Appointment';
        else if($case=='approve')
        $subject = 'Appointment Aproval';
        else if($case=='reminder')
        $subject = 'Appointment Reminder';
        else
        $subject = 'Appointment Cancellation';
        
        $userto = DB::table('users')->where('id',$data['userid'])->first();
        $userfrom = DB::table('users')->where('id',$data['user_id'])->first();
        $email_address = $userto->email_address;
        $user = DB::table('users')->where('id',$data['user_id'])->first();
        $data['start_time']  = date('F jS, Y h:i:s', strtotime($data['start_time']));
        $data['end_time']  = date('F jS, Y h:i:s', strtotime($data['end_time']));
        $this->mailer->send('email.appointment',['userto' => $userto,'userfrom'=>$userfrom,'appointment'=>$data], function (Message $m) use ($email_address,$subject) {
            $m->to($email_address)->subject($subject);
        });
    }
    public function sendClientRequest($data){    
        $userto = DB::table('users')->where('id',$data['client_id'])->first();
        $userfrom = DB::table('users')->where('id',$data['user_id'])->first();
        $email_address = $userto->email_address;
        $subject = $userfrom->first_name.' '.$userfrom->last_name.' has sent you a request';
        $this->mailer->send('email.request',['userto' => $userto,'userfrom'=>$userfrom], function (Message $m) use ($email_address,$subject) {
            $m->to($email_address)->subject($subject);
        });
    }
    public function approveClientRequest($data){    
        $userto = DB::table('users')->where('id',$data->user_id)->first();
        $userfrom = DB::table('users')->where('id',$data->client_id)->first();
        $email_address = $userto->email_address;
        $subject = $userfrom->first_name.' '.$userfrom->last_name.' has approved your request';
        $this->mailer->send('email.request',['userto' => $userto,'userfrom'=>$userfrom], function (Message $m) use ($email_address,$subject) {
            $m->to($email_address)->subject($subject);
        });
    }
    public function denyClientRequest($data){    
        $userto = DB::table('users')->where('id',$data->user_id)->first();
        $userfrom = DB::table('users')->where('id',$data->client_id)->first();
        $email_address = $userto->email_address;
        $subject = $userfrom->first_name.' '.$userfrom->last_name.' has denied your request';
        $this->mailer->send('email.request',['userto' => $userto,'userfrom'=>$userfrom], function (Message $m) use ($email_address,$subject) {
            $m->to($email_address)->subject($subject);
        });
    }
}