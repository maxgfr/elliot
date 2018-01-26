var data = {};
console.log(sessionStorage.getItem('name'));
data.head = sessionStorage.getItem('name') ;

$.ajax({
  type: "POST",
  url: "../Modeles/fiche_client.php",
  data: data,
  success: function (result) {
    $('#headerTable').text(result[0]['last_name'] + " " + result[0]['first_name']);
    $('#addressTable').text("Adresse : " + result[0]['address']);
    $('#mailTable').text("Adresse mail : " + result[0]['mail']);
    $('#birthdayTable').text("Date de naissance : " + result[0]['birthday']);
  }
})
