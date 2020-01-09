<?php 

session_start();


if(array_key_exists("logout",$_GET)){
  
   $link =  mysqli_connect("shareddb-r.hosting.stackcp.net","chatUsers-313233295f","chatUsers2019","chatUsers-313233295f"); 
        if( mysqli_connect_error()){

                                 die("there was an error connecting to the database!");
                              } 
  
        

         unset($_SESSION['id']);
         unset($_COOKIE['id']);
         setcookie("id","",time()-60*60);
          $_COOKIE['id'] = "";
         
   } else if(array_key_exists("id",$_SESSION) OR array_key_exists("id",$_COOKIE)){
 
             header("Location:loggedin.php");
      }

  if( array_key_exists('submit',$_POST) ){

  $link =  mysqli_connect("shareddb-r.hosting.stackcp.net","chatUsers-313233295f","chatUsers2019","chatUsers-313233295f"); 
        if( mysqli_connect_error()){

                                 die("there was an error connecting to the database!");
                              } 

        $error = ""; 
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $cookies = $_POST['cookieEnabler'];
    
 if($_POST['formType'] == 'signUp'){
              if(!$email){

                $error.="email required!<br>";
              }

              if(!$password){

                $error.="password required!<br>";
              }
              if(!$username){

                $error.="username required!<br>";
              }

              if(!$gender){

                $error.="gender required!<br>";
              }
 } else if($_POST['formType'] == 'signIn'){
          if(!$password){

                $error.="password required!<br>";
              }
              if(!$username){

                $error.="username required!<br>";
              }
 } else if($_POST['formType'] == 'reset'){

			  if(!$email){

							$error.="email required!<br>";
						  }
}
    

              if($error != ""){
                $error ="<p>there where errors in your form!</p>".$error;                
              } else {
                  if($_POST['formType'] == 'signUp'){
                      $query = "SELECT `id` FROM `chat_users` WHERE email = '"
                        .mysqli_real_escape_string($link, $email)."'OR   username='"
                        .mysqli_real_escape_string($link,$username)."' ";
                
                       $result = mysqli_query($link,$query);
                    

                              if(mysqli_num_rows($result) > 0){
                              
                                 $error.="already exists!<br>";
                              } else{
                              
                                    $insertQuery = "INSERT INTO `chat_users` (`username`,`email`,`password`,`gender`) VALUES (
                                          '".mysqli_real_escape_string($link,$username).
                                          "','".mysqli_real_escape_string($link,$email).
                                          "','".mysqli_real_escape_string($link,$password).
                                          "','".$gender."')";
                                
                                             if(! mysqli_query($link,$insertQuery) ){
                                               
                                         $error.="<p>there was a problem signing you up!,please try again later</p>";
                                               
                                             } else {
                                               
                                                $updateQuery ="UPDATE `chat_users` SET password='".md5(md5(mysqli_insert_id($link)).$password ).
																   "'WHERE id=".mysqli_insert_id($link)." LIMIT 1";
                                               
                                                                        mysqli_query($link,$updateQuery);
                                               
                                                                          $selectLastUserQuery = "SELECT `id` FROM `chat_users` WHERE username = '".mysqli_real_escape_string($link, $username)."'";
                                                                          
                                                                          $lastInsertedResult = mysqli_query($link,$selectLastUserQuery);
                                               
                                                                          $lastEntered = mysqli_fetch_array($lastInsertedResult);

                                                
                                                                      $_SESSION['id'] = $lastEntered['id'];
                                               
                                                                     if( $cookies == '1'){
                                                                       																			 																														setcookie("id",$lastEntered['id'],time()+60*60 * 1);
                                                                     }

                                             					 header("Location:loggedin.php");
                                              }
                                  
                              }
                   } else if($_POST['formType'] == 'signIn'){

                              $usernameFromDataBase = mysqli_real_escape_string($link,$username);
                              $selectQuery = "SELECT `password` FROM chat_users WHERE username='".$usernameFromDataBase."'";
                              $selectIdQuery = "SELECT `id` FROM chat_users WHERE username='".$usernameFromDataBase."'";
                    
                                $selectResult = mysqli_query($link, $selectQuery);//here executes the query
                                                             $row =  mysqli_fetch_array($selectResult);
                                 
                                       if( !array_key_exists('password',$row) ){
                                             $error.="<p>no username found!</p>";
                                       } else {
                                              $selectIdResult = mysqli_query($link,$selectIdQuery);
                                              $idRow = mysqli_fetch_array($selectIdResult);
                                         
                                                if( $row['password'] == md5(md5($idRow['id']).$password) ){
                                                                          
                                                                         	 $_SESSION['id'] = $idRow['id'];
 
                                                                                if($_POST['cookieEnabler'] == '1'){ 
																			         setcookie("id",$idRow['id'],time()+60*60 * 1);
																		          }
                                             						  header("Location:loggedin.php");
                                                                        } else {
                                                                                $error.="<p>password incorect!</p>";
                                                                        }

                                                             }


                         }   else  if($_POST['formType'] == 'reset'){
                                  
							$emailFromDataBase = mysqli_real_escape_string($link,$email);
                              $selectQuery = "SELECT `id` FROM chat_users WHERE email='".$emailFromDataBase."'";
                                  
                                    $row = mysqli_fetch_array( mysqli_query($link,$selectQuery));   
                                     
                                    if(! array_key_exists('id',$row) ){
                                      $error.="no email found!";
                                    } else {
                                            $password = rand(999, 99999);
                                            $password_hash = md5($password);

                                              $mailTo = $email;
                                              $subject = "Your Recovered Password"; 
                                              $message = "Please use this password to login " . $password;
                                              $headers = "From: chatApp@domain.com";

                                            if(mail($mailTo,$subject,$message,$headers)){
                                         
                                                    //checking if the code is corect...if so then looggind the user in!:
                                              
                                                     $_SESSION['resetCode'] = $password_hash ;
                                                     $_SESSION['sent_id'] = $row['id'] ;
                                              
                                                      header("Location:passwordreset.php");
                                                        
                                                }  else {

                                                    $error = "<div class='alert alert-danger' role='alert'>
                                                      the email could not be sent!         
                                                      </div>";

                                                     }      
                                                         
                                    }
                    
                                   }
                             
                   }
              }
        



