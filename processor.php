<?php
require 'db.php';
$data = [];
$action = $_POST['action'];;
//$_POST['action'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "ab3idtech@gmail.com";
$mail->Password   = "sxofbhwmdrpefkys";


function validate($data){

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

 }

 if($action == 'otp_verify'){
    $data['action'] = 'otp_verify';
    $data['error'] = '';
    $uid = $_POST['uid'];

    $code = validate($_POST['code']);

    $query = "SELECT * FROM otp_auth where user_id = $uid AND code = '$code' AND used = false";

    $result = mysqli_query($conn, $query);

    $row = mysqli_num_rows($result);

    if($row == 1){
        //continue
        $otpdata = mysqli_fetch_assoc($result);

        $code_id = $otpdata['id'];

        $qu = "UPDATE `otp_auth` SET `used` = '1' WHERE `otp_auth`.`id` = $code_id";

        if(mysqli_query($conn, $qu)){
            session_start();
            $_SESSION['uid'] = $uid;
            $data['success'] = true; 
            //success redirect to dashboard
        }
    }else{
        $data['error'] = 'Invalid OTP';
    }
 }

if($action == 'act_login'){
    $data['action'] = 'login';
    $data['error'] = '';
    //perform login
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $query);

    if($result != null && mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $db_password = $row['password'];

        if(password_verify($pass, $db_password)){
           


            //generate OTP
            $code = rand();

            $mail->IsHTML(true);
            $mail->AddAddress("abeidtwo@gmail.com", "Abeid");
            $mail->SetFrom("ab3idtech@gmail.com", "Kibamba Auth");
            $mail->Subject = "OTP AUTH";
            $content = "<b>Here is your OTP: </b>".$code;

            $user_id = $row['id'];
            $insert = "INSERT INTO `otp_auth`(`id`, `code`, `user_id`, `used`) VALUES (NULL,$code,$user_id, 0)";
            if(mysqli_query($conn, $insert)){
                //send mail;
                $data['name'] = $row['name'];
                $data['message'] = 'Check your email';
                $data['user_id'] = $row['id'];

                $mail->MsgHTML($content); 
               
                if(!$mail->Send()) {
                $data['mail_error'] = "Error while sending Email.";
                } else {
                $data['mail_resp'] = "Email sent successfully";
                }
            }else{
                $data['mysql_error'] = mysqli_error($conn);
            }
        }else{
            //incorrect password *or username
            $data['error'] = 'Invalid username or password';
        }
    }else{
        // incorrect username or password
        $data['error'] = 'Invalid username or password';
    }
}

echo json_encode($data);