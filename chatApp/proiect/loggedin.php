<?php
     session_start();


      if( array_key_exists("id",$_COOKIE)  ){
            
            $_SESSION['id'] = $_COOKIE['id'];
          
           
      } 
  
      if( array_key_exists("id",$_SESSION)){
    //     print_r($_GET);
        
      $activeUserId = $_SESSION['id'];
        
     include("connection.php");

 $updateActivityQuery=" UPDATE `chat_users` SET `LAST_ACTIVITY` = now() WHERE `chat_users`.`id` = ".mysqli_real_escape_string($link,$activeUserId);
        
                     mysqli_query($link,$updateActivityQuery);
          //       echo"you where succesfuly logged in! <p><a href='index.php?logout=1'>log Out!</a></p>";     
        
        
            function getTimeAgo($timestamp){
               
                      $timeFromDB = strtotime($timestamp);
                      $current_time = time();     
                      $timeResult = $current_time - $timeFromDB;

                              $seconds = $timeResult; 
               
                                   $minutes   =	 round( $seconds / 60 ); 
                                   $hours     =  round( $seconds / 3600 ); 
                                   $days      =  round( $seconds  / 86400 );
                                   $weeks     =  round( $seconds  / 604800  );
 
                                 if($seconds <= 60){
                                    
                                      return "Just Now";
                                 }  else  if( $minutes <= 59 ){
                                        
                                          if($minutes == 1){
                                          
                                           return "one minute ago";
                                          } 
                                             else
                                           {                                            
                                               return "$minutes minutes ago";
                                           }
                                    
                                   }  else  if( $hours <= 24 ){
                                        
                                          if($hours == 1){
                                          
                                           return "one hour ago";
                                          } 
                                             else
                                           {                                            
                                               return "$hours hours ago";
                                           }
                                    
                                   }  
           							    else  if( $days <= 7 ){
                                        
                                          if($days == 1){
                                          
                                           return "one day ago";
                                          } 
                                             else
                                           {                                            
                                               return "$days days ago";
                                           }
                                    
                                   }  
               
              					    else  if( $weeks > 1 ){
                                        
                                          if($weeks == 1){
                                          
                                           return "one week ago";
                                          } 
                                           
                                    
                                   }    else
                                           {                                            
                                               return "more than a week ago";
                                           }
             }

        
        function setConversationId($sender,$recipient){
        
            $messageId = "";

                            if( $sender > $recipient ){

                                   $messageId =    $recipient."_".$sender;
                            } else {  
                                   $messageId =    $sender."_".$recipient;
                                     }
          
                  return $messageId;

        }
        
        
               function sendMessage($sender,$recipient,$message){

                      include("connection.php");
                 
              			$conversationId =   setConversationId($sender,$recipient);

             $sendMessageQuery = "INSERT INTO `conversations`(`conv_id`,`sender_id`, `recipient_id`, `message_body`, `sent_at`) VALUES ('".$conversationId."',".$sender.",".$recipient.",'".$message."',now() ) ";

                           if( !mysqli_query($link,$sendMessageQuery)){

                              echo"fail";
                           }
               } 

        
             function getMessages($sender,$recipient){

                            include("connection.php");
               
                             			$conversationId =   setConversationId($sender,$recipient);

                 $getAllMessagesQuery = "SELECT `message_body`,`sent_at`,`sender_id`,`recipient_id` FROM `conversations` WHERE `conv_id` = '".$conversationId."'";
               
                                                    $messageResult = mysqli_query($link, $getAllMessagesQuery);
               
                             if ($messageResult) {
                                                while( $row = mysqli_fetch_array($messageResult) ) {

                                                        $timestamp = strtotime($row['sent_at']);    
                                                        $time = date('G:i', $timestamp);
                                                        $message = $row['message_body'];
                                                        $senderId = $row['sender_id'];
                                                        $recipientId = $row['recipient_id'];
                                                  
                                           if($senderId == $sender ){         
                                                     echo "
                                                                        <div class='d-flex justify-content-end mb-4'>
                                                                            <div class='msg_cotainer_send'>" .$row['message_body']. "</div>
                                                                                <span class='msg_time'>$time</span>
                                                                            </div>
                                                                       ";
                                           } else { 
                                             
                                                             echo 
                                                               "<div class='d-flex justify-content-start mb-4'>
                                                  <div class'img_cont_msg'>
                                                      <img src='http://voxpopulii.in/system/static/dashboard/img/default_user.png' class='rounded-circle user_img_msg'>
                                                  </div>
                                                  <div class='msg_cotainer'>
                                                  $message
                                                  </div>
                                                  <span class='msg_time'>$time</span>
                                                                          </div>";

                                           }

             }
                             
                             }
             }
             function getSentMessages($user,$recipient){

                   include("connection.php");

      $getSentMessagesQuery = "SELECT `message_body`,`sent_at` FROM `conversations` WHERE `sender_id` = '".$user.
                                 "' AND `recipient_id` ='".$recipient."'";

                                $messageResult = mysqli_query($link, $getSentMessagesQuery);


                      if ($messageResult) {
                                    while( $row = mysqli_fetch_array($messageResult) ) {

                                            $timestamp = strtotime($row['sent_at']);    
                                         $time = date('G:i', $timestamp);

                                            echo "
                                    <div class='d-flex justify-content-end mb-4'>
                                        <div class='msg_cotainer_send'>" .$row['message_body']. "</div>
                                            <span class='msg_time'>$time</span>
                                        </div>
                                   ";
                            }
                        }


             }

            function setActivity($user){
                                             include("connection.php");      
                                            
                                              $getActivityQuery = "SELECT `LAST_ACTIVITY` FROM `chat_users` WHERE username = '".mysqli_real_escape_string($link, $user)."'";
                                              $activityResult = mysqli_query($link,$getActivityQuery);
                                        
                                             $activityRow = mysqli_fetch_array($activityResult); 
                                             $lastActivity = $activityRow['LAST_ACTIVITY'];
                                                  
                                          if( strpos(getTimeAgo($lastActivity), 'minute') !== false ){
                                          	    return "online_icon offline ";
                                          } else if ( getTimeAgo($lastActivity) == "Just Now" ) {  
                                           		  return "online_icon";
                                          }
                                                    
                                                }

      //  $lastUser = "value";   //variable to set in the conversation if no user is selected
         function getUsers($activeUser) {


                       include("connection.php");

                       $selectUsersQuery = "SELECT * FROM `chat_users` "; 

                      $result = mysqli_query($link, $selectUsersQuery);

                  if ($result) {
                    while( $row = mysqli_fetch_array($result) ) {

                              $userName = $row['username'];
                              $activity = $row['activity_status'];
                              $lastActivity = $row['LAST_ACTIVITY'];
                              $userId = $row['id'];
               
                              if($userId != $activeUser){

                    if($_GET['username'] == $userName){

                                 echo"<li class='active'>";
						} else {  
							     echo"<li>";

							    }
								$lastUser = $userName;

                                        echo"  <div class='d-flex bd-highlight'>
                                                      <div class='img_cont'>
                                                          <img src='http://voxpopulii.in/system/static/dashboard/img/default_user.png' class='rounded-circle user_img'>
                                                 <div class='";
                                                               echo  setActivity($userName);
                                                   echo " rounded-circle'></div>
                                                      </div>
                                                      <div class='user_info'>
                                                          <span class='username'>".$userName."</span>"    ; 


                                                                         echo "<p>"; echo getTimeAgo($lastActivity);  echo"</p> </div>
                                                                           </div>
                                                                              </li>";

                              }
                                                       
                    }

                  }
                       }

        
      } else {
      
          header("Location:index.php");
      }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">
