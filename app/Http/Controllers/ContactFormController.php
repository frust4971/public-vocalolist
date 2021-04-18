<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use App\Models\MailUser;
use Illuminate\Http\Request;
class ContactFormController extends Controller
{
    public function post(Request $request){
        if(!empty($request->input('is_not_bot'))){
            $err = "不適切な値が入力されました";
            return view('contact',compact('err'));
        }
        $mail_user = MailUser::find($_SERVER['REMOTE_ADDR']);
        if ($mail_user != null){
            $err = "送信は一日一回までです";
            return view('contact',compact('err'));
        }
        $message = $request->input('content');
        if(empty($message)){
            $err = "内容を入力してください";
            return view('contact',compact('err'));
        }
        $mail_user = new MailUser;
        $mail_user -> ip_address = $_SERVER['REMOTE_ADDR'];
        $mail_user ->save();

        $mail = new PHPMailer(true);
        $mail->isSMTP();  
        $mail->Host = "smtp-mail.outlook.com";
        $mail->SMTPAuth   = true; 
        $mail->Username   = env('MAIL_ADDRESS_FROM',null);
        $mail->Password   = env('MAIL_PASSWORD',null);
        $mail->SMTPSecure = 'tls';  // 暗号化を有効に
        $mail->Port       = 587;  // TCP ポートを指定
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(false); 
        $mail -> setFrom(env('MAIL_ADDRESS_FROM',null),'VocaloList');
        $mail -> addAddress(env('MAIL_ADDRESS_TO',null));
        $mail -> Subject = 'お問い合わせ';
        $content = "";
        if(!empty($request -> input('name'))){
            $content .= $request -> input('name')."さんから\n\n";
        }
        if(!empty($request -> input('email'))){
            $content .= 'メールアドレス:'."\n".$request -> input('email')."\n\n";
        }
        $content .= $request -> input('content');
        $mail -> Body = $content;
        if(!$mail->send()){
            $err = "メールの送信に失敗しました";
            return view('content',compact('err'));
        }
        $success = true;
        return view('contact',compact('success'));
    }
}
