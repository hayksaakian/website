<?
namespace Destiny;
use Destiny\Utils\Tpl;
use Destiny\Utils\Date;
use Destiny\Session;
?>
<!DOCTYPE html>
<html>
<head>
<title><?=Tpl::title($model->title)?></title>
<meta charset="utf-8">
<meta name="description" content="<?=Config::$a['meta']['description']?>">
<meta name="keywords" content="<?=Config::$a['meta']['keywords']?>">
<meta name="author" content="<?=Config::$a['meta']['author']?>">
<link href="<?=Config::cdn()?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?=Config::cdn()?>/css/destiny.<?=Config::version()?>.css" rel="stylesheet" media="screen">
<link rel="shortcut icon" href="<?=Config::cdn()?>/favicon.png">
<?include'./tpl/seg/google.tracker.php'?>
</head>
<body id="authentication" class="profile">

	<?include'./tpl/seg/top.php'?>
	
	<section class="container">
		<h1 class="page-title">
			Profile 
			<small><a><?=Tpl::out($model->user['username'])?></a></small>
		</h1>
		
		<div style="margin:20px 0 10px 0;" class="navbar navbar-inverse navbar-subnav">
			<div class="navbar-inner">
				<ul class="nav">
					<li><a href="/profile" title="Your personal details">Details</a></li>
					<?php if(Session::hasRole(\Destiny\UserRole::ADMIN)): ?>
					<li><a href="/profile/subscription" title="Your subscriptions">Subscription</a></li>
					<?php endif; ?>
					<li class="active"><a href="/profile/authentication" title="Your login methods">Authentication</a></li>
				</ul>
			</div>
		</div>
		<div class="tab-content">
			<div class="tab-pane active clearfix">
			
			<h3>Authentication</h3>
			<div class="content content-dark clearfix">
				<div style="width: 100%;" class="clearfix stream">
					
					<form action="/login" method="post">
						<input type="hidden" id="inputAuthProvider" name="authProvider" value="" />
						<input type="hidden" id="inputAccountMerge" name="accountMerge" value="1" />
						<table class="grid" style="width:100%">
							<thead>
								<td>Profile</td>
								<td>Status</td>
							</thead>
							<tbody>
								<?php foreach(Config::$a ['authProfiles'] as $profileType): ?>
								<tr>
									<td>
										<i class="icon-<?=$profileType?>"></i> <?=ucwords($profileType)?>
									</td>
									<td style="width:100%;">
										<?php if(in_array($profileType, $model->authProfileTypes)): ?>
										<?php $model->requireConnections = true; ?>
										<span class="subtle"><i class="icon-ok icon-white"></i> Connected</span>
										<?php else: ?>
										<a onclick="$('#inputAuthProvider').val('<?=$profileType?>'); $(this).closest('form').submit(); return false;" href="/login"><i class="icon-heart icon-white subtle"></i> Connect</a>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</form>
					
					<?php if($model->requireConnections): ?>
					<div class="control-group">
						<p><span class="label label-inverse">Important!</span> Connecting profiles will merge destiny.gg accounts if duplicates are found.</p>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
			<br>
			
			</div>
		</div>
	</section>
	
	<?include'./tpl/seg/foot.php'?>
	
	<script src="<?=Config::cdn()?>/js/vendor/jquery-1.9.1.min.js"></script>
	<script src="<?=Config::cdn()?>/js/vendor/jquery.cookie.js"></script>
	<script src="<?=Config::cdn()?>/js/vendor/bootstrap.js"></script>
	<script src="<?=Config::cdn()?>/js/vendor/moment.js"></script>
	<script src="<?=Config::cdn()?>/js/destiny.<?=Config::version()?>.js"></script>
	<script>destiny.init({cdn:'<?=Config::cdn()?>'});</script>
</body>
</html>