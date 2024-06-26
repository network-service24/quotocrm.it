<nav  class="navbar header-navbar pcoded-header" id="header-nav">
                <div class="navbar-wrapper">

                    <div class="navbar-logo"  id="header-nav-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <div class="text-center" style="width:100%!important">  	
                            <a href="<?=BASE_URL_ADMIN?>index/">
                                <img class="img-fluid" src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo_white_border.png&w=150&h=0&a=c&q=100" alt="<?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?>" title="<?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?>"> 
                            </a>
                        </div>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen text-white"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">    
                            <li class="m-r-15 m-t-15 text-center" style="line-height:8px!important">
                                <span class="border-nav f-11">
                                    <img class="img-fluid" src="<?=BASE_URL_SITO?>img/q_border.png" style="width:32px"> <?=(NOME_SUPER_ADMIN)?>
                                </span>
                            </li>        
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <span>
                                        <?php if(AVATAR!=''){?>
                                             <img class="img-circle-small" src="<?=BASE_URL_SITO?>uploads/loghi_superuser/<?=AVATAR?>" title="<?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?>"> 
                                        <?}else{?>
                                                <i class="fa fa-user fa-fw text-white"></i>
                                        <?}?>
                                        </span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                        <li>
                                            <a href="<?=BASE_URL_ADMIN?>logout.php">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
