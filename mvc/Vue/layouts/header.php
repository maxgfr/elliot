<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
	This layout displays the overall "header" of every view.
	It is built in 2 parts :
	- The top displays options to change the sidebar, ŝwitch status,
	check notifications, look at profile page and logout.
	- The sidebar displays the views that can be accessed according
	to the current user's status.
-->
<!-- //////////////////////////////////////////////////////////// -->




<link rel="shortcut icon" href="../../img/smallellIoTICO.ico"/>
<script src="../../js/header.js"></script>
<link rel="stylesheet" href="../../css/header.css">
<script src="../../js/jquery-3.2.1.min.js"></script>

<!-- Display the top options. -->
<div class="header">
	<!-- Display the Retract/Expand sidebar option. -->
	<div class="header_container">
		<div id="hamburger_button" onclick="setSideBarStatus()">
			&#9776;
		</div>
		<!-- Display the status switch option if the user account is both a client and an admin. -->
		<div id="header_right">
			<div id="toggle_button">
				<div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
					<label class="onoffswitch-label" for="myonoffswitch">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			</div>
			<!-- Display the notifications and its dynamic. -->
			<div id="notification" onclick="setNotificationPopupStatus()" class="header_hover">
				<span id="how_many_notif">5</span>
				<img src="../../img/notificationIcon.png" alt="Notification Icon">
			</div>
			<!-- Display the profile page option customized by the user's name. -->
			<div id="profile" onclick="window.location.href='vueProfil.php'" class="header_hover">
				<div id="profile_image">
					<img src="../../img/userIcon.png" alt="User Icon">
				</div>
				<div id="profile_text">
					<span><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></span>
				</div>
			</div>
			<!-- Display the logout option. -->
			<div id="logout" class="header_hover">
				<a href="../Modeles/Logout.php"><img src="../../img/logoutIcon.png" alt="Logout Icon" id="Logout_button"/></a>
			</div>
		</div>
	</div>
</div>

<!-- Display an example of potential notifications. -->
<div id="container_notification">
	<div id="notification_title">
		<span>Notifications</span>
	</div>
	<div id="notification_messages">
		<div id="first_message">
			<button>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit <br>
				<span class="notificationDate">29 Nov 2017</span>
			</button>
		</div>
		<div id="second_message">
			<button>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit <br>
				<span class="notificationDate">25 Nov 2017</span>
			</button>
		</div>
		<div id="third_message">
			<button>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit <br>
				<span class="notificationDate">19 Nov 2017</span>
			</button>
		</div>
		<div id="fourth_message">
			<button>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit <br>
				<span class="notificationDate">08 Oct 2017</span>
			</button>
		</div>
		<div id="fifth_message">
			<button>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit <br>
				<span class="notificationDate">17 Avr 1998</span>
			</button>
		</div>
	</div>

	<div id="notification_footer">
		<button onclick="window.location.href='vueNotifications.php'">Voir toutes les notifications</button>
	</div>
</div>



<!-- Display the sidebar options. -->
<div class="sidebarContainer" id="sidebarContainer">
	<!-- Display the "Elliot". -->
	<div id="elliot_icon" onclick="GoTo_icon('vueAccueil.php')">
		<div id="small_icon">
			<img src="../../img/smallellIoT.png" alt="Small ellIoT Icon">
		</div>
		<div id="big_icon" onclick="GoTo_icon('vueAccueil.php')">
			<img src="../../img/ellIoT.png" alt="Big ellIoT Icon">
		</div>
	</div>

	<!-- Display the views according to the user's current status. -->
	<div id="main_sidebar">
		<div class="elementsOfSidebar" onclick="GoTo('vueAccueil.php')" id="elementsOfSidebar_Accueil">
			<div class="iconOfSidebar">
				<img src="../../img/homeplanIcon.png" alt="Home Plan Icon">
			</div>
			<div class="textOfSidebar">
				Habitation
			</div>
		</div>

		<div class="elementsOfSidebar" onclick="GoTo('vueTableauDeBord.php')" id="elementsOfSidebar_Tableau">
			<div class="iconOfSidebar">
				<img src="../../img/dashboardIcon.png" alt="Dashboard Icon">
			</div>
			<div class="textOfSidebar">
				Tableau de bord
			</div>
		</div>

		<div class="elementsOfSidebar" onclick="GoTo('vueSupport.php')" id="elementsOfSidebar_Support">
			<div class="iconOfSidebar">
				<img src="../../img/supportIcon.png" alt="Support Icon">
			</div>
			<div class="textOfSidebar">
				Support technique
			</div>
		</div>

		<div class="elementsOfSidebar" onclick="GoTo('vueAdmin.php')" style="display: none" id="elementsOfSidebar_Admin">
			<div class="iconOfSidebar">
				<img src="../../img/adminIcon.png" alt="Admin Icon">
			</div>
			<div class="textOfSidebar">
				Administrateur
			</div>
		</div>

		<div class="elementsOfSidebar" onclick="GoTo('vueAdmin_personne.php')" style="display: none" id="elementsOfSidebar_AdminPersonne">
			<div class="iconOfSidebar">
				<img src="../../img/adminIcon.png" alt="Admin Icon">
			</div>
			<div class="textOfSidebar">
				Statut
			</div>
		</div>

		<div class="elementsOfSidebar" onclick="GoTo('vueAffBatiment.php')" style="display: none" id="elementsOfSidebar_AffBatiment">
			<div class="iconOfSidebar">
				<img src="../../img/adminIcon.png" alt="Admin Icon">
			</div>
			<div class="textOfSidebar">
				Affichage bâtiment
			</div>
		</div>

		<div class="elementsOfSidebar" onclick="GoTo('vueAjoutBatiment.php')" style="display: none" id="elementsOfSidebar_AjoutBatiment">
			<div class="iconOfSidebar">
				<img src="../../img/adminIcon.png" alt="Admin Icon">
			</div>
			<div class="textOfSidebar">
				Ajout bâtiment
			</div>
		</div>

	</div>

</div>


<!-- Let the status switch change the visual apparence and allowed views according to the user's current status. -->
<?php include('toggle.php'); ?>
