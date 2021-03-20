<?php 
    // echo 'login';
    
    error_reporting(0);
    if(empty($_POST['email'])) { header('Location: admin_login.php'); exit; }
    if(empty($_POST['password'])) { header('Location: admin_login.php'); exit; }
    if(empty($_POST['token_hidden'])) { header('Location: admin_login.php'); exit; }

    session_start();
    include_once './includes/db_connect.php';
    include_once "./class/class.user.php";
    $user = new USER($conn);
   
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        header('Location: admin_login.php?login=invalid-email'); exit;
        exit;	
    }
    else{
        $user_email=$_POST['email'];
    }
    $login_password=$_POST['password'];

    if (!empty($_POST['token_hidden'])) {
        if (hash_equals($_SESSION['z_token'], $_POST['token_hidden'])) {
    
            $User_Login_Validation = $user->login($user_email, $login_password);
            
// echo $User_Login_Validation;
            if($User_Login_Validation['result'] =='ok')
            {
                // echo 'asdfasdfa';
                header('Location: index.php?'.$_SESSION["z_token"]);
                exit();
            }else{
                
                $Alert_message="Login Failed. Please Try Again";
                $Alert_message=htmlentities($Alert_message);
                $register_user->redirect('login.php?login='.$Alert_message);
                exit();
            }
            
        } else {
            $Alert_message="Session Expired or Invalid Session. Please Try Again";
            $Alert_message=htmlentities($Alert_message);
            $register_user->redirect('login.php?login='.$Alert_message);
            exit;
        }
    }


?>