?>
<?php include("header.php");?>


<div class="container">
   <div class="message-box"><?  if($error!=""){echo "<div class='alert alert-danger' role='alert'>".$error."</div>";}?> </div>
	<div class="d-flex justify-content-center h-100">

		<div class="card" id="signIn">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex social_icon">
					 <span><i class="fab fa-facebook-square"></i></span>
                     <span><i class="fab fa-instagram"></i> </span>
					 <span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="username">
						
					</div>
                    
                     <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password">

					</div>
	                <div class="row align-items-center remember">
						<input type="checkbox" name="cookieEnabler" value="1">Remember Me
					</div>
    <input type="hidden" value="signIn" name="formType">
                  
					<div class="form-group">
						<input type="submit" name="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
             </div>
            <div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up!</a>
				</div>
				<div class="d-flex justify-content-center" id="passwordLink">
					<a href="#" class="link">Forgot your password?</a>
				</div>
			</div>
    </div>
      
      <div class="card hidden" id="passwordrecovery">
			<div class="card-header">
				<h3>Password recovery</h3>
				<div class="d-flex social_icon">
					 <span><i class="fab fa-facebook-square"></i></span>
                     <span><i class="fab fa-instagram"></i> </span>
					 <span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
             <p>enter your registered e-mail so we can send you verification code</p>
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="e-mail" name="email">
						
					   </div>
                  
                    
                    
    <input type="hidden" value="reset" name="formType">
                  

					<div class="form-group">
						<input type="submit" name="submit" value="send" class="btn float-right login_btn">
					</div>
				</form>
             </div>
            <div class="card-footer">
				<div class="d-flex justify-content-center " id="backToLogIn">
					back to <a href="#">Log in!</a>
				</div>
				
			</div>
    </div>

     <div class="card hidden" id="signUp">
			<div class="card-header">
				<h3>Sign Up</h3>
				<div class="d-flex social_icon">
					 <span><i class="fab fa-facebook-square"></i></span>
                     <span><i class="fab fa-instagram"></i> </span>
					 <span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="username">
						
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="e-mail"  name="email">
						
					</div>
                    
                     <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password">
						
					</div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
       <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                </div>
                <select class="custom-select"  name="gender">
                    <option value="" selected disabled>Please select your gender</option>
                  <option value="male">male</option>
                  <option value="female">female</option>
           
                </select>
              </div>
              <div class="row align-items-center remember">
						<input type="checkbox" name="cookieEnabler" value="1">Remember Me
					</div>

    <input type="hidden" value="signUp" name="formType">

					<div class="form-group">
						<input type="submit" name="submit" value="Sign Up" class="btn float-right login_btn">
					</div>

				</form>
             </div>
            <div class="card-footer">
				<div class="d-flex justify-content-center links">
					already have an account?<a href="#">Sign In!</a>
				</div>
				
			</div>
</div>
</div>
</div>


 

<?php include("footer.php");?>