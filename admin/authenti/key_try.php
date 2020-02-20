<?php

$email="mmn@narola.email";
$otp = rand(100000,999999);
$id=45;

$key = md5($email.$id.$otp);

echo $key;

?>