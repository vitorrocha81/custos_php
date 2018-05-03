<?php include('includes/header.php'); ?>


<?php

//Include functions files and also write a statement to redirect user when logged in 

 
 

?>

 
<?php

//require or include your database connection file

    
//instatiating our database objects
    

    //Collect and process Data on login submission


     
         
           

    
    //making the query using our functions
   

    //To specify the WHERE statement, You need to call the bind method
    

    //Fetching the resultset for a single result and keep in a row variable
    
         

    //Collect the image, id, email, fullname and keep an session
   

            
            //create a session variable and set it to true 
         
            
            
            //Redirect a succuessfull login to customer.php
        
            
            //Use the set_message function to set a welcome msg in a closable div and echo a div danger when login fails in else statement
   

?>
  
  <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class=""><a class="pull-right" href="admin/register_admin.php"> Register</a></p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="post" action="">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="username" class="form-control" id="email" placeholder="Enter Email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10"> 
              <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary text-center" name="submit_login">Login</button>
            </div>
          </div>
        </form>
          
  </div>
</div>
  
  
<?php include('includes/footer.php'); ?>