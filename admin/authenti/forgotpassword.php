
<?php
include_once '../../includes/config.php';
include_once '../../classes/auth.class.php';
include_once '../../classes/common.class.php';
include '../../classes/mailer.class.php';


$conn = new Common();


$err_msg = '';
$success_msg = '';
if (isset($_REQUEST['submit']))
{
    $email_value = $_REQUEST['email'];
    // echo $email_value;
    $email_value1 = "'". $_REQUEST['email']."'";
    //echo $email_value1;

    $users = $conn->db->rawQuery("SELECT email FROM usres WHERE admin = 1 AND email = $email_value1");

    if($users!=NULL)
    {
        
        $send = new Mailer();
        $success=$send->send($email_value);
        
        if($success)
        {
            
            $success_msg = $success;
        }
        
    }
    else
    {
        $err_msg="Not valid Email-id.";
    }
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Reset Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <section class="content">

            <div class="row">
                <div class="col-lg-offset-4 col-lg-4">
                    <section class="panel">

                        <header class="panel-heading">
                            <h2>Reset Password</h2>
                        </header>

                        <div class="panel-body">
                            <form id="myform" name="myform" class="form-horizontal" method="POST" action="">

                                 <div class="form-group">
                                    <p style="color:red;"><?php echo $err_msg; ?></p></br>
                                    <h4 style="color:green;"><?php echo $success_msg; ?></h4>
                                </div> 

                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="email"  name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" name="submit" value="submit" class="btn btn-info" >Ok</button>
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
    
	include_once '../../includes/footer.php';
?>

<script>
     $("#myform").validate({
   rules: {
        email : {
            required: true,
            email: true,
            
        }
   },
   messages: {
        email: {
        required: "We need your email address to contact you",
        email: "Your email address must be in the format of name@domain.com"
        }
   }

 });

</script>

