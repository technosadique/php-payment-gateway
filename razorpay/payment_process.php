<?php
session_start();
include('db.php');
if(isset($_POST['amt']) && isset($_POST['name'])){
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($con,"INSERT INTO payment(name,amount,payment_status,added_on) VALUES('$name','$amt','$payment_status','$added_on')");
    $_SESSION['OID']=mysqli_insert_id($con);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    mysqli_query($con,"UPDATE payment SET payment_status='complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'");
}
?>