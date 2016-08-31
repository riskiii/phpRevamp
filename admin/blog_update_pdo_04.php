<?php
require_once '../includes/connection-blog.php';
// initialize flags

// create database connection
$conn = dbConnect('write', 'pdo');

$OK = false;
$done = false;
// get details of selected record
echo "danny";
var_dump($_POST);
if (isset($_GET['article_id']) && !$_POST) {
    echo " smith";
    // prepare SQL query
    $sql = 'SELECT article_id, image_id, title, article FROM blog
            WHERE article_id = ?';
    $stmt = $conn->prepare($sql);
    // pass the placeholder value to execute() as a single-element array
    $OK = $stmt->execute([$_GET['article_id']]);
    // bind the results
    $stmt->bindColumn(1, $article_id);
    $stmt->bindColumn(2, $image_id);
    $stmt->bindColumn(3, $title);
    $stmt->bindColumn(4, $article);
    $stmt->fetch();
}
// if form has been submitted, update record
if (isset($_GET['update'])) {
    // prepare update query
    $sql = 'UPDATE blog SET image_id = ?, title = ?, article = ?
            WHERE article_id = ?';
    $stmt = $conn->prepare($sql);
    if (empty($_POST['image_id'])) {
        $stmt->bindValue(1, NULL, PDO::PARAM_NULL);
    } else {
        $stmt->bindParam(1, $_POST['image_id'], PDO::PARAM_INT);
    }
    $stmt->bindParam(2, $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['article'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST['article_id'], PDO::PARAM_INT);
    // execute query
    $done = $stmt->execute();
}

// redirect page on success or if $_GET['article_id'] not defined
if ($done || !isset($_GET['article_id'])) {
    header('Location: http://phprevamp.dev/admin/blog_list_pdo.php');
    exit;
}
// store error message if query fails
if (isset($stmt) && !$OK && !$done) {
    $errorInfo = $stmt->errorInfo();
    if (isset($errorInfo[2])) {
        $error = $errorInfo[2];
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Blog Entry</title>
    <link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Update Blog Entry</h1>
<p><a href="blog_list_pdo.php">List all entries </a></p>
<?php if (isset($error)) {
    echo "<p class='warning'>Error: $error</p>";
}
if($article_id == 0) { ?>
    <p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
    <form method="post" action="">
        <p>
            <label for="title">Title:</label>
            <input name="title" type="text" id="title" value="<?= htmlentities($title); ?>">
        </p>
        <p>
            <label for="article">Article:</label>
            <textarea name="article" id="article"><?= htmlentities($article);?></textarea>
        </p>
        <p>
            <label for="image_id">Uploaded image:</label>
            <select name="image_id" id="image_id">
                <option value="">Select image</option>
                <?php
                // get the list images
                $getImages = 'SELECT image_id, filename
                                FROM images ORDER BY filename';
                foreach ($conn->query($getImages) as $row) {
                    ?>
                    <option value="<?= $row['image_id']; ?>"
                        <?php
                        if ($row['image_id'] == $image_id) {
                            echo 'selected';
                        }
                        ?>><?= $row['filename']; ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <input type="submit" name="update" value="Update Entry" id="update">
            <input name="article_id" type="hidden" value="<?= $article_id; ?>">
        </p>
    </form>
<?php } ?>
</body>
</html>