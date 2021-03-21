<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

<?php
    session_start();

    include_once './includes/db_connect.php';
    include_once "./class/class.user.php";
    $user = new USER($conn);

    // $location = $user->locations();
    $all_products = $user->All_Products();
    // echo '<pre>';
    // // print_r($all_products);
    // print_r($_SESSION);
    // echo '</pre>';

    
    if(isset($_GET) && !empty($_GET['product_id']))
    {
        // print_r($_GET);
        // exit;

        $order_data = $user->Order_Create($_GET['product_id']);
        // print_r($order_data);
        // exit;

        if ($order_data['status'] == 'success') {
            
            echo "<script>
                    window.location = 'index.php?status=".$order_data['massage']."'
                </script>";
            exit;
        }
    }

?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

        <a class="navbar-brand" href="#">Logo</a>

        <!-- Links -->
        <div class="navbar-collapse justify-content-between" id="navbar">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">One</a>
                <a class="nav-item nav-link" href="#">Two</a>
            </div>
            <div class="navbar-nav">
            <?php 
            if (!empty($_SESSION['SES_USER_NAME'])){ 

                echo '<p class="nav-item nav-link">'.$_SESSION['SES_USER_NAME'].'</p> <br>
                    <a class="nav-item nav-link" href="logout.php">Logout</a>';
            }else{
                echo '<a class="nav-item nav-link" href="login.php">Login</a>';
            }
            ?>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">

                <?php 
                    foreach ($all_products as $key => $product) {
                        // print_r($$product);
                        ?> 
                    <div class="col-md-3">
                        <div class="card mt-3">
                            <img class="card-img" src="https://cached.imagescaler.hbpl.co.uk/resize/scaleHeight/815/cached.offlinehbpl.hbpl.co.uk/news/OMC/all-products-20170125054108782.gif" width="" alt="Vans">
                            
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $product['product'];?></h4>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $product['location_name'];?></h6>
                                
                                <div class="buy d-flex justify-content-between align-items-center">
                                    <div class="price text-success">
                                    <?php 
                                        $u_price = $product['unit_price'];
                                        $d_price = ($u_price - ($u_price /100)*25);
                                        if (!empty($_SESSION['SES_USER_LOCATION'])) {
                                            if($_SESSION['SES_USER_LOCATION'] == $product['location_id']){
                                                echo ' <h5 class="mt-4"><s>$'. $product['unit_price'] .'</s>,
                                                     $'. $d_price .'</h5>';
                                            }else{
                                                echo '<h5 class="mt-4">$'. $product['unit_price'] .'</h5>';
                                            }
                                        }else{
                                            echo '<h5 class="mt-4">$'. $product['unit_price'] .'</h5>';
                                        }
                                    ?>
                                    </div>
                                    <a href="index.php?product_id=<?php echo $product['id']?>" class="btn btn-danger mt-3" onclick="return confirm('please confirm your order')"><i class="fas fa-shopping-cart"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  }
                ?>
        </div>
    </div>

<?php 
    if (empty($_SESSION['SES_USER_NAME'])){ 
?>
<script>
    $(document).ready(function(){
        // alert('Please');
        var ask = window.confirm("Sign Up for attractive discounts !!!");
        if (ask) {
            window.location.href = "login.php";

        }
    });
</script>
<?php } ?>

</body>

</html>