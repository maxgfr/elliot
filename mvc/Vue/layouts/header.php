<link rel="stylesheet" href="../../css/header.css">
<link rel="shortcut icon" href="../../img/smallellIoTICO.ico"/>
<script src="../../js/header.js"></script>
<script src="../../js/jquery-3.2.1.min.js"></script>

<div class="header">
    <div class="header_container">
        <div id="hamburger_button" onclick="setSideBarStatus()">
            &#9776;
        </div>

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

            <div id="notification" onclick="setNotificationPopupStatus()" class="header_hover">
                <span id="how_many_notif">5</span>
                <img src="../../img/notificationIcon.png" alt="Notification Icon">
            </div>
            <!--Changer avec getVue()-->
            <div id="profile" onclick="window.location.href='vueProfil.php'" class="header_hover">
                <div id="profile_image">
                    <img src="../../img/userIcon.png" alt="User Icon">
                </div>
                <div id="profile_text">
                    <span><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></span>
                </div>
            </div>
            <div id="logout" class="header_hover">
                <a href="../Modeles/Logout.php"><img src="../../img/logoutIcon.png" alt="Logout Icon" id="Logout_button"/></a>
            </div>
        </div>
    </div>
</div>

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

<div class="sidebarContainer">
    <div id="elliot_icon" onclick="GoTo('vueAccueil.php')">
        <div id="small_icon">
            <img src="../../img/smallellIoT.png" alt="Small ellIoT Icon">
        </div>
        <div id="big_icon" onclick="GoTo_big_icon('vueAccueil.php')">
            <img src="../../img/ellIoT.png" alt="Big ellIoT Icon">
        </div>
    </div>
    <div id="main_sidebar">
        <div class="elementsOfSidebar" onclick="GoTo('vueAccueil.php')" id="elementsOfSidebar_Accueil">
            <div class="iconOfSidebar">
                <img src="../../img/homeplanIcon.png" alt="Home Plan Icon">
            </div>
            <div class="textOfSidebar">
                Habitation
            </div>
        </div>
        <div class="elementsOfSidebar" onclick="GoTo('vueTableauDeBord.php')"
             id="elementsOfSidebar_Tableau">
            <div class="iconOfSidebar">
                <img src="../../img/dashboardIcon.png" alt="Dashboard Icon">
            </div>
            <div class="textOfSidebar">
                Tableau de bord
            </div>
        </div>
        <div class="elementsOfSidebar" onclick="GoTo('vueSensor.php')" id="elementsOfSidebar_Sensor">
            <div class="iconOfSidebar">
                <img src="../../img/sensorIcon.png" alt="Sensor Icon">
            </div>
            <div class="textOfSidebar">
                Capteurs/actionneurs
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
        <div class="elementsOfSidebar" onclick="GoTo('vueAdmin.php')" style="display: none"
             id="elementsOfSidebar_Admin">
            <div class="iconOfSidebar">
                <img src="../../img/adminIcon.png" alt="Admin Icon">
            </div>
            <div class="textOfSidebar">
                Administrateur
            </div>
        </div>
    </div>
</div>

<?php include('toggle.php'); ?>
