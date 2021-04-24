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
}else {
	$f3->reroute('logout.php');
}

if(!$f3->exists('POST.ticket_id') && !$f3->exists('GET.ticket_id')){
	$f3->reroute('dashboard.php');
}else{
	$user =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
	$user->load(array('username=?', $f3->get('SESSION.username')));

	$tickets =  new DB\SQL\Mapper($f3->get('db'),'hd_ticket');
	$tickets->load(array('ticket_id=?', $f3->exists('POST.ticket_id') ? $f3->get('POST.ticket_id') : $f3->get('GET.ticket_id')));
	
	$tickmsg =  new DB\SQL\Mapper($f3->get('db'),'hd_tick_messages');
	$tickmsg->load(array('ticket_id=?', $f3->exists('POST.ticket_id') ? $f3->get('POST.ticket_id') : $f3->get('GET.ticket_id')));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Ticket View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{margin-top:20px;}

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
	border-bottom: 2px #eee solid;
	text-decoration: none;
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


.comment {
    display: block;
    position: relative;
    margin-bottom: 30px;
    padding-left: 66px
}

.comment .comment-author-ava {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    border-radius: 50%;
    overflow: hidden
}

.comment .comment-author-ava>img {
    display: block;
    width: 100%
}

.comment .comment-body {
    position: relative;
    padding: 24px;
    border: 1px solid #e1e7ec;
    border-radius: 7px;
    background-color: #fff
}

.comment .comment-body::after,
.comment .comment-body::before {
    position: absolute;
    top: 12px;
    right: 100%;
    width: 0;
    height: 0;
    border: solid transparent;
    content: '';
    pointer-events: none
}

.comment .comment-body::after {
    border-width: 9px;
    border-color: transparent;
    border-right-color: #fff
}

.comment .comment-body::before {
    margin-top: -1px;
    border-width: 10px;
    border-color: transparent;
    border-right-color: #e1e7ec
}

.comment .comment-title {
    margin-bottom: 8px;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.comment .comment-text {
    margin-bottom: 12px
}

.comment .comment-footer {
    display: table;
    width: 100%
}

.comment .comment-footer>.column {
    display: table-cell;
    vertical-align: middle
}

.comment .comment-footer>.column:last-child {
    text-align: right
}

.comment .comment-meta {
    color: #9da9b9;
    font-size: 13px;
	display: block;
}

.comment .reply-link {
    transition: color .3s;
    color: #606975;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: .07em;
    text-transform: uppercase;
    text-decoration: none
}

.comment .reply-link>i {
    display: inline-block;
    margin-top: -3px;
    margin-right: 4px;
    vertical-align: middle
}

.comment .reply-link:hover {
    color: #0da9ef
}

.comment.comment-reply {
    margin-top: 30px;
    margin-bottom: 0
}

@media (max-width: 576px) {
    .comment {
        padding-left: 0
    }
    .comment .comment-author-ava {
        display: none
    }
    .comment .comment-body {
        padding: 15px
    }
    .comment .comment-body::before,
    .comment .comment-body::after {
        display: none
    }
}
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container padding-bottom-3x mb-2">
    <div class="row">
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
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <div class="table-responsive margin-bottom-2x">
			<?php if($f3->exists('SESSION.ticketreplied')){?>
				<p style="background: green; padding: 15px; color: #fff; font-size: 14px;">Your messsage was sucessfully sent!</p>
			<?php } ?>
			<h5>Subject: <?php echo $tickets->subject;?></h5>
                <table class="table margin-bottom-none">
                    <thead>
                        <tr>
                            <th>Date Submitted</th>
                            <th>Last Updated</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo date_format(date_create($tickets->created_at), "m/d/Y");?></td>
                            <td><?php echo date_format(date_create($tickets->updated_at), "m/d/Y");?></td>
                            <td><?php echo $tickets->category;?></td>
                            <td><span class="text-warning"><?php echo $tickets->priority;?></span></td>
                            <td><span class="text-primary"><?php echo $tickets->status;?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Messages-->
			<?php
				$img =  new DB\SQL\Mapper($f3->get('db'),'hd_user');
				while(!$tickmsg->dry()){
				$img->load(array('username=?', $tickmsg->username));
			?>
            <div class="comment">
                <div class="comment-author-ava"><img src="<?php echo $img->profileimg; ?>" alt="<?php echo $img->username; ?>"></div>
                <div class="comment-body">
                    <p class="comment-text"><?php echo $tickmsg->content; ?></p>
                    <div class="comment-footer">
					<span class="comment-meta"><?php echo ucwords($img->firstname. ' ' . $img->lastname); ?></span>
					<span class="comment-meta"><?php echo date_format(date_create($tickmsg->message_date), "m/d/Y"); ?></span>
					</div>
                </div>
            </div>
				<?php $tickmsg->next(); } ?>
            
            <!-- Reply Form-->
            <h5 class="mb-30 padding-top-1x">Leave Message</h5>
            <form action="handler.php" method="post">
                <div class="form-group">
                    <textarea class="form-control form-control-rounded" id="content" name="content" rows="8" placeholder="Write your message here..." required=""></textarea>
                </div>
                <div class="text-right">
					<input type="hidden" value="<?php echo $f3->get('POST.ticket_id'); ?>" name="ticket_id" />
                    <button class="btn btn-outline-primary" type="submit" name="replyticket">Submit Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<?php if($f3->exists('SESSION.ticketreplied')){ unset($_SESSION['ticketreplied']); } ?>
<script>(function(w, d) { w.CollectId = "6084154b34b8b76f099efb2f"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
</body>
</html>