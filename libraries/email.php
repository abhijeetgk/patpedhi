<?php 

class email_library {

    public function send_email($input){          
        require ($_SERVER["DOCUMENT_ROOT"]."/vendor/email/phpmailer.php");
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $message= $input['message'];
        $to = $input['email'];
        $subject=$input['subject'];
        $mail = new phpmailer_library();        
        $mail->IsSMTP();
        $mail->Host = EMAIL_HOST;    //"172.29.70.1";
        $mail->Port=EMAIL_PORT; 
        $mail->SMTPAuth = false;
        $mail->Username = ' ';
        $mail->Password = ' ';

        $mail->From=FROM_EMAIL;
        $mail->FromName=FROM_EMAIL_NAME;

        $mail->Sender=FROM_EMAIL;
        $mail->ContentType ="text/html";
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body=($message);
        $mail->AddCustomHeader("X-Mail:".base64_encode("FROM_EMAIL_NAME:".$to)."\r\n");    
        $return = array();     
        if(!$mail->Send())
        {
            $return['status'] = "error";
            $return['message']="<br>Error sending: " . $mail->ErrorInfo."<br>";
         }
        else
        {
            $return['status'] = "success";
            $return['message']= "email send to ".$to;
        }
        return $return;
    }
}