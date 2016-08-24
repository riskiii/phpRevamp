<?php include_once include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<?php
$error = '';
if ( isset( $_POST['login'] ) ) {
   session_start();
   $username = trim( $_POST['username'] );
   $password = trim( $_POST['pwd'] );
   // location of usernames and passwords
   $userlist = '/Users/dsmith/Sites/encrypted.csv';
   // location to redirect on success
   $redirect = 'admin/menu.php';
   require_once 'includes/authenticate.php';
}
?>
<div class="bg">

   <div class="about">

      <h2> Login </h2>

<?php
if ( $error ) {
   echo "<p>$error</p>";
} elseif ( isset( $_GET['expired'] ) ) { ?>
   <p>Your session has expired. Please log in again.</p>
<?php } ?>
<form method="post" action="">
   <p>
      <label for="username">Username:</label>
      <input type="text" name="username" id="username">
   </p>
   <p>
      <label for="pwd">Password:</label>
      <input type="password" name="pwd" id="pwd">
   </p>
   <p>
      <input name="login" type="submit" value="Log in">
   </p>
</form>

</div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</body>
</html>


