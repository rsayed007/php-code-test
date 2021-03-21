<?php include_once './includes/admin_head_start.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    
<?php include_once './includes/admin_head_end.php'; ?>

<?php
// $location = $user->locations();
$all_products = $user->All_Products();
$all_orders = $user->All_Order();

// echo '<pre>';
// print_r($all_products);
// echo '</pre>';

if(isset($_GET) && !empty($_GET['status_id']) && (!empty($_GET['order_id'])))
{
    $status_data = $user->Status_Update($_GET['status_id'], $_GET['order_id']);
    // print_r($status_data);
    // exit;

}

?>
    <div class="container">
        <div class="row">
            <?php 
            foreach ($all_products as $key => $product) { 
                ?>
                
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php 
                                // $product_count = $user->Count_Order_Product($product['id'], $status=2);
                                // print_r($product_count);
                            ?>
                        </h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $product['product'];?></h6>
                        <div>
                        Submitted: <?php $product_count = $user->Count_Order_Product($product['id'], $status=1);
                                    print($product_count['pro_count']);
                                ?>
                        <br>
                        In Transit: <?php $product_count = $user->Count_Order_Product($product['id'], $status=2);
                                    print($product_count['pro_count']);
                                ?>
                        <br>
                        Delivered: <?php $product_count = $user->Count_Order_Product($product['id'], $status=3);
                                    print($product_count['pro_count']);
                                ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
            
        </div>
    </div>


<?php  include_once './includes/admin_footer_start.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<?php  include_once './includes/admin_footer_end.php'; ?>