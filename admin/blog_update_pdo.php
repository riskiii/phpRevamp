<?php
require_once 'includes/connection-blog.php';
// initialize flags
$OK   = false;
$done = false;

// create database connection
$conn = dbConnect( 'write', 'pdo' );

// get details of selected record
if ( isset( $_GET['article_id'] ) && ! $_POST ) {

   // prepare SQL query
   $sql  = 'SELECT article_id, title, article FROM blog
            WHERE article_id = ?';

   $stmt = $conn->prepare( $sql );
   // pass the placeholder value to execute() as a single-element array
   $OK = $stmt->execute( [ $_GET['article_id'] ] );

   // bind the results
   $stmt->bindColumn( 1, $article_id );
   $stmt->bindColumn( 2, $title );
   $stmt->bindColumn( 3, $article );
   $stmt->fetch();
}
// if form has been submitted, update record
if ( isset( $_POST['update'] ) ) {

   // prepare update query
   $sql  = 'UPDATE blog SET title = ?, article = ?
            WHERE article_id = ?';
   $stmt = $conn->prepare( $sql );

   // execute query by passing array of variables
   $done = $stmt->execute( [
      $_POST['title'],
      $_POST['article'],
      $_POST['article_id']
   ] );
}

// redirect page on success or if $_GET['article_id'] not defined
if ( $done || ! isset( $_GET['article_id'] ) ) {
   header( 'Location: http://phprevamp.dev/admin/blog_list_pdo.php' );
   exit;
}

// store error message if query fails
if ( isset( $stmt ) && ! $OK && ! $done ) {
   $errorInfo = $stmt->errorInfo();
   if ( isset( $errorInfo[2] ) ) {
      $error = $errorInfo[2];
   }
}

?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
   <div class="one-third">
      <?php include 'includes/menu.php';
      global $album_name; ?>
   </div>

   <h1>Update Blog Entry</h1>

   <div class="two-thirds last">
      <p><a class="more" href="blog_list_pdo.php">List all entries </a></p>
      <?php if ( isset( $error ) ) {
         echo "<p class='warning'>Error: $error</p>";
      }
      if ( $article_id == 0 ) { ?>
         <p class="warning">Invalid request: record does not exist.</p>
      <?php } else { ?>
         <form method="post" action="">
            <div class="form-group">
               <label for="title">Title:</label>
               <input name="title" type="text" id="title" value="<?= htmlentities( $title ); ?>">
            </div>
            <div class="form-group">
               <label for="article">Article:</label>
               <textarea name="article" id="article"><?= htmlentities( $article ); ?></textarea>
            </div>
            <div class="form-group">
               <input type="submit" name="update" value="Update Entry" id="update">
               <input name="article_id" type="hidden" value="<?= $article_id; ?>">
            </div>
         </form>
      <?php } ?>
   </div> <!-- .two-third -->

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>