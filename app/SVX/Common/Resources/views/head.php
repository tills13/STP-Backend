<head>
	<title><?=$this->embed('title', null, false)?> - SVX</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ($application->getEnvironment() !== 'local_dev') { ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    	<script src="http://underscorejs.org/underscore-min.js" type="text/javascript"></script>
	<?php } else { ?>
		<script type="text/javascript" src="<?=$router->generateUrl('javascript', ['filename' => 'jquery.min.js'])?>"></script>
    	<script type="text/javascript" src="<?=$router->generateUrl('javascript', ['filename' => 'underscore.min.js'])?>"></script>
	<?php } ?>
	
    <?=$this->sebastian()?>
</head>