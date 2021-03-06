<?php 
	// This is where the record is saved
	// works in the way that the code loads first, checks whether anything has been posted by the page and if so then 
	// go through the php saving record process
	
	require 'database.php';
	
	if (!empty($_POST))
	{
		// keep track validation errors -  if any of these are not empty then at ternary if/else in html then we will add 'error' to css class
		$nameError = null;
		$emailError = null;
		$mobileError = null;
		
		// keep track of posted values
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		
		// validate input
		$valid = true;
		if (empty($name))
		{
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($email))
		{
			$emailError = 'Please enter Email Address';
			$valid = false;
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))			// Use the filter function to check whether the email address is valid
		{
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($mobile))
		{
			$mobileError = 'Please enter Mobile Number';
			$valid = false;
		}
		
		// insert data
		if ($valid)
		{
			$pdo = Database::connect();											// Connect to database
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		// Set the case in which to return column_names - Error reporting, Throw exceptions  
			$sql = "INSERT INTO customers(name, email, mobile) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $email, $mobile));
			Database::disconnect();
			header("Location: index.php");										// Redirect to index.php	
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>