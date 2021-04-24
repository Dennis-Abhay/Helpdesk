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

if($user->hd_staff == "true"){
	$tickets =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
	$tickets->load(array('agent=?', ''));
}else{
	$tickets =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
	$tickets->load(array('username=?', $f3->get('SESSION.username')));
}


$ticketcounter =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
$ticketcounter->load(array('status = ?', "Open"));
// This function was gotten from https://www.w3schools.in/php-script/time-ago-function/
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>support tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{margin-top:20px;
background:#eee;
}

.padding {
    padding: 10px;
}

/* GRID */
.col {
    padding: 10px 20px;
	margin-bottom: 10px;
	background: #fff;
	color: #666666;
	text-align: center;
	font-weight: 400;
	box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
}

.row h3 {
	color: #666666;
}

.row.grid {
	margin-left: 0;
}

.grid {
	position: relative;
	width: 100%;
	background: #fff;
	color: #666666;
	border-radius: 2px;
	margin-bottom: 25px;
	box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
}

.grid .grid-header {
	position: relative;
	border-bottom: 1px solid #ddd;
	padding: 15px 10px 10px 20px;
}

.grid .grid-header:before,
.grid .grid-header:after {
	display: table;
	content: " ";
}

.grid .grid-header:after {
	clear: both;
}

.grid .grid-header span,
.grid .grid-header > .fa {
	display: inline-block;
	margin: 0;
	font-weight: 300;
	font-size: 1.5em;
	float: left;
}

.grid .grid-header span {
	padding: 0 5px;
}

.grid .grid-header > .fa {
	padding: 5px 10px 0 0;
}

.grid .grid-header > .grid-tools {
	padding: 4px 10px;
}

.grid .grid-header > .grid-tools a {
	color: #999999;
	padding-left: 10px;
	cursor: pointer;
}

.grid .grid-header > .grid-tools a:hover {
	color: #666666;
}

.grid .grid-body {
	padding: 15px 20px 15px 20px;
	font-size: 0.9em;
	line-height: 1.9em;
}

.grid .full {
	padding: 0 !important;
}

.grid .transparent {
	box-shadow: none !important;
	margin: 0px !important;
	border-radius: 0px !important;
}

.grid.top.black > .grid-header {
	border-top-color: #000000 !important;
}

.grid.bottom.black > .grid-body {
	border-bottom-color: #000000 !important;
}

.grid.top.blue > .grid-header {
	border-top-color: #007be9 !important;
}

.grid.bottom.blue > .grid-body {
	border-bottom-color: #007be9 !important;
}

.grid.top.green > .grid-header {
	border-top-color: #00c273 !important;
}

.grid.bottom.green > .grid-body {
	border-bottom-color: #00c273 !important;
}

.grid.top.purple > .grid-header {
	border-top-color: #a700d3 !important;
}

.grid.bottom.purple > .grid-body {
	border-bottom-color: #a700d3 !important;
}

.grid.top.red > .grid-header {
	border-top-color: #dc1200 !important;
}

.grid.bottom.red > .grid-body {
	border-bottom-color: #dc1200 !important;
}

.grid.top.orange > .grid-header {
	border-top-color: #f46100 !important;
}

.grid.bottom.orange > .grid-body {
	border-bottom-color: #f46100 !important;
}

.grid.no-border > .grid-header {
	border-bottom: 0px !important;
}

.grid.top > .grid-header {
	border-top-width: 4px !important;
	border-top-style: solid !important;
}

.grid.bottom > .grid-body {
	border-bottom-width: 4px !important;
	border-bottom-style: solid !important;
}


/* SUPPORT TICKET */
.support ul {
    list-style: none;
	padding: 0px;
}

.support ul li {
	padding: 8px 10px;
}

.support ul li a {
	color: #999;
	display: block;
}

.support ul li a:hover {
	color: #666;
}

.support ul li.active {
	background: #0073b7;
}

.support ul li.active a {
	color: #fff;
}

.support ul.support-label li {
	padding: 2px 0px;
}

.support h2,
.support-content h2 {
	margin-top: 5px;
}

.support-content .list-group li {
	padding: 15px 20px 12px 20px;
	cursor: pointer;
}

.support-content .list-group li:hover {
	background: #eee;
}

