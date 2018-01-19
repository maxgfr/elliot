<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!-- 
  This view displays the error default page if the user failed to 
  use any service.
-->
<!-- //////////////////////////////////////////////////////////// -->



<?php
echo "<h3 style='color:black;'>Une erreur s'est produite </h3>" ;
foreach ($model->getError()  as $error) {
	echo "<p style='color:red;'>".$error."</p>";
}
?>
