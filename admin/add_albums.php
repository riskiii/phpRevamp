<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<?php require_once '../includes/session_timeout.php'; ?>
<?php include '../includes/connection.php'; ?>
<?php

$q = $db->prepare( 'SELECT artist_id, `artist_name` FROM artists ORDER BY `artist_name`' );
$q->bindParam( ':artist_id', $artist_id );
$q->bindParam( ':artist_name', $artist_name );
$q->execute();
?>
<div class="one-third">
   <?php include '../includes/menu.php';
   global $album_name; ?>
</div>
<div class="two-thirds last">
   <h1>Add Album</h1>
   <!--   http://www.w3schools.com/php/php_file_upload.asp-->
   <!--   https://github.com/blueimp/jQuery-File-Upload/wiki/Setup-->
   <form method="post" enctype="multipart/form-data">
      <div class="form-group">
         <label for="album_name" class="">Album Artist</label>
         <select>
            <option name="artist_id" id="artist_id">Select</option>
            <?php while ( $row = $q->fetch() ) { ?>
               <option value="<?php echo $row->artist_id;
               $artist_id = $row->artist_id; ?>"><?php echo $row->artist_name; ?></option>
            <?php } ?>
         </select>
      </div>
      <div class="form-group">
         <label for="album_name" class="">Album Name</label>
         <input type="text" name="album_name" value="<?php $album_name; ?>">
      </div>
      <div class="form-group">
         <label for="album_release" class="">Album Release Date</label>
         <input type="date" name="album_release" value="<?php $album_release; ?>">
      </div>
      <div class="form-group">
         <!-- https://github.com/blueimp/jQuery-File-Upload-->
         <?php include 'index.php'; ?>
      </div>
      <div class="form-group">
         <input type="submit" value="Submit now"/>
      </div>
   </form>
   <?php

   // Only process the form if $_POST isn't empty
   if ( ! empty( $_POST ) ) {
      $stmt = $db->prepare( "INSERT INTO albums (album_name, artist_id, album_release, album_image) VALUE (:album_name, :artist_id, :album_release, :album_image)" );
      $stmt->bindParam( ':album_name',    $album_name );
      $stmt->bindParam( ':artist_id',     $artist_id );
      $stmt->bindParam( ':album_release', $album_release );
      $stmt->bindParam( ':album_image',   $album_image );

      // insert one row
      // http://php.net/manual/en/features.cookies.php
      $album_name    = $_POST["album_name"];
      $album_release = $_POST["album_release"];
      $album_image   = $_COOKIE["dgs_cookie"];
      unset($_COOKIE["dgs_cookie"]);
      $stmt->execute();
   }
   ?>
   <?php include '../includes/logout.php'; ?>
</div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>


