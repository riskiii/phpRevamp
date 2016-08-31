<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
<?php include 'includes/connection.php'; ?>
<script src="/audioplayerengine/amazingaudioplayer.js"></script>
<link rel="stylesheet" type="text/css" href="/audioplayerengine/initaudioplayer-1.css">
<script src="/audioplayerengine/initaudioplayer-1.js"></script>

<div class="pad-thirty">
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
         <div class="">
            <?php
            $sql  = "SELECT album_name, album_id, album_image 
                       FROM albums ORDER BY album_name";
            $stmt = $db->prepare( $sql );
            $stmt->bindParam( ':album_name', $album_name );
            $stmt->bindParam( ':album_id', $album_id );
            $stmt->bindParam( ':album_image', $album_image );
            $stmt->execute(); ?>
            <div class="panel-heading col-md-6"><?php
               $count = 1;
               while ( $row = $stmt->fetch() ) { ?>
                  <img class="img-responsive img-hover"
                       src=<?php echo 'http://' . $_SERVER['SERVER_NAME'] . '/admin/files/' ."$row->album_image" ?> alt="">

                  <h3><?php echo "$row->album_name" ?></h3>
                  <div class="panel-body">
                     <div class="">
                        <ul><?php
                           //error_reporting(E_ALL);
                           //ini_set('display_errors', 1);
                           $sql3  = "SELECT songs.song_id, songs.song_name, songs.song_length, 
                                            songs.song_mp3, songs.album_id
                              FROM  songs 
                              INNER JOIN albums ON songs.album_id = albums.album_id
                              WHERE songs.album_id = $row->album_id
                              ORDER BY songs.song_name";
                           $stmt3 = $db->prepare( $sql3 );
                           $stmt3->bindParam( ':songs.song_name',      $song_name );
                           $stmt3->bindParam( ':songs.song_length',    $song_length );
                           $stmt3->bindParam( ':songs.song_mp3',       $song_mp3 );
                           $stmt3->bindParam( ':albums.album_release', $album_release );
                           $stmt3->execute();?>
                           <ol>
                           <?php
                           while ( $row3 = $stmt3->fetch() ) { ?>
                              <li>
                                 <span class="song-name">  <?php echo $row3->song_name; ?> </span>
                                 <audio id="player<?php echo $count; ?>" src="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . '/admin/files/' . $row3->song_mp3; ?>"></audio>
                                 <span class="my-buttons"><button onclick=document.getElementById("player<?php echo$count?>").play()>Play</button>
                                                          <button onclick=document.getElementById("player<?php echo$count?>").pause()>Pause</button></span>
                                 <span class="song-length">   Length: </span>  <?php echo $row3->song_length;  ?>
                                 <?php $count++; ?>
                              </li>
                           <?php } ?>
                           </ol>
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
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

