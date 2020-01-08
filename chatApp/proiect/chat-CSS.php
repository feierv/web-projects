	body,html{
	height: 90%;
			margin: 0;
			
       background-image: linear-gradient(to left, #3a1c71, #d76d77,#ffaf7b);	
 font-family: 'Exo 2', sans-serif;
}

	.card{

	height:550px;
	background-color:#444653;
	}

	.container-fluid{
		height:92%;
	}
	 
	.chat_img {
	  float: left;
	  min-width: 12%;
	}

	.card-header{

	border-bottom:0;
	}

 <?php include("loader-components/loader-css.php");?>



	.contacts{
				list-style: none;
				padding: 0;
			}

	.contacts li{
				width: 100% !important;
				padding: 5px 10px;
				margin-bottom: 15px !important;
			}

	.active{
				background-color: rgba(0,0,0,0.3);
		}
		.user_img{
				height: 40px;
				width: 40px;
				border:1.5px solid #70757D;
			
			}

		.contacts_body{
				padding:  0.75rem 0 !important;
				overflow-y: auto;
				white-space: nowrap;
			}

		.user_info{
			margin-top: auto;
			margin-bottom: auto;
			margin-left: 15px;
		}
		.user_info span{
			font-size: 20px;
			color: white;
		}
		.user_info p{
		font-size: 10px;
		color: rgba(255,255,255,0.6);
		}

		.search_bar{
				background-color: rgba(0,0,0,0.3) !important;
				border:0 !important;
				color: white !important;
				cursor: pointer;
			}

			#search_icon{

			border:none;

			}
             .no_border{

			border:none;

			} 
            

	.online_icon{
	background-color: #4cd137;
	width:13px;
	height:13px;
	position:relative;
	top:-13px;
	}

	.offline{

			background-color: #E51400 !important;

	}


.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}

	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.video_cam{
		margin-left: 50px;
		margin-top: 5px;
	}
	.video_cam span{
		color: white;
		font-size: 20px;
		cursor: pointer;
		margin-right: 20px;
	}
       .return_arrow{
			color: white;
			font-size: 20px;
			cursor: pointer;
			margin-right: 20px;
             display:none;
	}

.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #603CBA;
		padding: 10px;
		position: relative;
        color:white;
	}
.message_box{
	background-color:#444653;
  


}
.msg_time{
		position:relative;
       top:15px;
       left:10px; 
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.action_menu{
		z-index: 1;
		position: absolute;
		padding: 15px 0;
		background-color: rgba(0,0,0,0.5);
		color: white;
		border-radius: 15px;
		top: 30px;
		right: 15px;
		display: none;
	}
	.msg_card_body{
			overflow-y: scroll;
		}

.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #1D1D1D;
		padding: 10px;
		position: relative;
        color:white;
	}


	.contacts li:hover{
		cursor: pointer;
		background-color: rgba(0,0,0,0.2);
	}

@media only screen and (max-width: 840px) {

	 .contact_list{
			 width: 100%;
 min-height: 100vh
		}

	   .chat{
      padding:0;
      margin:0;
	  display:none;
	   }

.card{

 width: 100%;
 min-height: 100%;

}

       .return_arrow{
			display:block;
               }
	}



.hidden{

display:none;
}

#mobile-indicator {
    display: none;
}

@media (max-width: 767px) {
    #mobile-indicator {
        display: block;
    }
}
.navbar-brand{
    
     padding-left:15px;
    
  }
.noHover{
    pointer-events: none;
}
 .nav-margin{
    
    margin-top:6px;
    margin-right:10px;

  }
.send_btn{

				cursor: pointer;
}

#messageArea{

width:100%;

}