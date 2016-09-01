<?php
if ( isset( $_POST['insert'] ) ) {
   require_once 'includes/connection-blog.php';
   // initialize flag
   $OK = false;
   // create database connection
   $conn = dbConnect( 'write', 'pdo' );
   // create SQL
   $sql = 'INSERT INTO blog (title, article)
                VALUES(:title, :article)';
   // prepare the statement
   $stmt = $conn->prepare( $sql );
   // bind the parameters and execute the statement
   $stmt->bindParam( ':title', $_POST['title'], PDO::PARAM_STR );
   $stmt->bindParam( ':article', $_POST['article'], PDO::PARAM_STR );
   // execute and get number of affected rows
   $stmt->execute();
   $OK = $stmt->rowCount();
   // redirect if successful or display error
   if ( $OK ) {
      header( 'Location: http://phprevamp.dev/admin/blog_list_pdo.php' );
      exit;
   } else {
      $errorInfo = $stmt->errorInfo();
      if ( isset( $errorInfo[2] ) ) {
         $error = $errorInfo[2];
      }
   }
}

?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
   <div class="one-third">
      <?php include 'includes/menu.php';
      global $album_name; ?>
   </div>
   <h1>Insert New Blog Entry</h1>
   <div class="two-thirds last">
      <?php if ( isset( $error ) ) {
         echo "<p>Error: $error</p>";
      } ?>
      <form method="post" action="">
         <p>
            <label for="title">Title:</label>
            <input name="title" type="text" id="title">
         </p>
         <p>
            <label for="article">Article:</label>
            <textarea name="article" id="article"></textarea>
         </p>
         <p>
            <input type="submit" name="insert" value="Insert New Entry" id="insert">
         </p>
      </form>
   </div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>