<?php include_once './includes/admin_head_start.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

<?php include_once './includes/admin_head_end.php'; ?>

<?php
    // print_r($_SESSION);
    $all_products = $user->All_Products();
    $all_orders = $user->All_Order();
    // echo '<pre>';
    // print_r(count($all_products));
    // echo '</pre>';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo count($all_products); ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">Total Product</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo count($all_orders); ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">Total Order</h6>
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