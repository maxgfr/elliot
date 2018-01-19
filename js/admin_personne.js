/**** AJAX AND JS ****/
$('#search').click(function () {
  $('#test').remove();
    var data = {};
    data.titre = $('#type').val();
    data.message = $('#input_search').val();
    $.ajax({
        type: "POST",
        url: "../Modeles/Admin.php",
        data: {'data': data},
        success: function (result) {

            for (var i = 0; i < result.length; i++) {
                var tr = document.createElement('tr');
                tr.className = "inner";
                tr.id = "tr_" + i.toString();
                var Jquery_tr = "#" + tr.id;

                var td_name = document.createElement('td');
                td_name.id = "td_name" + i.toString();
                $('#table_result').append(tr);
                $(Jquery_tr).append(td_name);
                td_name.innerText = result[i]['last_name'];

                var td_firstname = document.createElement('td');
                td_firstname.id = "td_firstname" + i.toString();
                $(Jquery_tr).append(td_firstname);
                td_firstname.innerText = result[i]['first_name'];

                var td_role = document.createElement('td');
                td_role.id = "td_role" + i.toString();
                var Jquery_td_role = '#' + td_role.id;
                $(Jquery_tr).append(td_role);

                var form = document.createElement('FORM');
                form.id = "form_" + i.toString();
                form.method = "POST";
                $(Jquery_td_role).append(form);

                var select = document.createElement('select');
                select.id = "select_" + i.toString();
                $('#' + form.id).append(select);

                var choix_0 = document.createElement('option');
                choix_0.value = "0";
                choix_0.text = "0 - Client";
                $('#' + select.id).append(choix_0);
                var choix_1 = document.createElement('option');
                choix_1.value = "1";
                choix_1.text = "1 - Admin";
                $('#' + select.id).append(choix_1);
                var choix_2 = document.createElement('option');
                choix_2.value = "2";
                choix_2.text = "2 - Client/Admin";
                $('#' + select.id).append(choix_2);

                $('#' + select.id).val(result[i]['roles']);

                var td_mail = document.createElement('td');
                td_mail.id = "td_mail" + i.toString();
                $(Jquery_tr).append(td_mail);
                td_mail.innerText = result[i]['mail'];
            }
              $('.inner').wrapAll("<tbody id='test'/>");
        },
        error: function (err) {
            console.log(err);
        }
    })
});
/**** AJAX AND JS ****/

$('#send_button').click(function () {
  for (i=1; i <table_result.rows.length; i++ )
  {
    var data = {};
    data.name = table_result.rows[i].cells[0].innerText;
    data.role = $('#select_'+ (i - 1).toString()).val();

    if (data.name != '<?php echo $_SESSION['nom'] ;?>' )
    {
      $.ajax({
        type: "POST",
        url: "../Modeles/Admin_change.php",
        data: data,
        success: function (result) {
          alert("You changed : " + data.name + " to " + data.role);
        },
        error: function (err) {
          console.log(err);
        }
      });
    }
    else {
      alert("You can not change your own permission");
    }
  }
});
