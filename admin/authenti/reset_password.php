<?php

include_once '../../includes/config.php';
include_once '../../classes/auth.class.php';
//include_once '../../classes/common.class.php';

$auth = new Auth();

$err_msg = '';
$success_msg = '';
$id = $_GET['id'];
$otp_enc = $_GET['otp'];
$exp_time = $_GET['time'];
$key = $_GET['key'];
   // echo $exp_time;
   //fetching current time to check with GET variable's time
$cur_time = time();
//check the key is same as database or not?

  
if ($exp_time > $cur_time) {
   
       // echo $otp_enc;
       // echo $emailid;
    $result = $auth->match_key($id,$key);
    if($result == true)
    {

        if (isset($_REQUEST['submit'])) {
            $otpset = $_REQUEST['otp'];
            $otp_val = md5($otpset);
            $password = md5($_REQUEST['password']);
            
            //  echo $password;
            $conformpsw = md5($_REQUEST['conformpsw']);

            if ($otp_val == $otp_enc) {
                // echo "OTP matched successfully";
                if ($password != $conformpsw) {
                    $err_msg = "not matched conform password";
                    error_log("$err_msg", 0);
                } else {
                    $result = $auth->update_password($password, $id);
                    if ($result == true) {
                        $success_msg = "sucessfully password change";
                    } else {
                        $err_msg = $result;
                    }
                }
                //  include 'check.php';
            } else {
                $err_msg = 'incorrect otp';
                error_log("$err_msg", 0);
            }
        }
    }
    else{
        echo "key is not matched.you can`t change password";
    }
           
        //echo $emailid;
    ?>
                    <html>
                    <head>
                            <meta charset="UTF-8">
                            <title>Sample Admin Panel | Admin Login</title>
                            <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
                            <meta name="description" content="Developed By M Abdur Rokib Promy">
                            <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
                            <!-- bootstrap 3.0.2 -->
                            <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                            <!-- font Awesome -->
                            <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
                            
                    </head>
                                        <section class="content">
                                            
                                        <div class="row">
                                            <div class="col-lg-offset-4 col-lg-4">
                                                <section class="panel">

                                                    <header class="panel-heading">
                                                        <h2>Reset Password</h2>
                                                    </header>

                                                    <div class="panel-body">
                                                        <form id="myform1" name="myform" class="form-horizontal" method="POST" action="">
                                                            <div class="form-group">
                                                                <p style="color:red;"><?php echo $err_msg; ?></p>
                                                                <h4 style="color:green;"><?php echo $success_msg; ?></h4>
                                                            </div> 

                                                        <!--    <div class="form-group">
                                                                    <div class="col-lg-10">
                                                                        <input type="hidden"  name="id" class="form-control" id="id" value="<?php echo $id ?>">
                                                                    </div>
                                                            </div> -->

                                                            <div class="form-group">
                                                                    <label for="otp" class="col-lg-2 col-sm-2 control-label">OTP</label>
                                                                    <div class="col-lg-10">
                                                                        <input type="number"  name="otp" class="form-control" id="otp" placeholder="Enter OTP">
                                                                    </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="password" class="col-lg-2 col-sm-2 control-label">Password</label>
                                                                <div class="col-lg-10">
                                                                    <input type="password"  name="password" class="form-control" id="password" placeholder="Enter password">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="conformpsw" class="col-lg-2 col-sm-2 control-label">Confrom Password</label>
                                                                <div class="col-lg-10">
                                                                    <input type="password"  name="conformpsw" class="form-control" id="conformpsw" placeholder="Enter conform password">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-lg-offset-2 col-lg-10">
                                                                    <button type="submit" name="submit" value="submit" class="btn btn-success">submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </section>
                    </html>                
<?php   

      //  echo "link is active";
} else {
    echo "link is not active now.";
}
include_once '../../includes/footer.php';
?>

<script>

      $( "#myform1" ).validate({
        rules: {
            otp: "required",
          password: "required",
          conformpsw: {
            equalTo: "#password"
          }
        }
      });

</script>

