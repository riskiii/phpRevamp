<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>

<div class="about">
   <h2> Contact </h2>

   <div class="contact-container">
      <div class="row header">
         <h2 class="cuh2">CONTACT US &nbsp;</h2>
         <h3>Fill out the form below to learn more!</h3>
      </div>
      <div class="row body">
         <form  method="post" action="mail.php">
            <ul>
               <li class="form-group">
                  <p class="left">
                     <label for="first_name" class="contact-label">First Name</label>
                     <input type="text" name="first_name" placeholder="John"/>
                  </p>
                  <p class="pull-right">
                     <label for="last_name" class="contact-label">Last Name</label>
                     <input type="text" name="last_name" placeholder="Smith"/>
                  </p>
               </li>
               <li class="form-group">
                  <p>
                     <label  for="email" class="contact-label">Email <span class="req">*</span></label>
                     <input type="email" name="email" placeholder="john.smith@gmail.com"/>
                  </p>
               </li>
               <li class="form-group">
                  <div class="divider"></div>
               </li>
               <li class="form-group">
                  <label  for="comments" class="contact-label">Comments</label>
                  <textarea cols="46" rows="5" name="comments"></textarea>
               </li>
               <li class="form-group">
                  <label class="contact-label">*What is 2+2? (Anti-spam)</label>
                  <input name="human" placeholder="Type Here">
               </li>
               <li class="form-group">
                  <input id="submit" class="btn btn-submit" name="submit" type="submit" value="Submit">
               </li>
            </ul>
         </form>
      </div>
   </div>

</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

