<?php
 

 
$type = "";
$statusMsg = "";
if(!empty($_POST['card_number']) && !empty($_POST['card_exp_month']) && !empty($_POST['card_exp_year']) && !empty($_POST['card_cvc'])){
    
	//echo '<pre>'; print_r($_POST); die;
     // Retrieve card and user info from the submitted form data 
    $name = $_POST['name']; 
    $email = $_POST['email']; 
	$course = $_POST['course']; 
	$fees = $_POST['amount']; 
    $card_number = preg_replace('/\s+/', '', $_POST['card_number']); 
    $card_exp_month = $_POST['card_exp_month']; 
    $card_exp_year = $_POST['card_exp_year']; 
    $card_exp_year_month = $card_exp_year.'-'.$card_exp_month; 
    $card_cvc = $_POST['card_cvc']; 
    
    require_once 'authorize-net.php';
    $authorizeNetPayment = new AuthorizeNetPayment();
    
    $response = $authorizeNetPayment->chargeCreditCard($_POST);
	

    
    if ($response != null)
    {
        $tresponse = $response->getTransactionResponse();
        
		// echo "<pre>";
		// print_r($response);		
		// exit();
		
		//echo $tresponse->getTransId(); die;
		
        if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
        {
            // Transaction info 
                $transaction_id = $tresponse->getTransId(); 
                $payment_status = $response->getMessages()->getResultCode(); 
                $payment_response = $tresponse->getResponseCode(); 
                $auth_code = $tresponse->getAuthCode(); 
                $message_code = $tresponse->getMessages()[0]->getCode(); 
                $message_desc = $tresponse->getMessages()[0]->getDescription(); 
                
                require_once "connection.php";
         // Insert tansaction data into the database 
                $sql = "INSERT INTO orders (name, email, coursename, fees, card_number, card_expirymonth, card_expiryyear, payment_id, status, created_at) VALUES ('".$name."', '".$email."', '".$course."','".$fees."','".$card_number."', '".$card_exp_month."', '".$card_exp_year."','".$transaction_id."', '".$payment_status."',  NOW())"; 
				
				
                $insert = mysqli_query($conn,$sql); 
                $paymentID = mysqli_insert_id($conn); 
                $ordStatus = 'success'; 
                $statusMsg = 'Your Payment has been Successful!'; 
            
        }else
        {
            $authCode = "";
            $paymentResponse = $tresponse->getErrors()[0]->getErrorText();
            $reponseType = "error";
            $statusMsg  = "Charge Credit Card ERROR :  Invalid response\n";
        }
    }
    else
    {
        $reponseType = "error";
        $statusMsg = "Charge Credit Card Null response returned";
    }
}
?>
 <div class="panel">
    <div class="panel-body">
     <div class="status">
	<?php if(!empty($paymentID)){ ?>
		<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
		
		<h4>Payment Information</h4>
		<p><b>Reference Number:</b> <?php echo $paymentID; ?></p>
		<p><b>Transaction ID:</b> <?php echo $transaction_id; ?></p>
		<p><b>Auth Code:</b> <?php echo $auth_code; ?></p>
		<p><b>Status:</b> <?php echo @$responseArr[$payment_response]; ?></p>
		
		<h4>Product Information</h4>
		<p><b>Name:</b> <?php echo $course; ?></p>
		<p><b>Price:</b> <?php echo $fees.'$'; ?></p>
	<?php }else{ ?>
		<h1 class="error">Your Payment has Failed</h1>
		<p class="error"><?php echo $statusMsg; ?></p>
	<?php } ?>
</div>
 
    </div>
</div>