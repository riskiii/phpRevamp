<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<?php //require_once '/includes/session_timeout.php'; ?>
<?php include 'includes/connection.php'; ?>


   <!-- Page Heading -->
   <div class="row">
      <div class="col-lg-12">
         <h1 class="page-header">Discography</h1>
      </div>
   </div>
   <!-- /.row -->

   <!-- Heading -->
   <div class="row">
      <div class="col-lg-12">
         <h2 class="page-header">Albums</h2>
      </div>
   </div>
   <!-- /.row -->


   <!-- Projects Row -->
   <div class="row">
      <div class="col-md-6 img-portfolio">
         <div class="panel panel-default">
            <?php
            $sql  = "SELECT album_name, album_id, album_image 
                       FROM albums ORDER BY album_name";
            $stmt = $db->prepare( $sql );
            $stmt->bindParam( ':album_name', $album_name );
            $stmt->bindParam( ':album_id', $album_id );
            $stmt->bindParam( ':album_image', $album_image );
            $stmt->execute(); ?>
            <div class="panel-heading"><?php
               while ( $row = $stmt->fetch() ) { ?>
                  <img class="img-responsive img-hover"
                       src=<?php echo 'http://' . $_SERVER['SERVER_NAME'] . '/admin/files/' ."$row->album_image" ?> alt="">

                  <h3><?php echo "$row->album_name" ?></h3>
                  <div class="panel-body">
                     <div class="col-xs-8 col-sm-6">
                        <ul><?php
                           $sql3  = "SELECT songs.song_id, songs.song_name,
                                        songs.album_id
                              FROM  songs 
                              INNER JOIN albums ON songs.album_id = albums.album_id
                              WHERE songs.album_id = $row->album_id
                              ORDER BY songs.song_name";
                           $stmt3 = $db->prepare( $sql3 );
                           $stmt3->bindParam( ':songs.song_name',     $song_name );
                           $stmt3->bindParam( ':albums.album_release', $album_release );
                           $stmt3->execute();
                           while ( $row3 = $stmt3->fetch() ) { ?>
                              <li>
                                 <?php echo
                                    '<span class="">' .$row3->song_name .'</span> ' .
                                    '<span class="">' .$album_release .'</span> ';
                                 ?>
                              </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
            </div>
         <?php } ?>
         </div> <!-- .panel .panel-default -->
      </div> <!-- .col-md-6 .img-portfolio -->
   </div>

   <!-- /.row -->


<?php include 'includes/logout.php'; ?>
</div> <!-- .two-third -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