<style type="text/css">
		<?php include("chat-CSS.php"); ?>
</style>
    <title>Hello, world!</title>
  </head>
  <body>

<nav class="nav nav-pills nav-fill bg-dark " id="navbar" >

		<ul class="nav  mr-auto ">
          <a class="navbar-brand text-secondary h1 noHover nav-margin"> <i class="fas fa-comment-slash"></i>ChatApp</a>


                    
		</ul>
      
		<ul class="nav  ">
         
                      
				<li class="nav-item ">
 <form class="form-inline nav-margin" >
     <a href="index.php?logout=1"class="btn btn-outline-success my-2 my-sm-0" role="button" >Log out</a>
  </form>
			    </li>

				<li class="nav-item ">
			    </li>

			  <li class="nav-item">
			  </li>
		</ul>

	</nav>
  <div class="container-fluid ">

	<div class="row justify-content-center h-100">

  <div class="card contact_list  mb-md-8 " >
	<div class="card-header ">
      
		<div class="input-group md-form form-sm form-1 pl-0">
			<div class="input-group-prepend">
				<span class="input-group-text purple bg-dark no_border" id=""><i class="fas fa-search text-white"
					aria-hidden="true"></i></span>
			</div>
  <input class="form-control search_bar my-0 py-1" type="text" placeholder="Search" aria-label="Search">
