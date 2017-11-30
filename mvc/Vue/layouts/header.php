<div id="mainHeader">

      <header>
        <span id="hamburgerIcon" onclick="setSideBarStatus()">&#9776;</span>
        <div class="header_right">
            <div class="notificationPopup">
                <span id="how_many_notif">2</span>
                <img src="notificationIcon.png" alt="Notification Icon" onclick="setNotificationPopupStatus()">
            </div>

            <button class="buttonHeader" type="button" title="Profile">
                <a href="vueProfil.php"> <img src="../../img/userIcon.png" alt="User icon" title="Page de profil"/>DomISEP </a>
            </button>
            <a href="vueConnexion.php"> <img src="../../img/logoutIcon.png" alt="Logout icon" title="Logout"/> </a>


            <div id="container_notification">

                <div id="notification_title">
                    <span>Notifications</span>
                </div>

                <div id="notification_messages">
                    <div id="first_message">
                        <button>
                            Il y a de la merde dans ton chauffage.
                            En plus t'es moche.<br>
                            <span class="notificationDate">29 Nov 2017</span>
                        </button>
                    </div>
                    <div id="second_message">
                        <button>
                            Tes capteurs sont pourris.<br>
                            <span class="notificationDate">25 Nov 2017</span>
                        </button>
                    </div>
                    <div id="third_message">
                        <button>
                            Change de maison gros.<br>
                            <span class="notificationDate">19 Nov 2017</span>
                        </button>
                    </div>
                    <div id="fourth_message">
                        <button>
                            elliot c'est le best.<br>
                            <span class="notificationDate">08 Oct 2017</span>
                        </button>
                    </div>
                    <div id="fifth_message">
                        <button>
                            Vavelin le king.<br>
                            <span class="notificationDate">17 Avr 1998</span>
                        </button>
                    </div>
                </div>

                <div id="notification_footer">
                    <button onclick="window.location.href='../../Documents/login.html'">Voir toutes les notifications</button>
                </div>
            </div>
        </div>
      </header>

  </div>
