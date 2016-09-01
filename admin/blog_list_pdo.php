<?php
require_once 'includes/connection-blog.php';
// create database connection
$conn = dbConnect('read', 'pdo');
$sql = 'SELECT article_id, title,
        DATE_FORMAT(created, "%a, %b %D, %Y") AS date_created
        FROM blog ORDER BY created DESC';
$result = $conn->query($sql);
$errorInfo = $conn->errorInfo();
if (isset($errorInfo[2])) {
    $error = $errorInfo[2];
}
?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<div class="one-third">
    <?php include 'includes/menu.php';
    global $album_name; ?>
</div>
<h1>Manage Blog Entries</h1>
<div class="two-thirds last">
<p><a class="more" href="blog_insert_pdo.php">Insert new entry</a></p>
<?php if (isset($error)) {
    echo "<p>$error</p>";
} else { ?>
<table>
    <tr>
        <th>Created</th>
        <th>Title</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <?php while($row = $result->fetch()) { ?>
    <tr>
        <td><?= $row['date_created']; ?></td>
        <td><?= $row['title']; ?></td>
        <td><a class="more" href="blog_update_pdo.php?article_id=<?= $row['article_id']; ?>">EDIT</a></td>
        <td><a class="more" href="blog_delete_pdo.php?article_id=<?= $row['article_id']; ?>">DELETE</a></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>