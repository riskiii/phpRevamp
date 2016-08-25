<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>

<div class="about">
   <h2> Contact </h2>

   <div class="container">
      <div class="row header">
         <h2 class="cuh2">CONTACT US &nbsp;</h2>
         <h3>Fill out the form below to learn more!</h3>
      </div>
      <div class="row body">
         <form action="#">
            <ul>

               <li>
                  <p class="left">
                     <label>first name</label>
                     <input type="text" name="first_name" placeholder="John"/>
                  </p>
                  <p class="pull-right">
                     <label>last name</label>
                     <input type="text" name="last_name" placeholder="Smith"/>
                  </p>
               </li>

               <li>
                  <p>
                     <label>email <span class="req">*</span></label>
                     <input type="email" name="email" placeholder="john.smith@gmail.com"/>
                  </p>
               </li>
               <li>
                  <div class="divider"></div>
               </li>
               <li>
                  <label>comments</label>
                  <textarea cols="46" rows="3" name="comments"></textarea>
               </li>

               <li>
                  <input class="btn btn-submit" type="submit" value="Send"/>

               </li>

            </ul>
         </form>
      </div>
   </div>

</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

