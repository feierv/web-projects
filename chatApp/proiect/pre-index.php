<?php
session_start();

if(array_key_exists("id",$_SESSION) OR array_key_exists("id",$_COOKIE)){
 
             header("Location:loggedin.php");
      }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Hello, world!</title>

<style type="text/css">



body{ 
 position:relative;
   font-family: 'Exo 2', sans-serif;
   
}
  
 

.centerme {
  position: relative;
  transform: translateX(+20%);
}

.top-mg{margin-top:50px;}

.jumbotron {
 
			 background: url('https://images.unsplash.com/photo-1573614035625-ca70fce5b67f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80') no-repeat center center fixed;
		  background-repeat:no-repeat;
		-webkit-background-size:cover;
		-moz-background-size:cover;
		-o-background-size:cover;
		background-size:cover;
		background-position:center;
}

.navbar-fixed-top .active a { 
 color:black;
}

#appSummary{

   text-align:center;
   margin-top:25px;
   margin-bottom:25px;

}

#footer-img{
   width:200px;
    height:50px;
 } 

 #footer{
   text-align:center;
   padding-top:130px;
   margin-top:50px;
   background-color:aqua;
   padding-bottom:130px;
  }
  
  .noHover{
    pointer-events: none;
}
  
  .navbar-brand{
    
     padding-left:15px;
    
  }
  
  .nav-margin{
    
    margin-top:10px;
  }
 
   .jumbotron{
  text-align: center;
      min-height: 700px;
}

  
  
  
   .fas-jumbotron{
    margin-right:10px;
  }
  
  .fas-about{
    margin-right:10px;
  }
  
  
  .btn-width-jumbotron{
    
        width:170px;

  }
  
  .lead{
    
    font-size:23px;
    color:white;
    
  }
  
  .login_btn{
  color: black;
  background-color: #F85400;
    border:none;
    
  }
   .login_btn:hover{
        color: black;
		background-color: white;
         border:none;

     }
  #logo{
    
    padding-top:100px;
    padding-bottom:50px;
     
  }
  .social_icon span{
		font-size: 60px;
		margin-left: 30px;
		color: #F85400;
	}
	.social_icon{
		
	}
.social_icon span:hover{

         color: white;

      }
  
   .content {

  position: fixed;
     }
  
  
.loader-wrapper {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #242f3f;
  display:flex;
  justify-content: center;
  align-items: center;
}

  
</style>


  </head>
  <body data-spy="scroll" data-target="#navbar" data-offset="70">


	<nav class="nav nav-pills nav-fill bg-dark fixed-top" id="navbar" >

		<ul class="nav  mr-auto ">
          <a class="navbar-brand text-secondary h1 noHover nav-margin"> <i class="fas fa-comment-slash"></i>ChatApp</a>

                    
		</ul>
      
		<ul class="nav  ">
         
                      
				<li class="nav-item ">

					<a class="nav-item nav-link active nav-margin" href="#jumbotron">Home</a>
			    </li>

				<li class="nav-item ">
					<a class="nav-link nav-margin" href="#appSummary">About</a>
			    </li>

			  <li class="nav-item">
				 <a class="nav-link text-muted nav-margin" href="#footer">follow us</a>
			  </li>
		</ul>

	</nav>

				<div class="jumbotron" id="jumbotron">
  <h1 class="display-4 noHover" id="logo"><i class="fas fa-comment-slash "></i>ChatApp</a></h1>
    <div class="container">
     <p class="lead font-weight-bold">Our chat community gives you the opportunity of making new friends and sharing good moments with other people.</p>
    </div>  
  <hr class="my-4">
  <p class="lead ">
    <a class="btn btn-primary btn-lg rounded-pill login_btn btn-width-jumbotron" href="index.php" role="button"> <i class="fas fa-paper-plane fas-jumbotron "></i>Log in!</a>
  </p>
    <p class="lead">not a member yet?<p/>
     <p class="lead ">
<button type="button " class="btn btn-info btn-lg rounded-pill btn-width-jumbotron"><i class="fas fa-user fas-jumbotron"></i>register</button>  </p>
</div>

	<div class="container">

       <div class="col" id="appSummary">
			<h1>Why this App is Awesome!</h1>

            <p class="lead">an reminder of your app awesomness  </p>
         </div>
	</div>

<div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="https://miro.medium.com/max/10534/1*rlflhrYKPX_Jk6gi4y0l4w.jpeg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"> <i class="fas fa-question fas-about"></i>What you need to know</h5>
      <p class="card-text">The real world is not so far from the Virtual world, in a Chat you can be whoever you want but this can still create consequences. Here we will do our best to protect you from the dangers, you have several tools available,</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://comps.canstockphoto.com/red-shield-icon-access-denied-protection-vector-clipart_csp53287909.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"> <i class="fas fa-balance-scale-left fas-about"></i>About this Chat</h5>
      <p class="card-text">Respect other humans, Do not do anything that can harm anyone, Sexually objectifying, , describing violent actions toward, describing your physical reactions to, hate speech, or discriminatory language based on gender, </p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://cdn2.vectorstock.com/i/1000x1000/39/51/vip-club-logo-vector-25753951.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"> <i class="fas fa-user fas-about"></i>special feutures</h5>
      <p class="card-text">ou can Chat As Guest with many limitations, this will allow you to try if you like the environment.Our users will help you learn all the functions step by step, over time you can also become a VIP user to access many other features.</p>
      <p class="card-text"><small class="text-muted">Last updated 10 mins ago</small></p>
    </div>
  </div>
</div>


	<div class="container-fluid bg-dark" id="footer">

         <div class="col">
 
          
           
        
				<div class=" social_icon">
					 <span><i class="fab fa-facebook-square"></i></span>
                     <span><i class="fab fa-instagram"></i> </span>
					 <span><i class="fab fa-twitter-square"></i></span>
				</div>
			

	</div>
</div>




 <?php include("footer.php"); ?>
