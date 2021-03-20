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
    session_start();
    session_destroy();
    session_start();
    $_SESSION['z_token'] = bin2hex(openssl_random_pseudo_bytes(100));
    $token = $_SESSION['z_token'];
?>

    <div class="row ">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2 class="text-center">Login Form</h2>
            <form action="admin_login_exe.php" method="post">
                <div class="imgcontainer">
                    <img src="img_avatar2.png" alt="Avatar" class="avatar">
                </div>
                <?php if(!empty($_GET['login'])){ ?>
                    <p class="text-danger"><?php echo $_GET['login']; ?></p>
                <?php } ?>
                <div class="container">
                    <label for="uname"><b>User Email</b></label>
                    <input type="email" placeholder="Enter Username" name="email" required>
                    <input type="hidden" placeholder="Enter Username" name="token_hidden" value="<?php echo $token;?>" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>

                    <button type="submit">Login</button>
                    
                </div>

                
            </form>
        </div>
    </div>

</body>

</html>