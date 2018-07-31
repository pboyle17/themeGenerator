<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="http://cdn.dealereprocess.org/cdn/img/favicon.ico">
<title><?php echo $shell->title; ?></title>

<?php 
$shell->meta(); //output meta data
$page->assets(); //output css and js
$shell->google_analytics();
?>

<!--<link rel="stylesheet" type="text/css" href="<?php //echo $page->assets_local; ?>css/srp-redesign.css" />-->

<link rel="stylesheet" type="text/css" href="<?php echo $this->SiteModel->url_cdn; ?>css/media_queries.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $page->assets_local; ?>css/header.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $page->assets_local; ?>css/footer.css" />

</head>

<?php $page->buffer_flush(); //start sending data to the browser ?>
<body id="<?php echo (($page->flag_global)?'':'custom_').'page_'.$page->page_id; ?>">
	<div id="container">
		<!-- Load Header (/php/header.php) -->
		<!-- Module ID: 58 -->
		<!-- Arguments: {"filename":"header","local":true} -->
		<?php $components->local_instruction_run(719, 1); ?>
		<div id="content">
			<?php
				$components->run(); // run the instructions for the page
			?>
			<br class="fl_c" />
		</div>
	
		<!-- Load Footer (/php/footer.php) -->
		<!-- Module ID: 58 -->
		<!-- Arguments: {"filename":"footer","local":true} -->
		<?php $components->local_instruction_run(720, 1); ?>
		<br class="fl_c" />
	</div>	
<?php 
	//$shell->toolbar(); //output the toolbar (if active)
	$page->finale(); //handle any page ending output (js_snippets)
?>



</body>
</html>
