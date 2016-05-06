<div class="header">
    <div class="screen"></div>
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
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="/">New Trades</a></li>
                </ul>
                <div class="nav navbar-nav navbar-right">
                    <?php if ($session->check()) { ?>
                    	<span class="navbar-text">
                    		Welcome, <a class="b u" href="<?=$router->generateUrl('farmer:edit_self')?>"><?=$session->getUser()->getUsername()?></a>
                    	</span>
                        <a class="btn navbar-btn btn-default" href="<?=$router->generateUrl('logout')?>">LOGOUT</a>
                    <?php } else { ?>
	                    <div class="btn-group">
	                        <a class="btn navbar-btn btn-success" href="<?=$router->generateUrl('register')?>">REGISTER</a>
	                        <a class="btn navbar-btn btn-success" href="<?=$router->generateUrl('login')?>">LOGIN</a>
	                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>