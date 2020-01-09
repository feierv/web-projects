<?php
 session_start();

                  $resetCode = $_SESSION['resetCode'];
                   $insertedCode = $_POST['code'];
                         $userId = $_SESSION['sent_id'];
   
 if( array_key_exists("resetCode",$_SESSION)){
        
       if( array_key_exists('submit',$_POST) ){      
                               $error = "";
   
                   $resetCode = $_SESSION['resetCode'];
                   $insertedCode =md5($insertedCode);
                  

                      if($resetCode == $insertedCode){
                        
						  unset($_SESSION['resetCode']);
                          
                           $_SESSION['id'] = $userId;
                          
                           header("Location:loggedin.php");
                            
                           unset($_SESSION['resetCode']);
                        
                         } else {
      
                           $error .= "<p>incorrect code!</p>";
               }
 }
        
      } else {
      
          header("Location:index.php");
              unset($_SESSION['resetCode']);
      }


 
   

include("header.php");
?>
<div class="container">
   <div class="message-box"><? if($error!=""){echo "<div class='alert alert-danger' role='alert'>".$error."</div>";}?> </div>
	<div class="d-flex justify-content-center h-100">
      
<div class="card " >
			<div class="card-header">
				<h3>Password recovery</h3>
				<div class="d-flex social_icon">
					 <span><i class="fab fa-facebook-square"></i></span>
                     <span><i class="fab fa-instagram"></i> </span>
					 <span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
             <p>enter your code sent via e-mail!</p>
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user-secret"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="ex:45xxx1" name="code">
						
					   </div>
                  
                    
                    
    <input type="hidden" value="2" name="signUp">
                  

					<div class="form-group">
						<input type="submit" name="submit" value="send" class="btn float-right login_btn">
					</div>
				</form>
             </div>
            <div class="card-footer">
				<div class="d-flex justify-content-center " id="backToLogIn">
					back to <a href="index.php">Log in!</a>
				</div>
				
			</div>
    </div>
</div>
  </div>


<?php
include("footer.php");


?>