<?php 
include('dbconfig.php');
//if($f3->exists('SESSION.username')){  
//	if($f3->exists('SESSION.login_time')){
//		if((time() - $f3->get('SESSION.login_time')) <= 600){
//			$f3->set('login_time',time());
//		}else{
//			$f3->reroute('logout.php');
//		}
//	}	
//}else{
//	$f3->reroute('logout.php');
//}
$error = false;
	if(isset($_POST['signin'])){
		$user =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
		$user->load(array('username=? AND password=?', $f3->get('POST.username'), $f3->get('POST.password')));
		if($user->dry()){
			$f3->set('SESSION.invalidlogin', "true");
			$f3->reroute('login.php');
		}else{
			$f3->set('SESSION.username', $f3->get('POST.username'));
			$f3->reroute('dashboard.php');
		}
	}else if(isset($_POST['signup'])){
		$user =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
    	$user->load(array('username=?', $f3->get('POST.username')));
    	if($user->dry()){
			$user->copyFrom('POST');
			$user->save();
			$f3->set('SESSION.username', $f3->get('POST.username'));
			$f3->reroute('dashboard.php');
		}else{
			$f3->set('SESSION.invalidsignup', "true");
			$f3->reroute('register.php');
		}
	}else if(isset($_POST['createticket'])){
		
		$ticket =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
		$ticket->copyFrom('POST');
		$ticket->status = "open";
		$ticket->username = $f3->get("SESSION.username");
		$ticket->save();
		
		$messages =  new DB\SQL\Mapper($f3->get('db'),'hd_tick_messages');
		$messages-> ticket_id = $ticket->ticket_id;
		$messages->content = $f3->get("POST.content");
		$messages->username = $f3->get("SESSION.username");
		$messages->save();
		
		$f3->set('SESSION.ticketcreated', "true");
		$f3->reroute('createticket.php');
	}else if(isset($_POST['replyticket'])){
		$ticket =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
		$ticket->load(array('ticket_id=?', $f3->get('POST.ticket_id')));
		$ticket->update_at = date_create()->format('Y-m-d H:i:s');
		$ticket->save();
		
		$messages =  new DB\SQL\Mapper($f3->get('db'),'hd_tick_messages');
		$messages-> ticket_id = $ticket->ticket_id;
		$messages->content = $f3->get("POST.content");
		$messages->username = $f3->get("SESSION.username");
		$messages->message_date = date_create()->format('Y-m-d H:i:s');
		$messages->save();
		
		$f3->set('SESSION.ticketreplied', "true");
		$f3->reroute('ticketview.php?ticket_id='.$f3->get('POST.ticket_id'));
	}else if(isset($_POST['userinfo2'])){
		$user =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
		$user->load(array('username=?', $f3->get('SESSION.username')));
		$user->copyFrom('POST');
		$user->save();
		
		$f3->set('SESSION.userinfo', "true");
		$f3->reroute('userprofile.php');
	}else if(isset($_GET['feedback'])){
		$feedback =  new DB\SQL\Mapper($f3->get('db'),'hd_feedback');
		$feedback->copyFrom('POST');
		$feedback->save();
		$f3->reroute('feedbacks.php');
	}else if(isset($_GET['ticketid'])){
		$ticket =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
		$ticket->load(array('ticket_id=?', $f3->get('GET.ticketid')));
		$ticket->agent = $f3->get('SESSION.username');
		$ticket->save();
		$f3->reroute('mytickets.php');
	}else if(isset($_POST['userinfo'])){
		$user =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
		$user->load(array('username=?', $f3->get('SESSION.username')));
		$user->copyFrom('POST');
		$user->save();
		
		if(file_exists($_FILES['profileimg']['tmp_name']) && is_uploaded_file($_FILES['profileimg']['tmp_name']) && $f3->exists("SESSION.username")){
			if ($_FILES["profileimg"]["error"] > 0){
				$f3->set('SESSION.userinfoerror', "An error occurred while uploading, please try again later!."); 
			}else{
				/* Getting file name */
			   $filename = $f3->get("SESSION.username"); //$_FILES['profileimg']['name'];
			
			   /* Location */
			   $location = "img/".$filename;
			   $imageFileType = pathinfo($_FILES['profileimg']['name'],PATHINFO_EXTENSION);
			   $imageFileType = strtolower($imageFileType);
			
			   /* Valid extensions */
			   $valid_extensions = array("jpg","jpeg","png");
			   // Check file size
			   if ($_FILES["profileimg"]["size"] > 1000000) { // 1Mb  //1000000
				  $f3->set('SESSION.userinfoerror', "Sorry, your file is too large! Maximum file size allow is 1Mb");
			   }else{
					/* Check file extension */
					if(in_array(strtolower($imageFileType), $valid_extensions)) {
					  /* Upload file */
					  //checking if file exsists
					  if(file_exists($location)) 
						unlink($location);
						
					  if(move_uploaded_file($_FILES['profileimg']['tmp_name'], $location. "." .$imageFileType)){
							$user->profileimg = $location. "." .$imageFileType;
							$user->save();
							$f3->set('SESSION.userinfo', "true");
					  }else{
						  $f3->set('SESSION.userinfoerror', "An error occurred while uploading, please try again later!.");
					  }
					}else{
					   $f3->set('SESSION.userinfoerror', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
					}
			   }
			}
		}
		$f3->reroute('userprofile.php');
	}else{
		$f3->reroute('logout.php');
		$f3->run();
	}
?>