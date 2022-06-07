<?php

session_start();

include('server/connection.php');

?>

<?php

if(isset($_POST['cancel_order_btn'])){

    $order_id = $_POST['order_id'];
    $order_cost = $_POST['order_cost'];
    $user_id = $_POST['user_id'];

    $_SESSION['user_id'] = $user_id;
    $_SESSION['order_id'] = $order_id;
    $_SESSION['order_cost'] = $order_cost;

}

if(isset($_POST['cancel_order'])){

    $name = $_POST['name'];
    $bank_name = $_POST['bank_name'];
    $bank_branch = $_POST['bank_branch'];
    $account_number = $_POST['account_number'];
    $ifsc_code = $_POST['ifsc_code'];
    $user_id = $_POST['user_id'];
    $order_id = $_POST['order_id'];
    $order_cost = $_POST['order_cost'];

    date_default_timezone_set("Asia/Kolkata");
    $cancel_date = date('Y-m-d H:i:s');

    //check the account number
    if(!preg_match("/^([0-9]*)$/", $account_number)){

        header('location: order_cancel.php?error=Enter a valid Account Number');

    // check the ifsc code
    }else if(!preg_match("/^[a-zA-Z0-9]{11}$/", $ifsc_code)){
        header('location: order_cancel.php?error=Enter a valid IFSC Code');

    //if no error
    }else{

        //create a new entry
        $stmt = $conn->prepare("INSERT INTO cancel (order_id,user_id,order_cost,name,bank_name,bank_branch,account_number,ifsc_code,cancel_date) VALUES (?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param('iiisssiss',$_SESSION['order_id'],$_SESSION['user_id'],$_SESSION['order_cost'],$name,$bank_name,$bank_branch,$account_number,$ifsc_code,$cancel_date);

        if($stmt->execute()){
            $order_id = $_SESSION['order_id'];
            $order_status = "cancelled";
            
        
            //change order status to paid
        
            $stmt2 = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
        
            $stmt2->bind_param('si',$order_status,$order_id); 
        
            $stmt2->execute();

            header('location: account.php?order_cancelled=Order was Cancelled.');
        }else{

            header('location: account.php?order_cancelled=Order could not be cancelled.');
        }


    }



   


}

?>

<?php include('layouts/header.php'); ?>

<title>Order Cancel | Pet World</title>




 <!--Details-->
 <section class="my-5 py-5">
          <div class="container text-center pt-3">
              <h2 class="form-weight-bold">Cancel Order</h2>
              <hr class="mx-auto">
          </div>

          

          <!--Cancel Form-->
          <div class="mx-auto container">

                <form action="order_cancel.php" id="order-cancel-form" method="POST">

                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                  <!--Name-->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="order-cancel-name" class="form-control"  required>
                    </div>

                    <!--Bank Name-->
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" id="order-cancel-bank-name" class="form-control"  required>
                    </div>

                    <!--Branch Name-->
                    <div class="form-group">
                        <label>Branch Name</label>
                        <input type="text" name="bank_branch" id="order-cancel-branch-name" class="form-control"  required>
                    </div>

                    <!--Account Number-->
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" name="account_number" id="order-cancel-account-number" class="form-control"  required>
                    </div>

                    <!--Ifsc code-->
                    <div class="form-group">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc_code" id="order-cancel-account-number" class="form-control"  required>
                    </div>

                    <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id">
                    <input type="hidden" value="<?php echo $_SESSION['order_id']; ?>" name="order_id">
                    <input type="hidden" value="<?php echo $_SESSION['order_cost']; ?>" name="order_cost">


                    <!--Submit Button-->
                    <div class="form-group">
                        <input type="submit" id="cancel-btn" class="btn" value="Submit" name="cancel_order">
                    </div>

                </form>
          </div>


      </section>







<?php include('layouts/footer.php'); ?>