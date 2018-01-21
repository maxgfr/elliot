<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
	This layout displays the whole proccess while activating the
	status switch to change from client interface to admin
	interface, in case of the user being both.

	The status of the account is thought as follows :
	Client : Role 0
	Admin : Role 1
	Client/Admin : Role 2
	Obviously, only the role 2 can have a displayed status switch 
	and therefore, needs a cookie to keep his current status
	while navigating.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!-- 
	While this code is almost fully JS, the need to check the 
	user's role in the server database means theses lines needs
	to be in a PHP file.
-->
<script>
	// Set the views when loging in, and the cookie for role 2.
    if (!getCookie("cookie_toggle_state")) {
        switch (<?php echo $_SESSION['role'] ?>) {
            case 0:
                document.getElementById("toggle_button").remove();
                $('#elementsOfSidebar_Admin').remove();
                $('#elementsOfSidebar_AdminPersonne').remove();
                $('#elementsOfSidebar_Support').css({"display": ""});
                $('#elementsOfSidebar_Tableau').css({"display": ""});
                $('#elementsOfSidebar_Accueil').css({"display": ""});
                $('.sidebarContainer').css({"background-color": "rgb(38, 67, 120)"});
                break;

            case 1:
                document.getElementById("toggle_button").remove();
                $('#elementsOfSidebar_Admin').css({"display": ""});
                $('#elementsOfSidebar_AdminPersonne').css({"display": ""});
                $('#elementsOfSidebar_Support').remove();
                $('#elementsOfSidebar_Tableau').remove();
                $('#elementsOfSidebar_Accueil').remove();
                $('.sidebarContainer').css({"background-color": "rgb(46, 50, 62)"});
                $('.header').css({"background-color": "rgb(78, 85, 106)"});
                $('#hamburger_button').css({"color": "rgb(78, 85, 106)"});
                $('#notification').remove();
                break;

            case 2:
                document.cookie = "cookie_toggle_state=1";
                useTheCookieLuke();
                break;
        }
    }


    // Set the position of the switch to display the views accordingly.
    $(document).ready(function () {
        var verif = getCookie("cookie_toggle_state") == "1";

        if (verif) {
            $('#myonoffswitch').prop("checked", true);
        }

        else if (!verif) {
            $('#myonoffswitch').prop("checked", false);
        }

        $("#myonoffswitch").click(function () {
            if ($('#myonoffswitch').is(':checked') == false) {
                document.cookie = "cookie_toggle_state=0";
                useTheCookieLuke();
                window.location.href = 'vueAccueil.php';
            }
            else {
                document.cookie = "cookie_toggle_state=1";
                useTheCookieLuke();
                window.location.href = 'vueAdmin.php';
            }
        })

        useTheCookieLuke();
    });


    // Define a function to retrieve the "current status" cookie for check purposes.
    function getCookie(attribute) {
        var searchedSection = attribute + "=";
        var cookieArray = document.cookie.split(';');
        for (var i = 0; i < cookieArray.length; i++) {
            var randomSection = cookieArray[i];
            while (randomSection.charAt(0) == ' ') {
                randomSection = randomSection.substring(1);
            }
            if (randomSection.indexOf(searchedSection) == 0) {
                return randomSection.substring(searchedSection.length, randomSection.length);
            }
        }
        return null;
    }


    // Define a function to display the views according to the user's current status, mostly dedicated for role 2.
    function useTheCookieLuke() {
        var verif = getCookie("cookie_toggle_state") == "1";

        if (!verif) {
            $('#elementsOfSidebar_Support').css({"display": ""});
            $('#elementsOfSidebar_Tableau').css({"display": ""});
            $('#elementsOfSidebar_Accueil').css({"display": ""});
            $('.sidebarContainer').css({"background-color": "rgb(38, 67, 120)"});
            if (<?php echo $_SESSION['role'] ?> == 2)
            {
               $('#elementsOfSidebar_Admin').css({"display": "none"});
               $('#elementsOfSidebar_AdminPersonne').css({"display": "none"});
            }
            if (<?php echo $_SESSION['role'] ?> == 1)
            {
               $('#elementsOfSidebar_Admin').css({"display": ""});
               $('#elementsOfSidebar_AdminPersonne').css({"display": ""});
               $('.sidebarContainer').css({"background-color": "rgb(46, 50, 62)"});
            }
        }
        else if (verif) {
            $('#elementsOfSidebar_Admin').css({"display": ""});
            $('#elementsOfSidebar_AdminPersonne').css({"display": ""});
            $('#elementsOfSidebar_Support').css({"display": "none"});
            $('#elementsOfSidebar_Tableau').css({"display": "none"});
            $('#elementsOfSidebar_Accueil').css({"display": "none"});
            $('.sidebarContainer').css({"background-color": "rgb(46, 50, 62)"});
            $('.header').css({"background-color": "rgb(78, 85, 106)"});
            $('#hamburger_button').css({"color": "rgb(78, 85, 106)"});
            $('#notification').remove();
        }
    }


    // Define a function to access the view of a displayed view option in the sidebar.
    // It is prefered to the "href" segment to check the disponibility of the server.
    function GoTo(page) {
        $.ajax(
            {
                success: function () {
                    window.location.href = page;
                }
            })
    }


    // Define a function to access the default view according to the user's current status
    // when clicking on the icon.
    function GoTo_icon(page) {
        var verif = getCookie("cookie_toggle_state") == "1";

        if (verif || <?php echo $_SESSION['role'] ?> == 1) {
            window.location.href = 'vueAdmin.php';
        }
        else {
            window.location.href = page;
        }
    }


    // Delete the "current status" cookie when loging out.
    $('#Logout_button').click(function () {
        document.cookie = "cookie_toggle_state=0; expires=Thu, 18 Dec 2013 12:00:00 UTC";
    });

</script>
