function fiche_client (name) {
  console.log(name);
  sessionStorage.setItem('name', name);
  window.location.href = "vueAdminClient.php";
}
