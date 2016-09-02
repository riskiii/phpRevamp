<?php
if ( isset( $_POST['insert'] ) ) {
   require_once 'includes/connection-blog.php';
   // initialize flag
   $OK = false;
   // create database connection
   $conn  = dbConnect( 'write', 'pdo' );
   $conn2 = dbConnect( 'write', 'pdo' );
   $conn3 = dbConnect( 'read', 'pdo' );
   // create SQL
   $sql2 = 'INSERT INTO images (filename, caption )
                VALUES(:filename, :caption )';

   $stmt2 = $conn2->prepare( $sql2 );
   // bind the parameters and execute the statement
   $stmt2->bindParam( ':filename', $filename );
   $stmt2->bindParam( ':caption',  $caption );

   $filename  = $_COOKIE["dgs_cookie"];
   $caption   = $_POST["caption"];
   unset( $_COOKIE["dgs_cookie"] );

   // execute and get number of affected rows
   $stmt2->execute();

   $lastId = $conn2->lastInsertId();



   // create SQL
   $sql = 'INSERT INTO blog (title, article, image_id )
                VALUES(:title, :article, :image_id )';
   // prepare the statement
   $stmt = $conn->prepare( $sql );
   // bind the parameters and execute the statement
   $stmt->bindParam( ':title', $_POST['title'], PDO::PARAM_STR );
   $stmt->bindParam( ':article', $_POST['article'], PDO::PARAM_STR );
   $stmt->bindParam( ':image_id', $lastId );
   //$stmt->bindParam( ':image_id', $_POST['image_id'], PDO::PARAM_STR );
   // execute and get number of affected rows
   $stmt->execute();
//   $OK = $stmt->rowCount();
   // redirect if successful or display error
//   if ( $OK ) {
//      header( 'Location: http://phprevamp.dev/admin/blog_list_pdo.php' );
//      exit;
//   } else {
//      $errorInfo = $stmt->errorInfo();
//      if ( isset( $errorInfo[2] ) ) {
//         $error = $errorInfo[2];
//      }
//   }
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
      <form method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="title">Title:</label>
            <input name="title" type="text" id="title">
         </div>
         <div class="form-group">
            <label for="filename">Filename:</label>
            <!-- https://github.com/blueimp/jQuery-File-Upload-->
            <?php include 'index.php'; ?>
         </div>
         <div class="form-group">
            <label for="caption">Caption:</label>
            <input name="caption" type="text" id="caption">
         </div>
         <div class="form-group">
            <label for="article">Article:</label>
            <textarea name="article" id="article"></textarea>
         </div>
         <div class="form-group">
            <input type="submit" name="insert" value="Insert New Entry" id="insert">
         </div>
      </form>
   </div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>