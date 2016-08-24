<?php include_once '../header.php'; ?>
<?php require_once '../includes/session_timeout.php'; ?>
<?php include '../includes/connection.php';
// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {
   $stmt = $db->prepare("INSERT INTO artists (artists_name) VALUE (:artists_name)");
   $stmt->bindParam(':artists_name', $artists_name);

   // insert one row
   $artists_name = $_POST["artists_name"];
   $stmt->execute();
}
?>
<!DOCTYPE HTML>
<html>
<head>
   <meta charset="utf-8">
   <title><?php echo basename( __FILE__ );?></title>
</head>

<body>
<?php include '../includes/menu.php'; ?>
<h1>Add Artists</h1>

<form method="post">
   artists name:<br>
   <input type="text" name="artists_name" value="<?php $artists_name?>"><br>
   <input type="submit" value="Submit now" />
</form>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
<?php include '../includes/logout.php'; ?>
</body>
</html>

