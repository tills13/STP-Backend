<div class="header">
    <div class="screen"></div>
    <div class="hero row-fluid">
    	<h2 class="spinner row">
    		<div class="words col-md-6 col-sm-6">
    			<b style="display: inline-block;">Empowering</b>
    			<b>Connecting</b>
    			<b>Helping</b>
    		</div>
    		<div class="col-md-6 col-sm-6">Farmers</div>
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
                <div class="nav navbar-nav navbar-right">
                    <?php if ($session->check()) { ?>
                    	<span class="navbar-text">
                    		Welcome, <a class="b u" href="<?=$router->generateUrl('farmer:edit_self')?>"><?=$session->getUser()->getUsername()?></a>
                            <span class="label label-primary label-lg"><?=$session->getUser()->getGold(true)?><span class="gold">G</span></span>
                    	</span>
                        <a class="btn navbar-btn btn-default" href="<?=$router->generateUrl('logout')?>">Logout</a>
                    <?php } else { ?>
	                    <div class="btn-group">
	                        <a class="btn navbar-btn" href="<?=$router->generateUrl('register')?>">Register</a>
	                        <a class="btn navbar-btn" href="<?=$router->generateUrl('login')?>">Login</a>
	                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>