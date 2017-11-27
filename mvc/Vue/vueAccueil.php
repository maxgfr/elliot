<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/animation.js"></script>
    <title>Test for the header</title>
  </head>

  <?php include ('layouts/header.php'); ?>

  <?php include ('layouts/iconBar.php'); ?>

  <body>

	<?php include ('layouts/sidebar.php'); ?>

      <div id="main">
<<<<<<< HEAD

        <h2>Create an Account</h2>
        <form id="RegisterUserForm" method="post">
          <label for="last_name">Nom de famille</label>
          <input class="text" id="last_name" type="text" name="last_name" value="" />
          <label for="first_name">Prénom</label>
          <input class="text" id="first_name" type="text" name="first_name" value="" />
          <label for="phone_number">Téléphone</label>
          <input class="text" id="phone_number" type="tel" name="phone_number" value="" />
          <label for="birthday">Jour de naissance</label>
          <input class="text" id="birthday" type="text" name="birthday" value="" />
          <label for="mail">Email</label>
          <input class="text" id="mail" type="email" name="mail" value="" />
          <label for="password">Password</label>
          <input class="text" id="password" type="password" name="password" />
          <button id="registerNew" type="submit">Register</button>
        </form>
=======
          <img style="width:95%;" src="../../img/internet_of_things.png" alt="Dashboard example">
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
>>>>>>> 9788f8b9d5703cb62423d4914cb684cae1ba1def
      </div>


      <?php
          if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone_number']) && isset($_POST['birthday']) && isset($_POST['mail']) && isset($_POST['password']) ) {
              $ctrl = new ControleurVisitor('inscription');
          }
      ?>

  </body>

</html>
