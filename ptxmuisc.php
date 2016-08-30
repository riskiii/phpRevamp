<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
   <meta name="viewport" content="width=device-width">
   <title>Amazing HTML5 Audio Player, powered by http://amazingaudioplayer.com</title>

   <!-- Insert to your webpage before the </head> -->
   <script src="audioplayerengine/jquery.js"></script>
   <script src="audioplayerengine/amazingaudioplayer.js"></script>
   <link rel="stylesheet" type="text/css" href="audioplayerengine/initaudioplayer-1.css">
   <script src="audioplayerengine/initaudioplayer-1.js"></script>
   <!-- End of head section HTML codes -->

</head>
<body>
<div style="margin:12px auto;">

   <!-- Insert to your webpage where you want to display the audio player -->
   <div id="amazingaudioplayer-1" style="display:block;position:relative;width:300px;height:auto;margin:0px auto 0px;">
      <ul class="amazingaudioplayer-audios" style="display:none;">
         <li data-artist="Pentatonix" data-title="Cheerleader" data-album="" data-info=""
             data-image="audios/Unknown-2.jpeg" data-duration="244">
            <div class="amazingaudioplayer-source" data-data-src="audios/ptxcheer.mp3" data-type="audio/mpeg"/>
         </li>
      </ul>
      <div class="amazingaudioplayer-engine"><a href="http://amazingaudioplayer.com" title="jquery audio player">jquery
         mp3 player</a></div>
   </div>
   <!-- End of body section HTML codes -->

</div>
</body>
</html>