</div>

  </div>
  <div class="card-body contacts_body">
    

 	<ul class="contacts ">
   
						
                       <?php  
      
        
      	 getUsers($activeUserId);
      
                    ?>
    </ul>

    </div>
  </div>

 <div id="mobile-indicator"></div>

	<div class="col-md-8 col-xl-6 chat">

<div class="card message_box">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
                             
                                 <div class="return_arrow"><span><i class="fas fa-reply"></i></span></div>

								<div class="img_cont">
									<img src="http://voxpopulii.in/system/static/dashboard/img/default_user.png" class="rounded-circle user_img">
                           <div class= "<?php  
                                      
                                        
                                         $clickedUser = $_GET['username'];
                                       
                                           echo setActivity($clickedUser);
                                        
  				                     ?> rounded-circle"></div>
								</div>	<div class="user_info">
									<span>Chat with <span id="nameChat"><?php 
                                             echo $clickedUser;
                                            
                                          $message = $_POST['message'];
                                      
                                             $getUserIdQuery = "SELECT `id` FROM `chat_users` WHERE username = '".mysqli_real_escape_string($link, $clickedUser)."'";
                                       
                                                 $result =  mysqli_query($link,$getUserIdQuery);  
                                                                                                                                            
                                                      $row =  mysqli_fetch_array($result);    
                                                                 $recipientId = $row['id'];                                                                        
                                                         if($message !=""){
                                                                 sendMessage($activeUserId,$recipientId,$message);
                                                         }
                                     
                                      
         ?>
                              </span> </span>
									<p>nr. of Messages</p>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							
						</div>
						<div class="card-body msg_card_body" id="messages_body">
                          
                          
                              <?php   
                              
               
               getMessages($activeUserId,$recipientId);
                              ?>
								
						
               
       </div>
    <div class="card-footer">  
                      <form method="post">

							<div class="input-group">
								<div class="input-group-append ">
									<span class="input-group-text attach_btn  bg-dark no_border"><i class="fas fa-grin-wink text-white"></i></span>
								</div>
                              
                                      <textarea name="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                              <div class="input-group-append ">
                                                      
                                                	 <button class="btn btn-dark" type="submit"><i class="fas fa-location-arrow text-white"></i></button>

                                               </div>

							   </div>
                        </form>

						</div>
      

      </div>
    </div>
   </div>
   </div>


<?php include("loader-components/loader-html.php");?>

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <script type="text/javascript">



    <?php include("loader-components/loader-jquery.php");?>

  //  <?php
	//	 $isUserSelected=0;
	//	if( ! isset($_GET['username']))
	//	{
		//   $isUserSelected=1;
		//}
		
//?>


		$(window).on("load", function () {

				 $(".msg_card_body").scrollTop(1E10);


           //  var isUserSelected=<?php echo $isUserSelected; ?>;

				//	 if(isUserSelected==0)
				//	 {
                  //                  var val = <?php echo $lastUser ?>;
                   //          $("#nameChat").text(val)  ;
                     //      alert("get do not exists" + $("#nameChat").text() );
					// }
				

		});


		function GoToBottomOfConversation(){

			$(".type_msg").click(function(){
				 $(".msg_card_body").scrollTop(1E10);

				});

		}

			
		function isMobileWidth() {
			return $('#mobile-indicator').is(':visible');
		}

		function openConversation(){
		  
			$(".contacts li").click(function(){

				 $(".contact_list li").removeClass("active");
			 var clickedUserConversation = $('span', this).text();          
							 location.href = "loggedin.php?username=" + clickedUserConversation;

				 });
		}
			
		  
			
				function addMessageToConversation(){


							$(".send_btn").click(function(){
									 var message = $(".type_msg").val();
									  var  message_area = $(".msg_card_body");
		   
								  if( message  != "" ){

						message_area.append('<div class="d-flex justify-content-end mb-4"><div class="msg_cotainer_send"> ' +message
										  +	'</div><span class="msg_time">8:55 AM, Today</span></div>');
											$(".type_msg").val("");
								
								   }
							});

					}
			

					openConversation();
					GoToBottomOfConversation();

		if (isMobileWidth()) {
			 $(".contacts li").click(function(){

			   
			   $(".contact_list").addClass("hidden");
										 $(".chat").css("display","block");
										  setConversationActive();

										});

							$(".return_arrow").click(function(){

										 $(".contact_list").removeClass("hidden");
										 $(".chat").css("display","none");
										location.href = "loggedin.php";
							 
							});


		} else {             
		}
							


         </script>  
  </body>
</html>