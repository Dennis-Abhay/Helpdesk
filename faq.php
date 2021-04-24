<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>paq page - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    background:#f5f5f6;
    margin-top:20px;
}
/*Faq*/

.faq-search-wrap {
    padding: 50px 0 60px;
}

.faq-search-wrap .form-group .form-control,
.faq-search-wrap .form-group .dd-handle {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
}

.faq-search-wrap .form-group .input-group-append {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 10;
    pointer-events: none;
}

.faq-search-wrap .form-group .input-group-append .input-group-text {
    background: transparent;
    border: none;
}

.faq-search-wrap .form-group .input-group-append .input-group-text .feather-icon > svg {
    height: 18px;
    width: 18px;
}
.bg-teal-light-3 {
    background-color: #7fcdc1 !important;
}

.hk-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}

@media (min-width: 576px){
    .mt-sm-60 {
        margin-top: 60px !important;
    }
}
.mt-30 {
    margin-top: 30px !important;
}

.list-group-item.active {
    background-color: #00acf0;
    border-color: #00acf0;
}
.accordion .card .card-header.activestate {
    border-width: 1px;
}
.accordion .card .card-header {
    padding: 0;
    border-width: 0;
}
.card.card-lg .card-header, .card.card-lg .card-footer {
    padding: .9rem 1.5rem;
}
.accordion>.card .card-header {
    margin-bottom: -1px;
}
.card .card-header {
    background: transparent;
    border: none;
}
.accordion.accordion-type-2 .card .card-header > a.collapsed {
    color: #324148;
}
.accordion .card:first-of-type .card-header:first-child > a {
    border-top-left-radius: calc(.25rem - 1px);
    border-top-right-radius: calc(.25rem - 1px);
}
.accordion.accordion-type-2 .card .card-header > a {
    background: transparent;
    color: #00acf0;
    padding-left: 50px;
}
.accordion .card .card-header > a.collapsed {
    color: #324148;
    background: transparent;
}
.accordion .card .card-header > a {
    background: #00acf0;
    color: #fff;
    font-weight: 500;
    padding: .75rem 1.25rem;
    display: block;
    width: 100%;
    text-align: left;
    position: relative;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
a {
    text-decoration: none;
    color: #00acf0;
    -webkit-transition: color 0.2s ease;
    -moz-transition: color 0.2s ease;
    transition: color 0.2s ease;
}


.badge.badge-pill {
    border-radius: 50px;
}
.badge.badge-light {
    background: #eaecec;
    color: #324148;
}
.badge {
    font-weight: 500;
    border-radius: 4px;
    padding: 5px 7px;
    font-size: 72%;
    letter-spacing: 0.3px;
    vertical-align: middle;
    display: inline-block;
    text-align: center;
    text-transform: capitalize;
}
.ml-15 {
    margin-left: 15px !important;
}

.accordion.accordion-type-2 .card .card-header > a.collapsed:after {
    content: "\f158";
}

.accordion.accordion-type-2 .card .card-header > a::after {
    display: inline-block;
    font: normal normal normal 14px/1 'Ionicons';
    speak: none;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: auto;
    position: absolute;
    content: "\f176";
    font-size: 21px;
    top: 15px;
    left: 20px;
}

.mr-15 {
    margin-right: 15px !important;
}




















    </style>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.2.0/css/ionicons.min.css" integrity="sha256-F3Xeb7IIFr1QsWD113kV2JXaEbjhsfpgrKkwZFGIA4E=" crossorigin="anonymous" />

<div class="container-fluid">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12 pa-0">
            <div class="faq-search-wrap bg-teal-light-3">
                <div class="container">
                    <h1 class="display-5 text-white mb-20">Ask a question or browse by category below.</h1>
                    <div class="form-group w-100 mb-0">
                        <div class="input-group">
                            <input class="form-control form-control-lg filled-input bg-white" placeholder="Search by keywords" type="text">
                            <div class="input-group-append">
                                <span class="input-group-text"><span class="feather-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-sm-60 mt-30">
                <div class="hk-row">
                    <div class="col-xl-4">
                        <div class="card">
						<ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center">
                                    <a href="dashboard.php"><i class="ion ion-md-home mr-15"></i>Back to Dashboard</a>
                                </li>
						</ul>
                            <h6 class="card-header">
                                            Category
                                        </h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center active">
                                    <i class="ion ion-md-sunny mr-15"></i>General Questions<span class="badge badge-light badge-pill ml-15">06</span>
                                </li>
								<!--
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="ion ion-md-unlock mr-15"></i>Privacy policy<span class="badge badge-light badge-pill ml-15">14</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="ion ion-md-bookmark mr-15"></i>Terms of use<span class="badge badge-light badge-pill ml-15">10</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="ion ion-md-filing mr-15"></i>Documentation<span class="badge badge-light badge-pill ml-15">27</span>
                                </li>
								-->
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card card-lg">
                            <h3 class="card-header border-bottom-0">
                                            General Questions
                                        </h3>
                            <div class="accordion accordion-type-2 accordion-flush" id="accordion_2">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between activestate">
                                        <a role="button" data-toggle="collapse" href="#collapse_1i" aria-expanded="true">How do I contact an agent from your organization to help me buy a house at lekki?</a>
                                    </div>
                                    <div id="collapse_1i" class="collapse show" data-parent="#accordion_2" role="tabpanel">
                                        <div class="card-body pa-15"> 
											Agent who works with the organization details are listed on the homepage of the organization. 
											Please, contact Yetunde on +2348135967073

											If you need any further assistance please do not hesitate to raise a ticket.
										</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_2i" aria-expanded="false">How much do I need for a down payment for a property at Kuje abuja ?</a>
                                    </div>
                                    <div id="collapse_2i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">
											Properties available at kuje is up for sale between <br />
											65m - 70m with pool <br />
											60 - 65m without pool <br />
											<br />
											Features:<br />
											Swimming pool <br />
											Stamped concrete floors<br />
											All room en-suite<br />
											Jacuzzi<br />
											Pop Ceilings <br />
											Car port<br />
											Inbuilt surround speakers <br />
											Fitted kitchen <br />
											Family lounge <br />
											Maids room <br />
											Central security <br />

											For enquiries and inspection kindly call our agent at kuje on +2348062877625<br />

											Installment payment of 10m will be accepted with payment spread within one year(terms and conditions applied).
										</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_3i" aria-expanded="false">Do you have a 3 bedroom semi detached duplex up for sale at Lokogoma?</a>
                                    </div>
                                    <div id="collapse_3i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">
											Yes <br />
											Price for property is 45m<br />
											First payment of 16m is allowed with remaining spread within one year(terms and condition applied)<br />

											For inspection and enquiries <br />
											Kindly raise a ticket or call Fatima on +234797157360<br />

											Features <br />
											Interlocked floors <br />
											All room en-suite <br />
											Security house <br />
											Pop ceilings <br />
											Fitted kitchen <br />
											Family lounge <br />
											Water heater<br />
										</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_4i" aria-expanded="false">When will you be available for enquiries ?</a>
                                    </div>
                                    <div id="collapse_4i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">
										
										Want to pull a complain to your manager about one of your agents <br />
										We are sorry for the inconvenience any of our agents may have caused you. We sincerely apologize on their behalf. However, you can call the management anytime from Monday - Friday 8am - 6pm WAT<br />

										Phone number  <br />
										+2348134015256 <br />
									</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_5i" aria-expanded="false">Do you have a four bedroom terrace duplex up for sales anywhere in Lagos?</a>
                                    </div>
                                    <div id="collapse_5i" class="collapse" data-parent="#accordion_2">
                                        <div class="card-body pa-15">
											Yes<br />
											We have one available at Ajah<br />
											Please contact agent Sam on +2348062571345 for enquiries and Inspection<br />
										</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>(function(w, d) { w.CollectId = "6084154b34b8b76f099efb2f"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
</body>
</html>