<?php 
include('dbconfig.php');
if($f3->exists('SESSION.username')){  
	if($f3->exists('SESSION.login_time')){
		if((time() - $f3->get('SESSION.login_time')) <= 600){
			$f3->set('login_time',time());
		}else{
			$f3->reroute('logout.php');
		}
	}	
}else{
	$f3->reroute('logout.php');
}
$user =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
$user->load(array('username=?', $f3->get('SESSION.username')));

$ticketcounter =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
$ticketcounter->load(array('status = ? AND agent = ?', "Open", $f3->get('SESSION.username')));

$dashboardcounter =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
$dashboardcounter->load(array('agent = ?', ""));

$pointcounter =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
$pointcounter->load(array('status = ?', "Closed"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>bs4 Profile Settings page - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap/4.1.2/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    margin-top:20px;
    background:#F0F8FF;
}
.card {
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e5e9f2;
    border-radius: .2rem;
}
.card-header:first-child {
    border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
}
.card-header {
    border-bottom-width: 1px;
}
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    color: inherit;
    background-color: #fff;
    border-bottom: 1px solid #e5e9f2;
}

.user-info-wrapper {
    position: relative;
    width: 100%;
    margin-bottom: -1px;
    padding-top: 90px;
    padding-bottom: 30px;
    border: 1px solid #e1e7ec;
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
    overflow: hidden
}

.user-info-wrapper .user-cover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 120px;
    background-position: center;
    background-color: #f5f5f5;
    background-repeat: no-repeat;
    background-size: cover
}

.user-info-wrapper .user-cover .tooltip .tooltip-inner {
    width: 230px;
    max-width: 100%;
    padding: 10px 15px
}

.user-info-wrapper .info-label {
    display: block;
    position: absolute;
    top: 18px;
    right: 18px;
    height: 26px;
    padding: 0 12px;
    border-radius: 13px;
    background-color: #fff;
    color: #606975;
    font-size: 12px;
    line-height: 26px;
    box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.18);
    cursor: pointer
}

.user-info-wrapper .info-label>i {
    display: inline-block;
    margin-right: 3px;
    font-size: 1.2em;
    vertical-align: middle
}

.user-info-wrapper .user-info {
    display: table;
    position: relative;
    width: 100%;
    padding: 0 18px;
    z-index: 5
}

.user-info-wrapper .user-info .user-avatar,
.user-info-wrapper .user-info .user-data {
    display: table-cell;
    vertical-align: top
}

.user-info-wrapper .user-info .user-avatar {
    position: relative;
    width: 115px
}

.user-info-wrapper .user-info .user-avatar>img {
    display: block;
    width: 100%;
    border: 5px solid #fff;
    border-radius: 50%
}

.user-info-wrapper .user-info .user-avatar .edit-avatar {
    display: block;
    position: absolute;
    top: -2px;
    right: 2px;
    width: 36px;
    height: 36px;
    transition: opacity .3s;
    border-radius: 50%;
    background-color: #fff;
    color: #606975;
    line-height: 34px;
    box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.2);
    cursor: pointer;
    opacity: 0;
    text-align: center;
    text-decoration: none
}

.user-info-wrapper .user-info .user-avatar .edit-avatar::before {
    font-family: feather;
    font-size: 17px;
    content: '\e058'
}

.user-info-wrapper .user-info .user-avatar:hover .edit-avatar {
    opacity: 1
}

.user-info-wrapper .user-info .user-data {
    padding-top: 48px;
    padding-left: 12px
}

.user-info-wrapper .user-info .user-data h4 {
    margin-bottom: 2px
}

.user-info-wrapper .user-info .user-data span {
    display: block;
    color: #9da9b9;
    font-size: 13px
}

.user-info-wrapper+.list-group .list-group-item:first-child {
    border-radius: 0
}

.user-info-wrapper+.list-group .list-group-item:first-child {
    border-radius: 0;
}
.list-group-item:first-child {
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
}
.list-group-item:first-child {
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
a.list-group-item {
    padding-top: .87rem;
    padding-bottom: .87rem;
}
a.list-group-item, .list-group-item-action {
    transition: all .25s;
    color: #606975;
    font-weight: 500;
}
.with-badge {
    position: relative;
    padding-right: 3.3rem;
}
.list-group-item {
    border-color: #e1e7ec;
    background-color: #fff;
    text-decoration: none;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,0.125);
}

