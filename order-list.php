<?php include_once './includes/admin_head_start.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    
<?php include_once './includes/admin_head_end.php'; ?>

<?php
// $location = $user->locations();
// $all_products = $user->All_Products();
$all_orders = $user->All_Order();
// echo '<pre>';
// print_r($all_orders);
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
            <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="d-flex justify-content-between mx-2 mt-2">
                            <h3>Order List</h3>
                            <!-- <a href="product-add.php" class="btn btn-info">Add Product</a> -->
                        </div>
                        
                        

                        <?php if (!empty($_GET)) {
                            ?>
                            <div class=" mt-4 alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <strong><?php echo $_GET["status"];?></strong>
                            </div>
                        <?php }?>
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Order Id</th>
                                        <th>Customer</th>
                                        <th>Unit Price</th>
                                        <th>Dis. Unit Price</th>
                                        <th>Count</th>
                                        <th>Pay Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($all_orders as $key => $order) {
                                        // print_r( $product);
                                        ?>
                                
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $order['pro_name']; ?></td>
                                        <td><?php echo $order['order_id']; ?></td>
                                        <td><?php echo $order['cus_name']; ?></td>
                                        <td><?php echo $order['unit_price']; ?></td>
                                        <td>
                                            <?php
                                            if ($order['discount_unit_price'] == 0) {
                                                
                                                echo '<span class="text-danger">N/A</span>'; 
                                            }else{
                                                echo $order['discount_unit_price'];
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $order['unit_count']; ?></td>
                                        <td><?php echo $order['pay_amount']; ?></td>
                                        <td>
                                        <?php 
                                            if($order['status'] == 1){
                                                echo '<span class="text-info">Submitted</span>';
                                            }else if ($order['status'] == 2) {
                                                echo '<span class="text-danger">In Transit</span>';
                                            }else if ($order['status'] == 3){
                                                echo '<span class="text-success">Delivered</span>';
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php 
                                            if($order['status'] == 1){
                                                echo '<a class="btn btn-danger " href="order-list.php?status_id=2&order_id='.$order['id'].'"><span class="text-info">In Transit</span></a>';
                                            }else if ($order['status'] == 2) {
                                                echo '<a class="btn btn-info " href="order-list.php?status_id=3&order_id='.$order['id'].'"><span class="text-danger">Delivered</span></a>';
                                            }else if ($order['status'] == 3){
                                                echo '<span class="text-danger">Order Complete</span>';
                                            }
                                        ?>
                                            
                                        </td>

                                        
                                    </tr>
                        <?php } ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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