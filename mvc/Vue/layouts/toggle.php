<script>

    if (!getCookie("cookie_toggle_state")) {
        switch (<?php echo $_SESSION['role'] ?>) {
            case 0:
                document.getElementById("toggle_button").remove();
                $('#elementsOfSidebar_Admin').remove();
                $('#elementsOfSidebar_AdminPersonne').remove();
                $('#elementsOfSidebar_Support').css({"display": ""});
                $('#elementsOfSidebar_Sensor').css({"display": ""});
                $('#elementsOfSidebar_Tableau').css({"display": ""});
                $('#elementsOfSidebar_Accueil').css({"display": ""});
                $('.sidebarContainer').css({"background-color": "rgb(38, 67, 120)"});

                break;
            case 1:
                document.getElementById("toggle_button").remove();
                $('#elementsOfSidebar_Admin').css({"display": ""});
                $('#elementsOfSidebar_AdminPersonne').css({"display": ""});
                $('#elementsOfSidebar_Support').remove();
                $('#elementsOfSidebar_Sensor').remove();
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

    $(document).ready(function () {
        console.log(document.cookie);
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

    function useTheCookieLuke() {
        var verif = getCookie("cookie_toggle_state") == "1";

        if (!verif) {
            if (<?php echo $_SESSION['role'] ?> == 2)
            {
               $('#elementsOfSidebar_Admin').css({"display": "none"});
               $('#elementsOfSidebar_AdminPersonne').css({"display": "none"});
            }
            if (<?php echo $_SESSION['role'] ?> == 1)
            {
               $('#elementsOfSidebar_Admin').css({"display": ""});
               $('#elementsOfSidebar_AdminPersonne').css({"display": ""});
            }
            $('#elementsOfSidebar_Support').css({"display": ""});
            $('#elementsOfSidebar_Sensor').css({"display": ""});
            $('#elementsOfSidebar_Tableau').css({"display": ""});
            $('#elementsOfSidebar_Accueil').css({"display": ""});
            $('.sidebarContainer').css({"background-color": "rgb(38, 67, 120)"});
        }
        else if (verif) {
            $('#elementsOfSidebar_Admin').css({"display": ""});
            $('#elementsOfSidebar_AdminPersonne').css({"display": ""});
            $('#elementsOfSidebar_Support').css({"display": "none"});
            $('#elementsOfSidebar_Sensor').css({"display": "none"});
            $('#elementsOfSidebar_Tableau').css({"display": "none"});
            $('#elementsOfSidebar_Accueil').css({"display": "none"});
            $('.sidebarContainer').css({"background-color": "rgb(46, 50, 62)"});
            $('.header').css({"background-color": "rgb(78, 85, 106)"});
            $('#hamburger_button').css({"color": "rgb(78, 85, 106)"});
            $('#notification').remove();
        }
    }

    function GoTo(page) {
        $.ajax(
            {
                success: function () {
                    window.location.href = page;
                }
            })
    }

    function GoTo_big_icon(page) {
        var verif = getCookie("cookie_toggle_state") == "1";

        if (verif || <?php echo $_SESSION['role'] ?> == 1) {
            window.location.href = 'vueAdmin.php';
        }
        else {
            window.location.href = page;
        }
    }

    $('#Logout_button').click(function () {
        document.cookie = "cookie_toggle_state=0; expires=Thu, 18 Dec 2013 12:00:00 UTC";
    });

</script>
