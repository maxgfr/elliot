$('#list1').click(function () {
  sessionStorage.setItem('name', 'Elliot');
  window.location.href = "vueAdminClient.php";
})

$('#list2').click(function () {
  sessionStorage.setItem('name', 'Albert');
  window.location.href = "vueAdminClient.php";
})
