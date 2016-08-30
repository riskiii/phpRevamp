<!--   <!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">

<div class="container">
   <!-- Button to select & upload files -->
   <span class="btn btn-info fileinput-button one-third">
    <span>Upload File</span>
      <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="files[]" multiple>
  </span>

   <span class="progress-text">
      <!-- The global progress bar -->
      <span class="margin-right">Upload progress</span>
      <!-- The list of files uploaded -->
      <span>File uploaded:</span><br>
      <ul id="files"></ul>
   </span>


   <div id="progress" class="progress progress-info progress-striped">
      <div class="bar"></div>
   </div>

   <!-- Load jQuery and the necessary widget JS files to enable file upload -->
   <!--   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
   <script src="js/jquery.ui.widget.js"></script>
   <script src="js/jquery.iframe-transport.js"></script>
   <script src="js/jquery.fileupload.js"></script>
   <script src="js/js.cookie.js"></script>

   <!-- JavaScript used to call the fileupload widget to upload files -->
   <script>
      // When the server is ready...
      $(function () {
         'use strict';

         // Define the url to send the image data to
         var url = 'files.php';

         // Call the fileupload widget and set some parameters
         $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
               // Add each uploaded file name to the #files list
               $.each(data.result.files, function (index, file) {
                  $('<li/>').text(file.name).appendTo('#files');

                  // https://github.com/js-cookie/js-cookie/tree/v2.1.2#readme
                  Cookies.set('dgs_cookie', decodeURIComponent(file.name), { expires: 7 });

                  $.post('index.php', 'val=' + $.text(file.name), function (response) {
                     alert(response);
                  });
               });
            },
            progressall: function (e, data) {
               // Update the progress bar while files are being uploaded
               var progress = parseInt(data.loaded / data.total * 100, 10);
               $('#progress .bar').css(
                  'width',
                  progress + '%'
               );
            }
         });
      });
   </script>
</div>