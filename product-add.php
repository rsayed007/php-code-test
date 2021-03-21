<?php include_once './includes/admin_head_start.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    
<?php include_once './includes/admin_head_end.php'; ?>

<?php

$location = $user->locations();
// echo '<pre>';
// print_r($location);
// echo '</pre>';

if(isset($_POST) && !empty($_POST))
{
    // echo $_POST['product_name'];
    // exit;

    $product_data = $user->Product_Create($_POST['product_name'], $_POST['unit_price'], $_POST['location']);

    if ($product_data['status'] == 'success') {
        
        echo "<script>
                window.location = 'product-list.php?status=".$product_data['reason']."'
            </script>";
        exit;
    }
}
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="d-flex justify-content-between mx-2 mt-2">
                            <h3>Add Product</h3>
                        </div>
                        <div class="card-body">
                            <form action="product-add.php" method="post">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" name="product_name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="">Unite Price</label>
                                    <input type="text" name="unit_price" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Location</label>
                                    
                                      <select required class="form-control" name="location" id="">
                                        <option value="">Select One</option>
                                        <?php 
                                            foreach ($location as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php }?>
                                      </select>
                                </div>
                                
                                <button type="submit" name="save" class="btn btn-primary">Save</button>

                            </form>
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