<?php
require_once '../../classes/users.class.php';
include_once '../../includes/hadder.php';
?>

<!-- Main content aside-->
<html>
<head>	
		
		
</head>
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php
			$display = 'none';
			if (isset($_SESSION['flash_success_msg']) && $_SESSION['flash_success_msg'] != '') {
				$display = 'block';
			}
			?>
				<div id="alert" class="alert alert-success alert-block fade in" style="display:<?php echo $display; ?>">
					<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
					</button>
					<h4>
					<i class="icon-ok-sign"></i>
					Success!
					</h4>
					<p>
						<?php echo $_SESSION['flash_success_msg']; ?>
					</p>
				</div>
				
				<?php
			$_SESSION['flash_success_msg'] = '';
			?>
				<div class="panel">
					<header class="panel-heading">
						Users
					</header>
					<div class="panel-body">
						<form id="myform" name="myform" action="" method="POST" onsubmit="return check_select();"> 
							<div class="panel-body">
								<a href="add.php" class="btn btn-primary">Add New</a>
								<input class="btn btn-danger" type="submit" name="delete_selected" value="Delete Selected" onclick="multi_delete()"/>
							</div>
							<table  id="resizable"  style="width:100%" class="cell-border hover display" />
								<thead>
									<tr>
										<th><input type="checkbox"  onclick="select_all(this);" /></th>
										<th>username</th>
										<th>Email</th>
										<th>city</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
								$user = new Users();
								$users = $user->get_all();

								foreach ($users as $user) { 
                                                     //  print_r($user) ;
									?>
									
												<tr id="user_<?php echo $user['id'] ?>">
													<td>
														<input type="checkbox" name="users[]" value="<?php echo $user['id'] ?>" class="check_multiple" style="margin-left: 10px;"/>
													</td>
													<td>
														<?php echo ucwords($user['username']) ?>
													</td>
												
													<td><a href="mailto:<?php echo $user['email'] ?>">
													<?php echo $user['email'] ?></a></td>
												
													<td>
														<?php echo ucwords($user['city']) ?>
													</td>

													<td>
														<a href="edit.php?id=<?php echo $user['id'] ?>">Edit</a> | <a href="javascript:void(0);" onclick="delete_user_function(<?php echo $user['id'] ?>)">Delete</a>
													</td>
												</tr>
									<?php

							}
							?>
								</tbody>
							</table>
							</form>			
						
					<!-- pagination link section removed -->
						</div><!-- /.panel-body -->
					</div>
				</div>
			</div>
		</section>
	</aside>
	<!-- /Main content aside-->
</html>


<script src = "https://code.jquery.com/jquery-3.3.1.js"></script>
		    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	

	
<?php
include_once '../../includes/footer.php';
?>


<script type="text/javascript">
/*$(user_id).click(
 function() {
			$( "#dialog" ).dialog();
			} );*/

function delete_user_function(user_id)
 {
		

    if(confirm('Are you sure you want to delete this record?'))
    {
        $.ajax({
            url: 'delete.php',
            type: 'POST',
            data: { id: user_id },
            success: function(response) {
                $('#user_'+user_id).remove();
                $('#alert p').text(response);
                $('#alert').css('display', 'block');
            },
        });
	}
}
</script>