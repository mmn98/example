<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
include_once 'common.class.php';


    
class Mailer extends Common
{
        public function __construct()
        {
            parent::__construct();
        }

        public function getid($email)
        {
            $this->db->where("email", $email);
            $result = $this->db->getOne("usres");
            return $result;
        }

         public function send($mailid)
        {
          //  if (isset($_REQUEST['submit']))
           // {
             //   $email = $_REQUEST['email'];
               // $email1 = $mailid;
                $result=$this->getid($mailid);

                if($result)
                {
                    $id=$result['id'];
                    echo $id;


                    try 
                    {
                        $mail = new PHPMailer(true);

    
    
                    //  $mail->SMTPDebug  = 1;  
                        $mail->SMTPAuth   = TRUE;
                        $mail->SMTPSecure = "tls";
                        $mail->Port       = 587;
    
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                        $mail->Username   = 'naikmaitri11@gmail.com';                     // SMTP username
                        $mail->Password   = 'kejal1996';                               // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                        
    
                        //From email address and name
                        $mail->setFrom('naikmaitri11@gmail.com', 'maitri');
                    // echo $email1;
    
                            $mail->addAddress($mailid);     // Add a recipient
                        //  $mail->addAddress('naikmaitri11@gmail.com');               // Name is optional
                     //    $mail->addReplyTo('naikmaitri11@gmail.com', 'Information');
                        //  $mail->addCC('cc@example.com');
                        //  $mail->addBCC('bcc@example.com');
    
                            // Attachments
                        //$mail->addAttachment();         // Add attachments
                        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
                            //FOR OTP
                            $otp = rand(100000,999999);
                            $otp_enc = md5($otp);
    
                            $activation=$mailid.time();
                          //  echo $activation;
    
                             $exp_time = time() + 1000;
                          //generate a key to send email and add in db
                             $key = md5($id.$otp_enc);
                             
                             $data['reset_password_key']=$key;
                            
                             $this->db->where('id', $id);
                             $result = $this->db->update('usres', $data);
                            

    
                         //   echo $exp_time;
    
                        
                            // Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = 'Reset Password';
                            $mail->Body    = "<a href='http://localhost/example/admin/authenti/reset_password.php?id=$id&otp=$otp_enc&time=$exp_time&key=$key'>click here</a><h5>your otp is:$otp</h5>";
                            $mail->AltBody = '';
                       
                          $mail->send();
                            $msg='check your mail for continue the reset_password process.';
                            return $msg;
                    }
                    catch (Exception $e) 
                    {
                            $msg="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            return $msg;
                            error_log("$msg while sending mail",0);
                    }
                        
                }
                else{
                    echo "id can not be fetch";
                }

              
             
            
        }

}
?>