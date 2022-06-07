<?php

include('server/connection.php');

// check for the post condition
if(isset($_POST['order_details_btn']) && isset($_POST['order_id']) ){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);

}else{

    header('location: account.php');
    exit;
}


function calculateTotalOrderPrice($order_details){

    $total = 0;

    foreach($order_details as $row) {

        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);

    }

    return $total;

}


?>



<?php include('layouts/header.php'); ?>

<title>Order Details | Pet World</title>


  <!--Order Details-->
  <section id="orders" class="orders container my-3 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order Details</h2>
            <hr class="mx-auto">
        </div>

        <?php if($order_status == 'cancelled'){?>

        <h6 style="text-align: center !important; color:red;">Order is Cancelled. Refund will be processed in 2-3 Working Days.</h6>

        <?php } ?>

        <!--table to display orders-->
        <table class="mt-5 pt-5 mx-auto">
            <!--Row to display the table heading-->
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <!--Row to display the orders-->


            <?php foreach($order_details as $row) { ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt=""> 
                        <div>
                            <p class="mt-3"><?php echo $row['product_name']; ?></p>
                        </div>
                    </div>
                </td>

                <td>
                  <span>₹<?php echo $row['product_price']; ?></span>
                </td>
               
                <td>
                  <span><?php echo $row['product_quantity']; ?></span>
                </td>

            </tr>


            <?php } ?>

        </table>

        <p class="total-price">
            <?php echo "Total Amount: ₹", calculateTotalOrderPrice($order_details);?>
        </p>
        
        <br>
        <br>

        <!-- Display the pay button if the order is not paid -->
        <?php if($order_status == 'not paid'){ ?>

            <form action="payment.php" method="POST" style="float: right;">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
                <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
                <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now">
            </form>

        <?php } ?>



      </section>





<?php include('layouts/footer.php'); ?>