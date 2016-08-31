<?php require_once '../includes/session_timeout.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
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

         <form method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="album_name" class="">Album Name</label>
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
            </div>
            <div class="form-group">
               <label for="song_name" class="">Song Name</label>
               <input type="text" name="song_name" value="<?php $song_name ?>"><br>
            </div>
            <div class="form-group">
               <label for="song_length" class="">Song Length</label>
               <input type="text" name="song_length" value="<?php $song_length ?>"><br>
            </div>
            <div class="form-group">
               <!-- https://github.com/blueimp/jQuery-File-Upload-->
               <?php include 'index.php'; ?>
            </div>
            <div class="form-group top-spacing">
               <input type="submit" value="Submit now"/>
            </div>
         </form>


         <?php
         // Only process the form if $_POST isn't empty
         if ( ! empty( $_POST ) ) {
            // var_dump( $_POST );
            $stmt = $db->prepare( "INSERT INTO songs ( album_id,  song_name,  song_length,  song_mp3 ) 
                             VALUE             (:album_id, :song_name, :song_length, :song_mp3 )" );
            $stmt->bindParam( ':album_id', $album_id );
            $stmt->bindParam( ':song_name', $song_name );
            $stmt->bindParam( ':song_length', $song_length );
            $stmt->bindParam( ':song_mp3', $song_mp3 );

            // insert one row
            // http://php.net/manual/en/features.cookies.php
            $album_id    = $_POST["album_id"];
            $song_name   = $_POST["song_name"];
            $song_length = $_POST["song_length"];
            $song_mp3    = $_COOKIE["dgs_cookie"];
            unset( $_COOKIE["dgs_cookie"] );
            $stmt->execute();
         }
         ?>
         <?php include '../includes/logout.php'; ?>
      </div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';


