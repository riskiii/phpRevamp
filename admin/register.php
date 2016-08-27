<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';?>
<!--   <!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css"><?php

if ( isset( $_POST['register'] ) ) {
   $username = trim( $_POST['username'] );
   $password = trim( $_POST['pwd'] );
   $retyped  = trim( $_POST['conf_pwd'] );
   define( '__ROOT__', dirname( dirname( __FILE__ ) ) );
   $userfile = '/Users/riskiii/Sites/encrypted.csv';
   require_once __ROOT__ . '/includes/register_user_csv.php';
}
?>
<div class="one-third">
   <?php include '../includes/menu.php'; ?>
</div>

<div class="two-thirds last">
   <h1>Register User</h1>
   <?php
   if ( isset( $result ) || isset( $errors ) ) {
      echo '<ul>';
      if ( ! empty( $errors ) ) {
         foreach ( $errors as $item ) {
            echo "<li>$item</li>";
         }
      } else {
         echo "<li>$result</li>";
      }
      echo '</ul>';
   }
   ?>
   <form action="" method="post">
      <p>
         <label for="username">Username:</label>
         <input type="text" name="username" id="username">
      </p>
      <p>
         <label for="pwd">Password:</label>
         <input type="password" name="pwd" id="pwd">
      </p>
      <p>
         <label for="conf_pwd">Retype Password:</label>
         <input type="password" name="conf_pwd" id="conf_pwd">
      </p>
      <p>
         <input type="submit" name="register" value="Register">
      </p>
   </form>
   <?php include '../includes/logout.php'; ?>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>


