<?php include_once '../header.php'; ?>
<?php require_once '../includes/session_timeout.php'; ?>
<?php include '../includes/connection.php'; ?>
<?php
   $q = $db->prepare('SELECT artist_id, `artist_name` FROM artists ORDER BY `artist_name`');
   $q->bindParam(':artist_id',    $artist_id);
   $q->bindParam(':artists_name', $artist_name);
   $q->execute();
?>

<?php include '../includes/menu.php'; global $album_name;?>

<h1>Add Album</h1>
<form method="post">
   Album Name:<br>
   <input type="text" name="album_name" value="<?php $album_name; ?>"><br>
   Album Image:<br>
   <input type="date" name="album_releae" value="<?php $album_release; ?>"><br>
   Album Image:<br>
   <input type="text" name="album_image" value="<?php $album_image; ?>"><br>

   <select>
      <option name="artist_id" id="artist_id">Select</option>
      <?php while ($row = $q->fetch()) { ?>
         <option  value="<?php echo $row->artist_id;$artist_id = $row->artist_id; ?>"><?php echo $row->artists_name; ?></option>
      <?php } ?>
   </select>

   <input type="submit" value="Submit now" />
</form>
<?php include '../includes/logout.php';

// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {
   $stmt = $db->prepare("INSERT INTO albums (album_name, artist_id, album_release, album_image) VALUE (:album_name, :artist_id, :album_release, :album_image)");
   $stmt->bindParam(':album_name',    $album_name);
   $stmt->bindParam(':artist_id',     $artist_id);
   $stmt->bindParam(':album_release', $album_release);
   $stmt->bindParam(':album_image',   $album_image);

   // insert one row
   $album_name    = $_POST["album_name"];
   $album_release = $_POST["album_release"];
   $album_image   = $_POST["album_image"];
   $stmt->execute();
}
?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</body>
</html>

