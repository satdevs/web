<?php 
	if(!isset($title)){$title="Hiányzó cím!";}
	$this->assign('title', $title);
	if(!isset($admin)){$admin=false;}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sághy-Sat | <?= $this->fetch('title'); ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"><!-- Tell the browser to be responsive to screen width -->
	<link rel="stylesheet" href="/css/admin/bootstrap.min.css"><!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"><!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"><!-- Ionicons -->
	<link rel="stylesheet" href="/css/admin/AdminLTE.min.css"><!-- Theme style -->
	<link rel="stylesheet" href="/css/admin/admin.css"><!-- saját -->
	<link rel="stylesheet" href="/plugins/iCheck/flat/blue.css"><!-- iCheck -->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page">

	<!-- ----------------- FLASH -------------------  -->
	<?= $this->Flash->render() ?>
	<?= $this->Flash->render('auth') ?>
	<!-- ----------------- /FLASH -------------------  -->
	<!-- ----------------- CONTENT -------------------  -->
	<?= $this->fetch('content') ?>
	<!-- ----------------- /CONTENT -------------------  -->

	<script src="/js/admin/jQuery-2.2.0.min.js"></script><!-- jQuery 2.2.0 -->
	<script src="/js/admin/bootstrap.min.js"></script><!-- Bootstrap 3.3.6 -->
	<script src="/plugins/iCheck/icheck.min.js"></script><!-- iCheck -->
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		});
	</script>
</body>
</html>
