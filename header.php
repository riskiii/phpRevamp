<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title><?php echo ucfirst( basename( $_SERVER['PHP_SELF'], ".php" ) . PHP_EOL ); ?></title>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <!--   <!-- Bootstrap CSS Toolkit styles -->
   <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
   <link rel="stylesheet" href="/admin/css/styles.css">

   <link rel="stylesheet" type="text/css" href="/style.css">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<div class="site-container">
<header class="site-header">
   <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
   ?>

<div class="header-container wrap">

      <div id="amazingaudioplayer-1"
           style="display:block;position:relative;width:300px;height:auto;margin:0px auto 0px;">
         <ul class="amazingaudioplayer-audios" style="display:none;">
            <li data-artist="Pentatonix" data-title="Cheerleader" data-album="" data-info=""
                data-image="audios/Unknown-2.jpeg" data-duration="244"></li>
               <div class="amazingaudioplayer-source" data-src="/audios/ptxcheer.mp3" data-type="audio/mpeg"></div>
         </ul>
         <div class="amazingaudioplayer-engine"><a href="http://amazingaudioplayer.com" title="jquery audio player">jquery
               mp3 player</a>
         </div>
      </div>

      <h1 class="title-area"><span class="pe">PE</span><span class="nt">NT</span><span class="at">AT</span><span
            class="on">ON</span><span
            class="ix">IX</span>
      </h1>

      <div class="nav nav-header">
         <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="/bio.php">Bio</a></li>
            <li><a href="/discography.php">Albums</a></li>
            <li><a href="/video.php">Video</a></li>
            <li><a href="/ct.php">Contact</a></li>
            <li><a href="/blog_pdo.php">Blog</a></li>
            <li><a href="/login.php">Login</a></li>
         </ul>
      </div>
   </div>
</header>

<div class="site-inner">
   <div class="bg wrap">