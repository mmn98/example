<?php
include_once 'display.php';




$name = $_SESSION['username'];
//echo $name;


$db = new MysqliDb ('localhost', 'root', '', 'myexample');
$conn = new Common();
$conn->con($db);
$return_array = array();

$db->where ("username",$name);
$user = $db->getOne ("usres");

//$mail = $user['email'];

//print_r($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    
</head>
<body>

<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
                <table>
                    <tr>
                        <h4>Username: <?php echo $name?></h4>
                    </tr>
                    <tr>
                        <h4>your email is: <?php echo $user['email']?></h4>
                    </tr>
                    <tr>
                        <h4>your city is: <?php echo $user['city']?></h4>
                    </tr>
            </div>
        </div>
    </section>
</aside>  
</body>
</html>