<?php include_once '../header.php'; ?>
<?php require_once '../includes/session_timeout.php'; ?>
<?php include '../includes/connection.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
   <meta charset="utf-8">
   <title><?php echo basename( __FILE__ );?></title>
</head>

<body>
<?php include '../includes/menu.php'; ?>
<h1>Discograpy</h1>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
<?php include '../includes/logout.php'; ?>
</body>
</html>

