<?php include_once './includes/admin_head_start.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    
<?php include_once './includes/admin_head_end.php'; ?>

<?php
$location = $user->locations();
$all_products = $user->All_Products();
// echo '<pre>';
// print_r($all_products);
// echo '</pre>';

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="d-flex justify-content-between mx-2 mt-2">
                            <h3>Product List</h3>
                            <a href="product-add.php" class="btn btn-info">Add Product</a>
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
                                        <th>Unit Price</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($all_products as $key => $product) {
                                        // print_r( $product);
                                        ?>
                                
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $product['product']; ?></td>
                                        <td><?php echo $product['unit_price']; ?></td>
                                        <td>
                                        <?php echo $product['location_name']; ?>
                                        </td>
                                        
                                        <td>$320,800</td>
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