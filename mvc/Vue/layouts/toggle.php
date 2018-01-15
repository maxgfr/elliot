<link rel="stylesheet" href="../../css/header.css">
<link rel="shortcut icon" href="../../img/smallellIoTICO.ico"/>
<script src="../../js/header.js"></script>
<script src="../../js/jquery-3.2.1.min.js"></script>




<script>

    function getCookie(attribute) {
        var searchedSection = attribute + "=";
        var cookieArray = document.cookie.split(';');
        for(var i = 0; i < cookieArray.length; i++) {
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



    function useTheCookieLuke() 
    {
        if (getCookie("cookie_toggle_state") == "0")
        {
            $('#elementsOfSidebar_Admin').css({"display": "none"});
            $('#elementsOfSidebar_Support').css({"display": "block"});
            $('#elementsOfSidebar_Sensor').css({"display": "block"});
            $('#elementsOfSidebar_Tableau').css({"display": "block"});
            $('#elementsOfSidebar_Accueil').css({"display": "block"});
            $('.sidebarContainer').css({"background-color": "blue"});
        }
        else
        {
            $('#elementsOfSidebar_Admin').css({"display": "block"});
            $('#elementsOfSidebar_Support').css({"display": "none"});
            $('#elementsOfSidebar_Sensor').css({"display": "none"});
            $('#elementsOfSidebar_Tableau').css({"display": "none"});
            $('#elementsOfSidebar_Accueil').css({"display": "none"});
            $('.sidebarContainer').css({"background-color": "purple"});
        }
    }



    useTheCookieLuke();



if (!getCookie("cookie_toggle_state")) {
    switch(<?php echo $_SESSION['role'] ?>)
    {
        case 0:
            document.getElementById("toggle_button").remove();
            $('#elementsOfSidebar_Admin').remove();
            $('#elementsOfSidebar_Support').css({"display": "block"});
            $('#elementsOfSidebar_Sensor').css({"display": "block"});
            $('#elementsOfSidebar_Tableau').css({"display": "block"});
            $('#elementsOfSidebar_Accueil').css({"display": "block"});
            $('.sidebarContainer').css({"background-color": "blue"});
            break;
        case 1:
            document.getElementById("toggle_button").remove();
            $('#elementsOfSidebar_Admin').css({"display": "block"});
            $('#elementsOfSidebar_Support').remove();
            $('#elementsOfSidebar_Sensor').remove();
            $('#elementsOfSidebar_Tableau').remove();
            $('#elementsOfSidebar_Accueil').remove();
            $('.sidebarContainer').css({"background-color": "purple"});
            break;
        case 2:
            document.cookie="cookie_toggle_state=1";
            useTheCookieLuke();
            break;
    }
}


    $(document).ready(function () 
    {
        $("#myonoffswitch").click(function () 
        {
            if ($('#myonoffswitch').is(':checked') == false) 
            {
                document.cookie = "cookie_toggle_state=0";
                useTheCookieLuke();
            }
            else 
            {  
                document.cookie = "cookie_toggle_state=1";
                useTheCookieLuke();
            }
        })
    });



    function GoTo(page) 
    {
        $.ajax(
        {
            success: function () 
            {
                window.location.href = page;
            }
        })
    }
</script>