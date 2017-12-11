<div class="header">
    <div class="header_container">
        <div id="hamburger_button" onclick="setSideBarStatus()">
            &#9776;
        </div>
        <div id="header_right">
            <div id="notification" onclick="setNotificationPopupStatus()">
                <span id="how_many_notif">5</span>
                <img src="../../img/notificationIcon.png" alt="Notification Icon">
            </div>
            <div id="profile" onclick="window.location.href='vueProfil.php'">
                <div id="profile_image">
                    <img src="../../img/userIcon.png" alt="User Icon">
                </div>
                <div id="profile_text">
                    <span>DomISEP</span>
                </div>
            </div>
            <div id="logout" onclick="window.location.href='vueConnexion.php'">
                <img src="../../img/logoutIcon.png" alt="Logout Icon">
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
    <div id="elliot_icon" onclick="window.location.href='vueAccueil.php'">
        <div id="small_icon">
            <img src="../../img/smallellIoT.png" alt="Small ellIoT Icon">
        </div>
        <div id="big_icon" onclick="window.location.href='vueAccueil.php'">
            <img src="../../img/ellIoT.png" alt="Big ellIoT Icon">
        </div>
    </div>
    <div id="main_sidebar">
        <div class="elementsOfSidebar" onclick="window.location.href='vueAccueil.php'">
            <div class="iconOfSidebar">
                <img src="../../img/homeplanIcon.png" alt="Home Plan Icon">
            </div>
            <div class="textOfSidebar">
                Plan de la maison
            </div>
        </div>
        <div class="elementsOfSidebar" onclick="window.location.href='vueGestionBatiment.php'">
            <div class="iconOfSidebar">
                <img src="../../img/dashboardIcon.png" alt="Dashboard Icon">
            </div>
            <div class="textOfSidebar">
                Tableau de bord
            </div>
        </div>
        <div class="elementsOfSidebar" onclick="window.location.href='vueSensor.php'">
            <div class="iconOfSidebar">
                <img src="../../img/sensorIcon.png" alt="Sensor Icon">
            </div>
            <div class="textOfSidebar">
                Capteurs/actionneurs
            </div>
        </div>
        <div class="elementsOfSidebar" onclick="window.location.href='vueSupport.php'">
            <div class="iconOfSidebar">
                <img src="../../img/supportIcon.png" alt="Support Icon">
            </div>
            <div class="textOfSidebar">
                Support
            </div>
        </div>
    </div>
</div>
