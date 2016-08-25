<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<?php require_once '../includes/session_timeout.php'; ?>
<?php include '../includes/connection.php';

$q = $db->prepare( 'SELECT album_id, album_name FROM albums ORDER BY album_name' );
$q->bindParam( ':album_id', $album_id );
$q->bindParam( ':album_name', $album_name );
$q->execute();
?>

<div class="one-third">
   <?php include '../includes/menu.php'; ?>
</div>

<div class="two-thirds last">
   <h1>Add Songs</h1>

   <form method="post">
      Tracks Name:<br>
      <input type="text" name="song_name" value="<?php $song_name ?>"><br>
      <input type="time" name="song_length" value="<?php $song_length ?>"><br>
      <input type="file" name="song_mp3" id="song_mp3"><br>
      <select name="album_id" id="album_id">
         <option value
         "" >Select</option>
         <?php while ( $row = $q->fetch() ) { ?>
            <option value="<?php echo $row->album_id; ?>">
               <?php echo $row->album_name;
               $album_id = $row->album_id; ?>
            </option>
         <?php } ?>

      </select>
      <input type="submit" value="Submit now"/>
   </form>


   <?php
   // Only process the form if $_POST isn't empty
   if ( ! empty( $_POST ) ) {
      var_dump( $_POST );
      $stmt = $db->prepare( "INSERT INTO songs ( song_name,  song_id,  album_id ) 
                          VALUE             (:song_name, :song_id, :album_id)" );
      $stmt->bindParam( ':song_id', $song_id );
      $stmt->bindParam( ':song_name', $song_name );
      $stmt->bindParam( ':song_length', $song_length );
      $stmt->bindParam( ':song_mp3', $song_mp3 );
      $stmt->bindParam( ':album_id', $album_id );

      // insert one row
      $album_id  = $_POST["album_id"];
      $song_name = $_POST["song_name"];
      $stmt->execute();
   }
   ?>
   <?php include '../includes/logout.php'; ?>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>


