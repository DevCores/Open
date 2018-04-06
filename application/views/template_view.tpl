<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- META SECTION -->
    <title>{PROJECT} - Личный кабинет.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <!-- END META SECTION -->
    <link href="/css/theme-blue.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/jquery.json.js"></script>
    <script type="text/javascript" src="http://wowroad.info/power.js"></script>
    <script>var wowroad_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
</head>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a href="/">{PROJECT}</a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                <div class="profile">
                    <div class="profile-data">
                        <div class="profile-data-name">{USERNAME}</div>
                        <div class="profile-data-title">{TITLE}</div>
                    </div>
                </div>
            </li>
            <li class="xn-title">{MENU}</li>
            <?php
            if ($data['level'] == 1) { ?>
                <li class="xn-openable">
                <a href="#"><span class="fa fa-group"></span> <span class="xn-text">{ADMINPANELMENU}</span></a>
                <ul>
                    <li><a href="/panel/index"><span class="fa fa-user"></span> {INDEXPANELMENU}</a></li>
                    <li><a href="/panel/add_bonus"><span class="fa fa-user"></span> {ADDBONUSMENU}</a></li>
                </ul>
            </li>
          <?php   } ?>
            <li>
                <a href="/"><span class="fa fa-home"></span> <span class="xn-text">{MAINMENU}</span></a>
            </li>
            <li>
               <a href="/auth/vip/"><span class="fa fa-dollar"></span> <span class="xn-text">Купить VIP</span></a>
            </li>
            <li>
                <a href="/auth/pay/"><span class="fa fa-dollar"></span> <span class="xn-text">{PAYMENU}</span></a>
            </li>
            <li>
                <a href="/ref/"><span class="fa fa-group"></span> <span class="xn-text">{REFMENU}</span></a>
            </li>
            <li>
                <a href="/auth/get_bonuses"><span class="fa fa-star"></span> <span
                            class="xn-text">Ввести промокод</span></a>
            </li>
            <li class="xn-openable">
                <a href="#"><span class="fa fa-group"></span> <span class="xn-text">{CHARACTERSMENU}</span></a>
                <ul>
                    <li><a href="/auth/change_char"><span class="fa fa-user"></span> {CHANGECHARMENU}</a></li>
                    <li><a href="/auth/change_race"><span class="fa fa-exchange"></span> {CHANGERACEMENU}</a></li>
                    <li><a href="/auth/change_fraction"><span class="fa fa-exchange"></span> {CHANGEFRACTIONMENU}</a></li>
                    <li><a href="/auth/tele"><span class="fa fa-globe"></span>{TELECHARHOME}</a></li>
                    <li><a href="/auth/change_genged"><span class="fa fa-magic"></span> {CHANGEGENGEDMENU}</a></li>
                    <li><a href="/auth/change_name"><span class="fa fa-magic"></span> {CHANGENAMEMENU}</a></li>
                </ul>
            </li>
                <ul>
                    <li><a href="/auth/levelup/"><span class="fa fa-rocket"></span> Купить Уровни</a></li>
                    <li><a href="/auth/change_char"><span class="fa fa-user"></span> {CHANGECHARMENU}</a></li>
                    <li><a href="/auth/tele"><span class="fa fa-globe"></span>{TELECHARHOME}</a></li>
                </ul>
            </li>
            <li>
                <a href="/auth/vote"><span class="fa fa-thumbs-o-up"></span> <span class="xn-text">{VOTEMENU}</span></a>
            </li>

            <li class="xn-openable">
                <a href="#"><span class="fa fa-cog fa-spin fa-3x fa-fw"></span> <span class="xn-text">{ACCOUNTMENU}</span></a>
                <ul>
                    <li><a href="/auth/binding_ip/"><span class="fa fa-pencil"></span> {BINDINGIPMENU}</a></li>
                    <li><a href="/auth/change_pass/"><span class="fa fa-pencil"></span> {CHANGEPASSMENU}</a></li>
                    <li><a href="/auth/change_mail/"><span class="fa fa-pencil"></span> {CHANGEEMAILMENU}</a></li>
                </ul>
            </li>


            <li class="xn-openable">
                <a href="#"><span class="fa fa-shopping-cart"></span> <span class="xn-text">{SHOPMENU}</span></a>
                <ul>
                    <li><a href="/auth/shop/1/1"><span class="fa fa-shield"></span> Токены</a></li>
                    <li><a href="/auth/shop/6/1"><span class="fa fa-shield"></span> PvP сеты</a></li>
                    <li><a href="/auth/shop/7/1"><span class="fa fa-male"></span> PvE нон-сеты</a></li>
                    <li><a href="/auth/shop/8/1"><span class="fa fa-male"></span> PvP нон-сеты</a></li>
                    <li><a href="/auth/shop/4/1"><span class="fa fa-legal"></span> {WEAPONMENU}</a></li>
                    <li><a href="/auth/shop/10/1"><span class="fa fa-legal"></span> Левая рука</a></li>
                    <li><a href="/auth/shop/9/1"><span class="fa fa-bookmark"></span> Спина</a></li>
                    <li><a href="/auth/shop/2/1"><span class="fa fa-asterisk"></span> Аксессуары</a></li>
                    <li><a href="/auth/shop/3/1"><span class="fa fa-paw"></span> {MAUNTSMENU}</a></li>
                    <li><a href="/auth/shop/5/1"><span class="fa fa-rocket"></span> {VERSMENU}</a></li>
                    
                </ul>
            </li>
            <li>
                <a href="/auth/buy_valut"><span class="fa  fa-gift"></span> <span class="xn-text">{BUYGOLDARENA}</span></a>
            </li>
            <li class="xn-openable">
                <a href="#"><span class="fa fa-meh-o"></span> <span class="xn-text">{HELPMENU}</span></a>
                <ul>
                    <li><a href="/auth/ticket"><span class="fa fa-heart"></span> {TICKET}</a></li>
                    <li><a href="/auth/view_ticket"><span class="fa fa-meh-o"></span> {TICKETALL}</a></li>
                </ul>
            </li>
            <li class="xn-title">{VERSION}</li>
        </ul>
        <!-- END X-NAVIGATION -->
    </div>
    <!-- END PAGE SIDEBAR -->

    <!-- PAGE CONTENT -->
    <div class="page-content page-navigation-top">
      <!-- START X-NAVIGATION VERTICAL -->
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <!-- TOGGLE NAVIGATION -->
            <!-- END TOGGLE NAVIGATION -->
          
            <!-- END SEARCH -->
            <li class="xn-icon-button pull-right">
                <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
            </li>
            <!-- MESSAGES -->
            <li class="xn-icon-button pull-right">
                <a href="#"><span class="fa fa-cog"></span></a>

                <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-cog"></span> {CHANGELANGTOP}</h3>

                        <div class="pull-right">
                            <span class="label label-danger">Testing</span>
                        </div>
                    </div>
                    <div class="panel-body list-group list-group-contacts scroll" style="height: auto;">
                        <a href="/auth/lang/ru/" class="list-group-item">
                            <span class="contacts-title">Русский</span>
                        </a>
                        <a href="/auth/lang/en" class="list-group-item">
                            <span class="contacts-title">English</span>
                        </a>

                    </div>

                </div>
            </li>
             <li class=" pull-right">
               <a class="">{CHARACTER}: {CHAR} <span class="fa fa-user"></span></a>
            </li>
            <!-- END MESSAGES -->
            <!-- SIGN OUT -->

            <!-- END SIGN OUT -->


        </ul>
        <!-- END X-NAVIGATION VERTICAL -->

        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <!-- <li><a href="#">Home</a></li>
             <li class="active">Dashboard</li> -->
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">

            <!-- START WIDGETS -->
            <div class="row">

                <div class="col-md-3">
                    
                                
                        
                                
                    <!-- START WIDGET MESSAGES -->
                    <div class="widget widget-default widget-item-icon" onclick="location.href='/auth/pay';">
                        <div class="widget-item-left">
                            <span class="fa fa-euro"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"> <?php echo $data['bonus']; ?></div>
                            <div class="widget-title">Donat points</div>
                            <div class="widget-subtitle">{PAY}</div>
                        </div>

                    </div>
                    <!-- END WIDGET MESSAGES -->

                </div>
                <div class="col-md-3">

                    <!-- START WIDGET REGISTRED -->
                    <div class="widget widget-default widget-item-icon" onclick="location.href='/auth/vote';">
                        <div class="widget-item-left">
                            <span class="fa fa-dollar"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"><?php echo $data['bonus_vp']; ?></div>
                            <div class="widget-title">Vote points</div>
                            <div class="widget-subtitle">{VOTE}</div>
                        </div>
                    </div>
                    <!-- END WIDGET REGISTRED -->

                </div>
                <div class="col-md-3">

                    <!-- START WIDGET CLOCK -->
                    <div class="widget widget-info widget-padding-sm">
                        <div class="widget-big-int plugin-clock">00:00</div>
                        <div class="widget-subtitle plugin-date">Loading...</div>

                    </div>
                    <!-- END WIDGET CLOCK -->

                </div>
            </div>
            <!-- END WIDGETS -->


            <div class="row">

                <?php
         if (!empty($data['error'])) { echo "<div class=\"alert alert-danger\"> ".$data['error']."
            </div>
            ";} elseif (!empty($data['succes'])) {echo "<div class=\"alert alert-success\">".$data['succes']."</div>";}
            $this->generateContent($content_view, $data);?>

        </div>

        <!-- START DASHBOARD CHART -->
        <div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
        <div class="block-full-width">

        </div>
        <!-- END DASHBOARD CHART -->

    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->


<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> {LOGOUT}</div>
            <div class="mb-content">
                {LOGOUTACT}
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="/auth/logout" class="btn btn-success btn-lg">{LOGOUTYES}</a>
                    <button class="btn btn-default btn-lg mb-control-close">{LOGOUTNOY}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->
<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="/js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="/js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="/js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="/js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- END THIS PAGE PLUGINS-->


<script type="text/javascript" src="/js/plugins.js"></script>
<script type="text/javascript" src="/js/actions.js"></script>

<!-- END TEMPLATE -->
<!-- END SCRIPTS -->

</body>
</html>
