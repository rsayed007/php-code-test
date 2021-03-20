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
    include_once './includes/db_connect.php';
    include_once "./class/class.user.php";
    $user = new USER($conn);

    $location = $user->locations();
    echo '<pre>';
    print_r($location);
    echo '</pre>';

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
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                <div class="card mt-3">
                    <img class="card-img" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" alt="Vans">
                    <div class="card-img-overlay d-flex justify-content-end">
                        <a href="#" class="card-link text-danger like">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Vans Sk8-Hi MTE Shoes</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6>
                        <p class="card-text">
                            The Vans All-Weather MTE Collection features footwear and apparel designed to withstand the elements whilst still looking cool. </p>
                        
                        <div class="buy d-flex justify-content-between align-items-center">
                            <div class="price text-success">
                                <h5 class="mt-4">$125</h5>
                            </div>
                            <a href="#" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>