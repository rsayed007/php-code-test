<?php 
    header('X-Frame-Options: deny');
    header('X-XSS-Protection: 1; mode=block');
    header('X-Content-Type-Options: nosniff');
    header('X-Permitted-Cross-Domain-Policies: none');
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<?php
    // session_start();
    // session_destroy();
    session_start();
    $_SESSION['z_token'] = bin2hex(openssl_random_pseudo_bytes(100));
    $token = $_SESSION['z_token'];


    include_once './includes/db_connect.php';
    include_once "./class/class.user.php";
    $user = new USER($conn);

    $location = $user->locations();
    // echo '<pre>';
    // print_r($location);
    // echo '</pre>';
    if(isset($_POST) && !empty($_POST))
    {
        // print_r($_POST);
        // exit;
        if (!empty($_POST['token_hidden'])) {
               
            
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    header('Location: register.php?login=invalid-email'); exit;
                    exit;	
                }
                else{
                    $cus_email=$_POST['email'];
                }
                $customer_data = $user->Customer_Register($_POST['name'], $_POST['number'], $cus_email, $_POST['location'], $_POST['password'],);
                print_r($customer_data);
                print_r($_SESSION['SES_USER_NAME']);
                exit;

                if ($customer_data['result'] == 'failed') {
                    header('Location: register.php?login='.$customer_data["reason"]); exit;
                    exit;
                }
                if ($customer_data['status'] == 'success') {
                    
                    echo "<script>
                            window.location = 'index.php?status=".$customer_data['reason']."'
                        </script>";
                    exit;
                }
            
        }
    }


?>

    <div class="row ">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2 class="text-center">Login Form</h2>
            <form action="register.php" method="post">
                <div class="imgcontainer">
                    <img src="https://cdn0.iconfinder.com/data/icons/set-ui-app-android/32/8-512.png" alt="Avatar" style="width: 100px;" class="avatar">
                </div>
                <?php if(!empty($_GET['login'])){ ?>
                    <p class="text-danger"><?php echo $_GET['login']; ?></p>
                <?php } ?>
                <div class="container">
                    <label for="uname"><b>User Name</b></label>
                    <input type="text" placeholder="Enter Username" name="name" required>
                    
                    <label for="uname"><b>User Phone Number</b></label>
                    <input type="text" placeholder="Enter Phone Number" name="number" required>
                    
                    <label for="uname"><b>User Email</b></label>
                    <input type="email" placeholder="Enter User email" name="email" required>
                    <input type="hidden" placeholder="Enter Username" name="token_hidden" value="<?php echo $token;?>" required>

                    <div class="form-group">
                        <label for=""><b>Location</b></label>
                        
                            <select required class="form-control" name="location" id="">
                            <option value="">Select One</option>
                            <?php 
                                foreach ($location as $key => $value) {
                            ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php }?>
                            </select>
                    </div>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>

                    <button type="submit">Login</button>
                    
                </div>

                
            </form>
        </div>
    </div>

</body>

</html>