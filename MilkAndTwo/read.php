<?php
	require 'database.php';				// include database.php into the code
	
	$id = null;
	
	if (!empty($_GET['id']))			// Check if the 'id' passed in is not empty
	{
		$id = $_REQUEST['id'];
	}
	
	if ($id == null)
	{
		header("Location: index.php");	// Redirect if 'id' is null
	}
	else
	{
		$pdo = Database::connect();		// Make database connection_aborted
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			// Set the case in which to return column_names - Error reporting, Throw exceptions  
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
                        <h3>Read a Customer</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['email'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['mobile'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="index.php">Back</a>
                       </div>
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
 