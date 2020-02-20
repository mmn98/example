<?php
include_once '../../includes/config.php';
include_once '../../classes/users.class.php';


$user = new Users();
if (isset($_POST['id'])) {
    $ids = $_POST['id'];

    $result = $user->multi_delete($ids);

    if ($result) {
        echo 'records deleted successfully';


    } else {
        echo "error";
        error_log("something wrong while perform multiple delete", 0);
    }
} else {

    echo "else";
}
?>

