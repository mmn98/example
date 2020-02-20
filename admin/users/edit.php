<?php
include_once '../../includes/config.php';
include_once '../../classes/users.class.php';


$user = new Users();
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
} else {
	header('Location:users.php');
}


if (isset($_REQUEST['submit'])) {
	$data['username'] = $_REQUEST['username'];
	$data['email'] = $_REQUEST['email'];
	$data['city'] = $_REQUEST['city'];
        //$password  = md5('123');
       
        
        //$result_edit= $user->edit_user($id,$firstname,$lastname,$email,$city,$dob);

	$result = $user->edit($id, $data);
	if ($result) {
		$_SESSION['flash_success_msg'] = "A record has been updated successfully";
           // echo "A record has been updated successfully";
		header('Location:' . ADMIN_URL . '../users/');
		exit();
            //echo $edit_user1;
	} else {
		echo "error";
		error_log("something wrong while perform edit", 0);
	}
} else {


	$result = $user->showdata($id);
        //print_r($user);


	$username = $result['username'];
	$email = $result['email'];
	$city = $result['city'];
    
       // echo "ELSE PART";*/

}
include_once '../../includes/hadder.php';

?>


<!-- Main content aside-->
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<header class="panel-heading">
						Edit User
					</header>
					<div class="panel-body">
						<form id="myform" name="myform" class="form-horizontal tasi-form" method="POST" action="">
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Fristname</label>
								<div class="col-sm-10">
									<input type="text"  name="username" id="username" class="form-control" value="<?php echo $username; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email"  name="email" id="email" class="form-control" value="<?php echo $email; ?>">
								</div>
							</div>

                            <div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">City</label>
								<div class="col-sm-10">

									<select class="form-control m-b-10" name="city" id="city">
										<option value="">Please Select City</option>
										<option value="surat"										                     										                  <?php

																																																																																									if ($city == 'surat') {
																																																																																										echo 'selected';
																																																																																									}

																																																																																									?>>Surat</option>
										<option value="ahmedabad"										                         										            <?php

																																																																																											if ($city == 'ahmedabad') {
																																																																																												echo 'selected';
																																																																																											}

																																																																																											?>>Ahmedabad</option>
										<option value="delhi"										                     										                <?php

																																																																																							if ($city == 'delhi') {
																																																																																								echo 'selected';
																																																																																							}

																																																																																							?>>Delhi</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label"></label>
								<div class="col-lg-10">
									<button type="submit" name="submit" value="submit" class="btn btn-info">Save</button>
								</div>
							</div>
						</form>
						</div><!-- /.panel-body -->
					</div>
				</div>
			</div>
		</section>
	</aside>

    

<script type="text/javascript">
        $("#myform").validate({
        rules: {

                username : {
                required: true  ,
                minlength: 2
                },
                email : {
                    required: true,
                    email: true
                }
            
        },
        messages: {
        username : {
                required: "username must be entered",
                minlength: "password include atleast 2 characher"
                },
                email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
                }
                
        }

        });
</script>

<?php
include_once '../../includes/footer.php';
?>