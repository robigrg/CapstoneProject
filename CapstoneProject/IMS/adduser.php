 <?php
	//start the session
	session_start();

	if(!isset($_SESSION['user'])) header('location: login.php');
	$_SESSION['table'] = 'users';
	$user = $_SESSION['user'];
	$users = include('database/showuser.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warehouse Warrior IMS Dashboard - Inventory Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/a7d13aa081.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div id="Dashboard_Main">
		<?php include('sidebar.php') ?>
		<div class="Dashboard_Content_Container" id="Dashboard_Content_Container">
			<?php include('topnav.php') ?>
			<div class="Dashboard_Content">
				<div class="Dashboard_Content_Main">
					<div class="row">
						<div class="column column-5">
							<h1 class="section_header"><i class="fa fa-plus"></i> Create New User</h1>
							<div id="adduser_Container">
								<form action="database/adduser_connection.php" method="POST" class="appForm">
									<div class="appFormInput_Container">
										<label for="FirstName">First Name:</label>
											<input type="text" class="appFormInput" id="FirstName" name="FirstName"/>
									</div>
									<div class="appFormInput_Container">
										<label for="LastName">Last Name:</label>
											<input type="text" class="appFormInput"id="LastName" name="LastName"/>
									</div>
									<div class="appFormInput_Container">
										<label for="Email">Email:</label>
											<input type="text" class="appFormInput"id="Email" name="Email"/>
									</div>
									<div class="appFormInput_Container">
										<label for="Password">Password:</label>
											<input type="password" class="appFormInput"id="Password" name="Password"/>
									</div>
									<button type="submit" class="adduser_Button"><i class="fa fa-plus "></i> Add User</button>
								</form>
								<?php 
									if(isset($_SESSION['response'])){ 
										$response_message = $_SESSION['response']['message'];
										$is_success = $_SESSION['response']['success'];
								?>
								<div class="responseMessage">
									<p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>" >
										<?= $response_message ?>
									</p>
								</div>
								<?php unset($_SESSION['response']); } ?>
							</div>
						</div>
						<div class="column column-7">
							<h1 class="section_header"><i class="fa fa-list"></i> List of Users:</h1>
							<div class="section_content">
									<div class="users">
										<table>
											<thead>
												<tr>
													<th># </th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<th>Created At</th>
													<th>Updated At</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($users as $index => $user){ ?>
													<tr>	
														<td><?= $index+1 ?></td>
														<td class="firstname"><?= $user['FirstName'] ?></td>
														<td class="lastname"><?= $user['LastName'] ?></td>
														<td class="email"><?= $user['Email'] ?></td>
														<td><?= date('F d, Y', strtotime($user['Created'])) ?></td>
														<td><?= date('F d, Y', strtotime($user['Updated'])) ?></td>
														<td>
															<a href=""class="updateUser"><i class="fa fa-pencil"></i> Edit</a>
															<a href="" class="deleteUser" data-userid="<?= $user['ID']?>" data-fname="<?= $user['FirstName']?>" data-lname="<?= $user['LastName']?>"><i class="fa fa-trash-o"></i> Delete</a>
														</td>
													</tr>
												<?php }?>
											</tbody>
										</table>
										<p class="usercount"><?= count($users) ?> Users</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
<script src="js/script.js"></script>
<script src="js/jquery/jquery-3.6.1.min.js"></script>

<script>
	function script(){

		this.initialize = function(){
			this.registerEvents();
		},

		this.registerEvents = function(){
			document.addEventListener('click', function(e) {
				targetElement = e.target;
				classList = targetElement.classList;

				if(classList.contains('deleteUser')){
					e.preventDefault();
					userId = targetElement.dataset.userid;
					fname = targetElement.dataset.fname;
					lname = targetElement.dataset.lname;
					fullname= fname + ' ' + lname;


					if (window.confirm('Are you sure to delete '+fullname+' ?')){
						$.ajax({
							method:'POST',
							data:{
								user_id: userId,
								f_name: fname,
								l_name: lname,

							},
							url:'database/deleteuser.php',
							dataType: 'json',
							success: function(data){
								if(data.success){
									if(window.confirm(data.message)){
										location.reload();
									}
								}else window.alert(data.message);
							}

						})

					}else{
						console.log('will not delete');
					}
				}

				if(classList.contains('updateUser')){
					e.preventDefault(); //prevents from loading

					//fetch data
					firstName = targetElement.closest('tr').querySelector('td.firstname');
					lastName = targetElement.closest('tr').querySelector('td.lastname');
					email = targetElement.closest('tr').querySelector('td.email');

					BootstrapDialog.confirm({
						title: 'Update '+firstName+' '+lastName,
						message: firstName+' '+lastName+' '+email
					})
				}
			});
		}
	}
	var script = new script;
	script.initialize();

</script>

</body>
</html>