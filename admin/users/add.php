<?php

include_once '../../includes/config.php';
    //include_once '../../classes/users.class.php';
include_once '../../classes/users.class.php';


$user = new Users();

if (isset($_REQUEST['submit'])) {

	$data['username'] = $_REQUEST['username'];
	$data['email'] = $_REQUEST['email'];
	$data['password'] = md5('123');
	$data['city'] = $_REQUEST['city'];
	$data['admin'] = 0;


	$result = $user->add($data);
//	print_r($result);

	if ($result) {
		$_SESSION['flash_success_msg'] = 'New record created successfully';
		header('Location:' . ADMIN_URL . '../users/index.php');
		exit();
	} else {
		echo 'error';
		error_log("something wrong while perform add", 0);
	}
}

include_once '../../includes/hadder.php';

?>
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<header class="panel-heading">
						Add New User
					</header>
					<div class="panel-body">
						<form id="myform" name="myform" class="form-horizontal tasi-form" method="POST" action="" onsubmit="">
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Username</label>
								<div class="col-sm-10">
									<input type="text"  name="username" id="username" class="form-control">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email"  name="email" id="email" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">City</label>
								<div class="col-sm-10">
									<select class="form-control m-b-10" name="city" id="city">
										<option value="">Please Select City</option>
										<option value="surat">Surat</option>
										<option value="ahmedabad">Ahmedabad</option>
										<option value="delhi">Delhi</option>
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


	<?php
include_once '../../includes/footer.php';
?>


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
				},
				city : {
					required : true 
				}
            
        },
        messages: {
        username : {
                required: "username must be entered",
                minlength: "username include atleast 2 characher"
                },
                email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
				},
				city : {
					required : "city must be required"
				}
                
        }

        });
</script>
	<!-- /Main content aside-->


