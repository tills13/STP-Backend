<div class="header">
    <div class="screen"></div>
    <div class="hero row-fluid">
    	<h2 class="spinner row">
    		<div class="words col-md-6 col-sm-6 col-xs-6">
    			<b style="display: inline-block;">Empowering</b>
    			<b>Connecting</b>
    			<b>Helping</b>
    		</div>
    		<div class="col-md-6 col-sm-6 col-xs-6">Farmers</div>
    	</h2>
    </div>
    <div class="center navbar navbar-fixed-bottom navbar-absolute-bottom">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#stp-navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>
            <div class="collapse navbar-collapse" id="stp-navbar">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/">Trades</a></li>
                    <li><a href="/">Exchange</a></li>
                    <li><a href="/jobs">Jobs</a></li>
                    <li><a href="/partners">Partners</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="sub-header">
    <div class="row center">
        <div class="hidden-xs col-sm-6 col-md-6">
            <?php if ($session->check()) { ?>
                Welcome, <a class="b u" href="<?=$router->generateUrl('farmer:edit_self')?>"><?=$session->getUser()->getUsername()?></a>
            <?php } ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 text-right">
            <?php if ($session->check()) { ?>
                <a class="action" href=""><i class="fa fa-user"></i></a>
                <a class="action" href="<?=$router->generateUrl('logout')?>"><i class="fa fa-sign-out"></i></a>
                <span class="gold-count"><?=$session->getUser()->getGold(true)?><span class="gold">G</span></span>
                
            <?php } else { ?>
                <a class="action" href="<?=$router->generateUrl('login')?>">Login</a>
                <a class="action" href="<?=$router->generateUrl('register')?>">Register</a>
            <?php } ?>
        </div>
    </div>
</div>