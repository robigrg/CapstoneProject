<div class="Dashboard_Sidebar" id="Dashboard_Sidebar">
	<h1 class="Dashboard_Sidebar_Header" id="Dashboard_Sidebar_Header"> WAREHOUSE WARRIORS</h1>
	<h2 class="Dashboard_Sidebar_Welcome" id="Dashboard_Sidebar_Welcome">WELCOME!</h2>
	<div class="Dashboard_Sidebar_User">
		<img src="images/user/usericon.png" alt="User Image" id="User_Image" />
		<span><?=$user['FirstName'].''.$user['LastName']?></span>				
	</div>
	<div class="Dashboard_Sidebar_Menu">
		<ul class="Dashboard_Sidebar_Lists">
			<!--class="Menu_Active"-->
			<li>
				<a href="./dashboard.php"><i class="fas fa-dragon"></i> <span class="menuText">Dashboard</span></a>
			</li>
			<li>
				<a href="./orders.php"><i class="fa-solid fa-file-invoice-dollar"></i> <span class="menuText">Orders</span></a>
			</li>
			<li>
				<a href="./addproduct.php"><i class="fa fa-cart-plus"></i> <span class="menuText">Add Product</span></a>
			</li>
			<li>
				<a href="./adduser.php"><i class="fa fa-user-plus"></i> <span class="menuText">Account User</span></a>
			</li>
		</ul>
	</div>
</div>