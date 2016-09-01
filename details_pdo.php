<?php
require_once 'admin/includes/utility_funcs.php';
require_once 'includes/connection-blog.php';

// connect to the database
$conn = dbConnect( 'read', 'pdo' );

// check for article_id in query string
if ( isset( $_GET['article_id'] ) && is_numeric( $_GET['article_id'] ) ) {
   $article_id = (int) $_GET['article_id'];
} else {
   $article_id = 0;
}

$sql = "SELECT title, article, DATE_FORMAT(updated, '%W, %M %D, %Y') AS updated, filename, caption
        FROM blog LEFT JOIN images USING (image_id)
        WHERE blog.article_id = $article_id";

$result = $conn->prepare( $sql );
$result->execute();
$row = $result->fetch( PDO::FETCH_ASSOC );

?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
   <h1>Japan Journey </h1>
<!--   <div class="one-third">-->
<!--      --><?php //include '../includes/menu.php';
//      global $album_name; ?>
<!--   </div>-->
<!--   <div class="two-thirds last">-->
      <h2><?php if ( $row ) {
            echo $row['title'];
         } else {
            echo 'No record found';
         }
         ?>
      </h2>
      <p><?php if ( $row ) {
            echo $row['updated'];
         } ?></p>
      <?php
      if ( $row && ! empty( $row['filename'] ) ) {
         $filename  = "admin/images/{$row['filename']}";
         $imageSize = getimagesize( $filename )[3];
         ?>
         <figure>
            <img src="<?= $filename; ?>" alt="<?= $row['caption']; ?>" <?= $imageSize; ?>>
         </figure>
      <?php }
      if ( $row ) {
         echo convertToParas( $row['article'] );
      } ?>
      <p><a class="more" href="
          <?php
         // check that browser supports $_SERVER variables
         if ( isset( $_SERVER['HTTP_REFERER'] ) && isset( $_SERVER['HTTP_HOST'] ) ) {
            $url = parse_url( $_SERVER['HTTP_REFERER'] );
            // find if visitor was referred from a different domain
            if ( $url['host'] == $_SERVER['HTTP_HOST'] ) {
               // if same domain, use referring URL
               echo $_SERVER['HTTP_REFERER'];
            }
         } else {
            // otherwise, send to main page
            echo 'blog_pdo.php';
         } ?>">Back to the blog</a></p>
<!--   </div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>