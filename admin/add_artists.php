<?php require_once '../includes/session_timeout.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<?php include '../includes/connection.php'; ?>
<!--   <!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css"><?php
// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {
   $stmt = $db->prepare( "INSERT INTO artists (artist_name) VALUE (:artist_name)" );
   $stmt->bindParam( ':artist_name', $artist_name );

   // insert one row
   $artist_name = $_POST["artist_name"];
   $stmt->execute();
}
?>
   <div class="one-third">
      <?php include 'includes/menu.php'; ?>
   </div>

   <div class="two-thirds last">
      <h1>Add Artists</h1>

      <form method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="artist_name" class="">Artist Name</label>
            <input type="text" name="artist_name" value="<?php $artist_name ?>">
         </div>
         <div class="form-group">
            <input type="submit" value="Submit now"/>
         </div>
      </form>

      <?php include '../includes/logout.php'; ?>
   </div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

