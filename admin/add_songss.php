<?php require_once '../includes/session_timeout.php'; ?>
<?php include '../includes/connection.php';

$q = $db->prepare( 'SELECT album_id, album_name FROM table_albums ORDER BY album_name' );
$q->bindParam( ':album_id',   $album_id );
$q->bindParam( ':album_name', $album_name );
$q->execute();

?>
<!DOCTYPE HTML>
<html>
<head>
   <meta charset="utf-8">
   <title><?php echo basename( __FILE__ ); ?></title>
</head>

<body>
<?php include '../includes/menu.php'; ?>
<h1>Add Tracts</h1>

<form method="post">
   Tracks Name:<br>
   <input type="text" name="tracks_name" value="<?php $tracks_name ?>"><br>
   <select  name="album_id" id="album_id">
      <option value"" >Select</option>
      <?php while ( $row = $q->fetch() ) { ?>
         <option value="<?php echo $row->album_id;?>">
            <?php echo $row->album_name; $album_id = $row->album_id;?>
         </option>
      <?php } ?>

   </select>
   <input type="submit" value="Submit now"/>
</form>


<?php include '../includes/logout.php';
// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {
   var_dump( $_POST ) ;
   $stmt = $db->prepare( "INSERT INTO table_tracks ( tracks_name,  tracks_id,  album_id ) 
                          VALUE                    (:tracks_name, :tracks_id, :album_id)" );
   $stmt->bindParam( ':tracks_id',   $tracks_id );
   $stmt->bindParam( ':tracks_name', $tracks_name );
   $stmt->bindParam( ':album_id',    $album_id );

   // insert one row
   $album_id = $_POST["album_id"];
   $tracks_name = $_POST["tracks_name"];
   $stmt->execute();
}
?>
</body>
</html>