.support-content .fa-padding .fa {
	padding-top: 5px;
	width: 1.5em;
}

.support-content .info {
	color: #777;
	margin: 0px;
}

.support-content a {
	color: #111;
}

.support-content .info a:hover {
	text-decoration: underline;
}

.support-content .info .fa {
	width: 1.5em;
	text-align: center;
}

.support-content .number {
	color: #777;
}

.support-content img {
	margin: 0 auto;
	display: block;
}

.support-content .modal-body {
	padding-bottom: 0px;
}

.support-content-comment {
	padding: 10px 10px 10px 30px;
	background: #eee;
	border-top: 1px solid #ccc;
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
.list-group{
	font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
	font-weight: 600;
}.
list-group-item:first-child {
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
}
.list-group-item:first-child {
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
a.list-group-item {
    padding-top: 1.75rem;
    padding-bottom: 1.75rem;
}
a.list-group-item, .list-group-item-action {
    transition: all .25s;
    color: #606975;
    font-weight: 500;
	font-size: 16px;
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
    padding: .75rem 1.75rem;
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


/* BACKGROUND COLORS */
.bg-red, .bg-yellow, .bg-aqua, .bg-blue, .bg-light-blue, .bg-green, .bg-navy, .bg-teal, .bg-olive, .bg-lime, .bg-orange, .bg-fuchsia, .bg-purple, .bg-maroon, bg-gray, bg-black, .bg-red a, .bg-yellow a, .bg-aqua a, .bg-blue a, .bg-light-blue a, .bg-green a, .bg-navy a, .bg-teal a, .bg-olive a, .bg-lime a, .bg-orange a, .bg-fuchsia a, .bg-purple a, .bg-maroon a, bg-gray a, .bg-black a {
    color: #f9f9f9 !important;
}
.bg-white, .bg-white a {
	color: #999999 !important;
}
.bg-red {
	background-color: #f56954 !important;
}
.bg-yellow {
	background-color: #f39c12 !important;
}
.bg-aqua {
	background-color: #00c0ef !important;
}
.bg-blue {
	background-color: #0073b7 !important;
}
.bg-light-blue {
	background-color: #3c8dbc !important;
}
.bg-green {
	background-color: #00a65a !important;
}
.bg-navy {
	background-color: #001f3f !important;
}
.bg-teal {
	background-color: #39cccc !important;
}
.bg-olive {
	background-color: #3d9970 !important;
}
.bg-lime {
	background-color: #01ff70 !important;
}
.bg-orange {
	background-color: #ff851b !important;
}
.bg-fuchsia {
	background-color: #f012be !important;
}
.bg-purple {
	background-color: #932ab6 !important;
}
.bg-maroon {
	background-color: #85144b !important;
}
.bg-gray {
	background-color: #eaeaec !important;
}
.bg-black {
	background-color: #222222 !important;
}

    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<section class="content">
	<div class="row">
		<!-- BEGIN NAV TICKET -->
		<div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(https://bootdey.com/img/Content/bg1.jpg);">
                    <?php if($user->hd_staff == 'true'){ ?><div class="info-label" data-toggle="tooltip" title="" data-original-title="You currently have 290 Reward Points to spend"><i class="icon-medal"></i>290 points</div> <?php } ?>
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
				<a class="list-group-item  with-badge active" href="dashboard.php"><i class="fa fa-th"></i>Dashbaord<span class="badge badge-primary badge-pill">6</span></a>
                 <?php if($user->hd_staff == 'true'){ ?>
					<a class="list-group-item with-badge " href="mytickets.php"><i class="fa fa-th"></i>My Tickets<span class="badge badge-primary badge-pill">6</span></a>
				<?php } ?>
				<a class="list-group-item" href="createticket.php"><i class="fa fa-ticket"></i>Create Ticket</a>
                <a class="list-group-item" href="userprofile.php"><i class="fa fa-user"></i>Profile</a>
                <a class="list-group-item" href="faq.php"><i class="fa fa-question"></i>FAQs</a>
				<a class="list-group-item" href="feedbacks.php"><i class="fa fa-user"></i>Feedbacks</a>
                <a class="list-group-item" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
            </nav>
        </div>
		<!-- END NAV TICKET -->
		<!-- BEGIN TICKET -->
		<div class="col-md-8">
			<div class="grid support-content">
				 <div class="grid-body">
					 <?php if($user->hd_staff == "true"){ ?>
						<h2>Unassigned Tickets</h2>
					 <?php }else{ ?>
						<h2>Tickets</h2>
					<?php } ?>
					 
					 <hr>
					 <?php if($user->hd_user == "true"){ ?>
						<div class="btn-group">
							<button type="button" class="btn btn-default active"><?php  echo $ticketcounter->loaded(); ?> Open</button>
							<button type="button" class="btn btn-default"><?php $ticketcounter->load(array('status = ?', "Closed")); echo $ticketcounter->loaded(); ?> Closed</button>
						</div>
					 
					 <div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Sort: <strong>Newest</strong> <span class="caret"></span></button>
						<ul class="dropdown-menu fa-padding" role="menu">
							<li><a href="#"><i class="fa fa-check"></i> Newest</a></li>
							<li><a href="#"><i class="fa"> </i> Oldest</a></li>
							<li><a href="#"><i class="fa"> </i> Recently updated</a></li>
							<li><a href="#"><i class="fa"> </i> Least recently updated</a></li>
							<li><a href="#"><i class="fa"> </i> Most commented</a></li>
							<li><a href="#"><i class="fa"> </i> Least commented</a></li>
						</ul>
					</div>
					
					<!-- BEGIN NEW TICKET -->
					<button type="button" class="btn btn-success pull-right" onclick="document.location.href='createticket.php'">New Ticket</button>
					<!-- END NEW TICKET -->
					 
					<div class="padding"></div>
					 <?php } ?>
					<div class="row">
						<!-- BEGIN TICKET CONTENT -->
						<div class="col-md-12">
							<ul class="list-group fa-padding">
							 <?php
                                    if(!$tickets->dry()){
                                        while(!$tickets->dry()){
                                ?>
								<li class="list-group-item clickcontrol" data-id="<?php echo $tickets->ticket_id; ?>">
									<div class="media">
										<i class="fa fa-cog pull-left"></i>
										<div class="media-body">
											<strong><?php echo $tickets->subject; ?></strong> <span class="label label-danger"><?php echo $tickets->impact_level; ?></span>
											<?php if($user->hd_staff == "true"){ ?>
												<span class="number pull-right" style="margin-top: 20px;"><a id="acceptticket" href="handler.php?ticketid=<?php echo $tickets->ticket_id; ?>">Accept Ticket</a></span>
											<?php } ?>
											<span class="number pull-right" style="margin-right: -75px;"># <?php echo $tickets->ticket_id; ?></span>
											<p class="info">Create by <a href="#"><?php echo $tickets->username; ?></a> <?php echo get_time_ago( strtotime($tickets->created_at) ); ?> <i class="fa fa-comments"></i> <a href="ticketview.php">2 replys</a></p>
										</div>
									</div>
								</li>
								<?php
                			            $tickets->next();
                                        }
                                    }else{
								?>
									<li class="list-group-item" style="background: lightgray; text-align: center;">
										<div class="media">
											There are no tickets created yet!
										</div>
									</li>
                			  <?php
                                    }
                                ?>
							</ul>
						</div>
						<!-- END TICKET CONTENT -->
					</div>
				</div>
			</div>
		</div>
		<!-- END TICKET -->
	</div>
	<form method="post" id="postform">
        
    </form>
</section>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>(function(w, d) { w.CollectId = "6084154b34b8b76f099efb2f"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
<script type="text/javascript">
	var list = document.querySelectorAll('.clickcontrol');
	var acceptticket = document.querySelectorAll('#acceptticket');
	acceptticket.addEventListener('click', function (event) { event.stopPropagation(); });
	for (var i = 0; i < list.length; i++) {
		var self = list[i];
		self.addEventListener('click', function (event) {  
			// prevent browser's default action
			event.preventDefault();
				if(this.getAttribute('data-id').length > 0){
					postPackage("ticketview.php",  this.getAttribute('data-id'));
				}			
		}, false);
	}
	
	function postPackage(action, value){
		$('<input>').attr({'type' : 'hidden',  name : "ticket_id",  value: value}).appendTo('#postform');
		$('#postform').attr('action', action).submit();
	}
</script>
</body>
</html>