.badge.badge-primary {
    background-color: #0da9ef;
}
.with-badge .badge {
    position: absolute;
    top: 50%;
    right: 1.15rem;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
}
.list-group-item i {
    margin-top: -4px;
    margin-right: 8px;
    font-size: 1.1em;
}

    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container p-0">
    <h1 class="h3 mb-3">Profile</h1>
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(https://bootdey.com/img/Content/bg1.jpg);">
                    <?php if($user->hd_staff == 'true'){ ?><div class="info-label" data-toggle="tooltip" title="" data-original-title="You currently have <?php echo $pointcounter->loaded(); ?> Reward Points to spend"><i class="icon-medal"></i><?php echo $pointcounter->loaded(); ?> points</div> <?php } ?>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <a class="edit-avatar" href="#"></a><img src="<?php echo $user->profileimg; ?>" alt="<?php echo $user->username; ?>"></div>
                    <div class="user-data">
                        <h4><?php echo $user->firstname.' '.$user->lastname; ?></h4><span>Joined <?php echo date_format(date_create($user->created_on), "F d, Y"); ?></span>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
				<a class="list-group-item  with-badge" href="dashboard.php"><i class="fa fa-th"></i>Dashbaord<?php if($dashboardcounter->loaded()> 0){ ?><span class="badge badge-primary badge-pill"><?php echo $dashboardcounter->loaded(); ?></span><?php } ?></a>
                 <?php if($user->hd_staff == 'true'){ ?>
					<a class="list-group-item with-badge" href="mytickets.php"><i class="fa fa-th"></i>My Tickets<?php if($ticketcounter->loaded()> 0){ ?><span class="badge badge-primary badge-pill"><?php echo $ticketcounter->loaded(); ?></span><?php } ?></a>
				<?php } ?>
				<a class="list-group-item" href="createticket.php"><i class="fa fa-ticket"></i>Create Ticket</a>
                <a class="list-group-item active" href="userprofile.php"><i class="fa fa-user"></i>Profile</a>
                <a class="list-group-item" href="faq.php"><i class="fa fa-user"></i>FAQs</a>
                <?php if($user->hd_user == 'true'){ ?>
					<a class="list-group-item" href="feedbacks.php"><i class="fa fa-user"></i>Feedbacks</a>
				<?php } ?>
                <a class="list-group-item" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
            </nav>
        </div>

        <div class="col-md-7 col-xl-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-right">
                                <div class="dropdown show">
                                    <a href="#" data-toggle="dropdown" data-display="static">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Public info</h5>
                        </div>
                        <div class="card-body">
						<?php if($f3->exists('SESSION.userinfo')){?>
							<p style="background: green; padding: 15px; color: #fff; font-size: 14px;">Your profile was sucessfully updated!</p>
						<?php } ?>
						<?php if($f3->exists('SESSION.userinfoerror')){?>
							<p style="background: red; padding: 15px; color: #fff; font-size: 14px;"><?php echo $f3->get('SESSION.userinfoerror'); ?></p>
						<?php } ?>
                            <form method="post" action="handler.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" disabled value="<?php echo $user->username; ?>" placeholder="Username">
                                        </div>
										<div class="form-group">
											<label for="password">Current password</label>
											<input type="password" class="form-control" name="password" id="password">
											
										</div>
                                        <div class="form-group">
                                            <label for="bio">Biography</label>
                                            <textarea rows="2" class="form-control" id="bio" name="bio" placeholder="Tell something about yourself"><?php echo $user->bio; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img id="displayimg" alt="<?php echo $user->username; ?>" src="<?php echo $user->profileimg; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                            <div class="mt-2">
												<input type="file" id="profileimg" name="profileimg" style="display:none"/>
                                                <span id="uploadimg" class="btn btn-primary"><i class="fa fa-upload"></i></span>
                                            </div>
                                            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" name="userinfo">Save changes</button>
                            </form>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-right">
                                <div class="dropdown show">
                                    <a href="#" data-toggle="dropdown" data-display="static">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Private info</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="handler.php" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user->firstname; ?>" placeholder="First name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control" id="inputLastName" id="lastname" name="lastname" value="<?php echo $user->lastname; ?>" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="email" class="form-control" id="emailaddress" name="emailaddress" value="<?php echo $user->emailaddress; ?>" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="address1">Address</label>
                                    <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $user->address1; ?>"  placeholder="1234 Main St">
                                </div>
                                <div class="form-group">
                                    <label for="address2">Address 2</label>
                                    <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $user->address2; ?>"  placeholder="Apartment, studio, or floor">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $user->city; ?>" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state" value="<?php echo $user->state; ?>" >
                                            <option selected="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="<?php echo $user->country; ?>" >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="userinfo2">Save changes</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap/4.1.2/bootstrap.min.js"></script>
<?php if($f3->exists('SESSION.userinfo')){ unset($_SESSION['userinfo']); } ?>
<?php if($f3->exists('SESSION.userinfoerror')){ unset($_SESSION['userinfoerror']); } ?>
<script>
document.querySelector("#uploadimg").addEventListener("click", function(event){
	$('#profileimg').trigger('click'); 
 });
$("#profileimg").on('change',function(){
  var fd = new FormData();
	var files = $('#profileimg')[0].files;
	$('#displayimg')[0].src = (window.URL ? URL : webkitURL).createObjectURL(document.querySelector('#profileimg').files[0]);
	console.log(files);
 });
</script>
<script>(function(w, d) { w.CollectId = "6084154b34b8b76f099efb2f"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
</body>
</html>