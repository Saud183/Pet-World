<?php


session_start();

if(isset($_POST['order_pay_btn']) ){

    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}


// api to get the rate of dollar
function convertCurrency($amount,$from_currency,$to_currency){
  $apikey = 'cc0be6cf7ee264704be8';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free URL if you're using the free version
  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 2, '.', '');
}

?>






<?php include('layouts/header.php'); ?>

<title>Payment | Pet World</title>
 

      <!--payment-->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>

        <!--if the user comes to this pay through order details-->
        <div class="mx-auto container text-center">

        <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>

          <?php  $amount = $_POST['order_total_price']; ?>
          <?php $amount =  convertCurrency($amount, 'INR', 'USD'); ?>
          <?php //$amount = $amount / 70; ?>
          <?php //$amount = number_format((float)$amount, 2, '.', ''); ?>

          

        <?php  #$amount = strval($_POST['order_total_price']); ?>
        
        <?php $order_id = $_POST['order_id']; ?>

        <p>Total Payment: ₹<?php echo $_POST['order_total_price']; ?></p>
        
        <div id="paypal-button-container"></div>

        
        <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>

          <!-- The user comes to this page from checkout -->
          
          <?php  $amount = $_SESSION['total']; ?>
          <?php $amount =  convertCurrency($amount, 'INR', 'USD'); ?>
          <?php //$amount = $amount / 70; ?>
          <?php //$amount = number_format((float)$amount, 2, '.', ''); ?>

            <?php # $amount = strval($_SESSION['total']); ?>

            <?php $order_id = $_SESSION['order_id']; ?>
     

            <p>Total payment: ₹<?php echo $_SESSION['total']; ?></p>
            
            <div id="paypal-button-container"></div>


        

        <?php }else{ ?>

            <!-- The user lands on this page through some other way -->
            <p>You have not ordered anything yet</p>

        <?php } ?>
        

        

        </div>


    </section>




    <!--Code from paypal-->

    <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AVFjeiS8We0VZb5WIjNdS0C6MtpnnAGh6ZfOWJViEpP2rrKqKQQEEivAaZxbdzcBWj861S0gXIc9vWke&currency=USD"></script>

    

    <script>
      paypal.Buttons({

        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php echo $amount; ?>' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
              }
            }]
          });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id; ?>;

            // When ready to go live, remove the alert and show a success message within this page. For example:
            // var element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');

    </script>


<?php include('layouts/footer.php'); ?>