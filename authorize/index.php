<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Registration form</h2>
  <form method="post" action="payment-proccess.php">
    <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    
	
	 <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
	
	 <div class="mb-3 mt-3">
      <label for="course">Course:</label>
      <input type="text" class="form-control" id="course" placeholder="Enter course" name="course">
    </div>
	
	
	 <div class="mb-3 mt-3">
      <label for="amount">Fees Amount:</label>
      <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount">
    </div>
	
	 <div class="mb-3 mt-3">
      <label for="card_number">Card NO:</label>
      <input type="text" class="form-control" id="card_number" placeholder="1111 1111 1111 1111" name="card_number" maxlength="16">
    </div>
	
	 <div class="mb-3 mt-3">
      <label for="card_exp_month">Expiry Month:</label>
      <input type="text" class="form-control" id="card_exp_month" placeholder="MM" name="card_exp_month" maxlength="2">
    </div>
	
	<div class="mb-3 mt-3">
      <label for="card_exp_year">Expiry Year:</label>
      <input type="text" class="form-control" id="card_exp_year" placeholder="YYYY" name="card_exp_year" maxlength="4">
    </div>
	
	<div class="mb-3 mt-3">
      <label for="card_cvc">CVC Code:</label>
      <input type="text" class="form-control" id="card_cvc" placeholder="CVC Code" name="card_cvc" maxlength="3">
    </div>
	
	
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
