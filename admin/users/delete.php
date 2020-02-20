<?php
include_once '../../includes/config.php';
include_once '../../classes/users.class.php';

$user = new Users();

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	$result = $user->deleterecord($id); 
   // echo $result;
	if ($result != null) {
		echo 'Record deleted successfully...';
		exit();

	} else {
		echo 'error';
		error_log("something wrong while perform delete", 0);
	}
} else {
	header('Location:../users/index.php');
}

?>
