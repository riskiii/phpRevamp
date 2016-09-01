<?php
//include 'includes/title.php';
require_once 'admin/includes/utility_funcs.php';
require_once 'admin/includes/connection-blog.php';
// create database connection
$conn      = dbConnect( 'read', 'pdo' );
$sql       = 'SELECT * FROM blog ORDER BY created DESC';
$result    = $conn->query( $sql );
$errorInfo = $conn->errorInfo();
if ( isset( $errorInfo[2] ) ) {
   $error = $errorInfo[2];
}
?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<main>
<h1>Japan Journey </h1>
<!--<div class="one-third">-->
<!--   --><?php //include 'includes/menu.php'; ?>
<!--</div>-->
<!--<div class="two-thirds last">-->
   <?php if ( isset( $error ) ) {
      echo "<p>$error</p>";
   } else {
      while ( $row = $result->fetch() ) {
         echo "<h2>{$row['title']}</h2>";
         $extract = getFirst( $row['article'] );
         echo "<p>$extract[0]";
         if ( $extract[1] ) {
            echo '<a class="more" href="details_pdo.php?article_id=' .
                 $row['article_id'] . '"> More</a>';
         }
         echo '</p>';
      }
   }
   ?>
</main>
<!--</div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
