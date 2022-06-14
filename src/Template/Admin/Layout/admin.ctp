<?php
	if(!isset($title)){$title="Hiányzó cím!";}
	$this->assign('title', $title);
	if(!isset($admin)){$admin=false;}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin | <?= $this->fetch('title') ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="/css/admin/bootstrap.min.css"><!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"><!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"><!-- Ionicons -->
	<link rel="stylesheet" href="/css/admin/AdminLTE.min.css"><!-- Theme style -->

	<link rel="stylesheet" href="/css/admin/skins/skin-blue.min.css">
	<link rel="stylesheet" href="/css/bootstrap-select.min.css"><!-- Bootstrap SELECT -->
	<link rel="stylesheet" href="/css/admin/admin.css">
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker-bs3.css"><!-- daterange picker -->
	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css"><!-- bootstrap datepicker -->
	<link rel="stylesheet" href="/plugins/iCheck/my/blue.css"><!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.min.css"><!-- Bootstrap time Picker -->
	<!--link rel="stylesheet" href="/plugins/select2/select2.min.css"--><!-- Select2 -->



</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>Admin</b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Sághy-Sat</b> admin</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<?= $this->cell('Messages'); ?>

					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="/images/uploads/users/<?= $this->request->session()->read('Auth.User.id'); ?>.<?= $this->request->session()->read('Auth.User.avatar_ext'); ?>" class="user-image" alt="<?= $this->request->session()->read('Auth.User.name'); ?>">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">
							<?= $this->request->session()->read('Auth.User.name'); ?>
							</span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="/images/uploads/users/<?= $this->request->session()->read('Auth.User.id'); ?>.<?= $this->request->session()->read('Auth.User.avatar_ext'); ?>" class="img-circle" alt="<?= $this->request->session()->read('Auth.User.name'); ?>">
								<p>
									<?= $this->request->session()->read('Auth.User.name'); ?>
									<small><?= $this->Time->format( $this->request->session()->read('Auth.User.created'), 'yyyy.MM.dd. HH:mm:ss', null ); ?> óta</small>
								</p>
							</li>

							<!-- Menu Body -->
							<!--li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Követők</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Barátok</a>
									</div>
								</div>
							</li--><!-- /.row -->

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="<?php if($admin){echo "/admin";} ?>/profil" class="btn btn-default btn-flat">Profil</a>
								</div>
								<div class="pull-left" style="margin-left: 5px;">
									<a href="<?php if($admin){echo "/admin";} ?>/changepassword" class="btn btn-default btn-flat">Jelszó csere</a>
								</div>
								<div class="pull-right">
									<a href="<?php if($admin){echo "/admin";} ?>/users/logout" class="btn btn-default btn-flat">Kilépés</a>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<!--li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li-->
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="/img/avatars/zsolt.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p>Varga Zsolt</p>
					<!-- Status -->
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>

			<!-- search form (Optional) -->
			<!--form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
				</div>
			</form-->
			<!-- /.search form -->

<!--
----------------------------------------------------------------------------------------------------------------------------------
														Sidebar Menu
----------------------------------------------------------------------------------------------------------------------------------
-->
			<ul class="sidebar-menu">
<?php /*
				<li class="header">Érdeklődések</li>
				<li<?php $menutitle="Érdeklődések (Interests)"; $ctrlr="interests"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<!-- li<?php $menutitle="Érdeklődés tételek (Interestdetails)"; $ctrlr="interestdetails"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li -->
*/ ?>

				<li<?php $menutitle="PDF számla igények"; $ctrlr="Pdfinvoices"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-envelope-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Int.E.1000 igények"; $ctrlr="Internetextras"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-envelope-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Üzenetek"; $ctrlr="Messages"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-envelope-o"></i> <span><?= $menutitle ?></span></a></li>


				<li class="header">Napi karbantartás</li>

				<!-- Optionally, you can add icons to the links -->


				<li<?php $menutitle="Cikkek"; $ctrlr="Posts"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Cikk kategóriák"; $ctrlr="Postcategories"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Cikkek fotók"; $ctrlr="Postimages"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-photo"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Cimke felhő"; $ctrlr="Labels"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Feltöltések"; $ctrlr="Uploads"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-o"></i> <span><?= $menutitle ?></span></a></li>

				<li class="header">Törzsadatok</li>
				<li<?php $menutitle="Termékek"; $ctrlr="Newproducts"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Channels MŰSOROK"; $ctrlr="ch_programs"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-o"></i> <span><?= $menutitle ?></span></a></li>

<?php /*
				<!--li<?php $menutitle="Érdeklődések"; $ctrlr="Baskets"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-o"></i> <span><?= $menutitle ?></span></a></li-->
				<li class="header">Szolgáltatások</li>
				<li<?php $menutitle="Termékek WEB-re (ProductDescs)"; $ctrlr="szla_product_descs"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Switch függőségek (ProductDepends)"; $ctrlr="szla_product_depends"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
*/ ?>
<?php /*
				<li<?php $menutitle="Népsz.terméklekérd."; $ctrlr="Populars"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-o"></i> <span><?= $menutitle ?></span></a></li>

				<li class="header">Külső adatbázisok</li>
				<!--li<?php $menutitle="Termékek árral"; $ctrlr="szla_products"; if($ctrlr == $this->request->controller){//echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>/products_prices"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li-->
				<li<?php $menutitle="Települések (SzlaCities)"; $ctrlr="szla_cities"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>WinSzla_WEB</span> <i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul style="display: none;" class="treeview-menu">
						<li<?php $menutitle="Termékek WEB-re (Prod.Des..)"; $ctrlr="szla_product_descs"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Települések (Cities)"; $ctrlr="szla_cities"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Termékek (Products)"; $ctrlr="szla_products"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Akciók (Akcios)"; $ctrlr="szla_akcios"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li class="header">---------</li>
						<li<?php $menutitle="Fejállomások (Headstations)"; $ctrlr="szla_headstations"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Előfizetők (Subs)"; $ctrlr="szla_subs"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>Csatornák (Channels)</span> <i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul style="display: none;" class="treeview-menu">
						<li<?php $menutitle="Települések (SzlaCities)"; $ctrlr="szla_cities"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Csomag műsorai (Pack..Prog..)"; $ctrlr="ch_packages_programs"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Csomagok (Packages)"; $ctrlr="ch_packages"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Műsorok (Programs)"; $ctrlr="ch_programs"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Műsor fajták (Features)"; $ctrlr="ch_features"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Frekvenciák (Bands)"; $ctrlr="ch_bands"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Tulajdonosok (Owners)"; $ctrlr="ch_owners"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
					</ul>
				</li>


				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>NetAdmin</span> <i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul style="display: none;" class="treeview-menu">
						<li<?php $menutitle="DHCP (DhcpLeasesLast)"; $ctrlr="na_dhcp_leases_last"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
						<li<?php $menutitle="Előfizetők (Subscribers)"; $ctrlr="na_subscribers"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
					</ul>
				</li>


				<li class="header">Képek</li>
				<li<?php $menutitle="Galéria"; $ctrlr="Galleries"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-photo"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Fotók"; $ctrlr="Photos"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-photo"></i> <span><?= $menutitle ?></span></a></li>

				<li class="header">Rendszer</li>
*/ ?>
				<!--li<?php $menutitle="Felhaszn. csoportok"; $ctrlr="Groups"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-users"></i> <span><?= $menutitle ?></span></a></li-->
				<li<?php $menutitle="Felhasználók"; $ctrlr="Users"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-user"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Üzenet témák"; $ctrlr="Messagethemes"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-envelope-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Szövegek"; $ctrlr="Texts"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>"><i class="fa fa-fw fa-file-text-o"></i> <span><?= $menutitle ?></span></a></li>
				<li<?php $menutitle="Oldal alapadatok"; $ctrlr="Abouts"; if($ctrlr == $this->request->controller){echo ' class="active"';} ?>><a href="<?php if($admin){echo "/admin";} ?>/<?= strtolower( $ctrlr ); ?>/edit/1"><i class="fa fa-fw fa-cog"></i> <span><?= $menutitle ?></span></a></li>



			</ul><!-- /.sidebar-menu -->
<!--
----------------------------------------------------------------------------------------------------------------------------------
													/.Sidebar Menu
----------------------------------------------------------------------------------------------------------------------------------
-->

		</section><!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1><?= $this->fetch('title') ?></h1>

			<ol class="breadcrumb">
				<li><a href="<?php if($admin){echo "/admin";}else{echo "/";}?>"><i class="fa fa-dashboard"></i> Kezdőlap</a></li>

<?php if( $this->request->action == 'index' ) {?>
				<li class="active"><?= $this->fetch('title') ?></li>
<?php }else{ ?>
				<li><a href="<?php if($admin){echo "/admin";}?>/<?= strtolower($this->request->controller) ?>"><?= $this->fetch('title') ?></a></li>
<?php } ?>

<?php if( $this->request->action == 'add' ) {?>
				<li class="active">Új felvitele</li>
<?php } ?>
<?php if( $this->request->action == 'edit' ) {?>
				<li class="active">Módosítás</li>
<?php } ?>
<?php if( $this->request->action == 'view' ) {?>
				<li class="active">Adatlap megtekintése</li>
<?php } ?>

			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- --------------------- FLASH    ------------------- -->
			<?= $this->Flash->render() ?>
			<?= $this->Flash->render('auth') ?>
			<!-- --------------------- CONTENT  ------------------- -->
			<?= $this->fetch('content') ?>
			<!-- --------------------- /CONTENT ------------------- -->
		</section>
		<!-- /.Main content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Created By - Zsolt
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2016 <a href="http://saghysat.hu">Sághy-Sat Kft.</a>.</strong> Minden jog fenntartva.
	</footer>

<?php /*
	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane active" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Recent Activity</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript::;">
							<i class="menu-icon fa fa-birthday-cake bg-red"></i>

							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

								<p>Will be 23 on April 24th</p>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

				<h3 class="control-sidebar-heading">Tasks Progress</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript::;">
							<h4 class="control-sidebar-subheading">
								Custom Template Design
								<span class="label label-danger pull-right">70%</span>
							</h4>

							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

			</div>
			<!-- /.tab-pane -->
			<!-- Stats tab content -->
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<!-- /.tab-pane -->
			<!-- Settings tab content -->
			<div class="tab-pane" id="control-sidebar-settings-tab">
				<form method="post">
					<h3 class="control-sidebar-heading">General Settings</h3>

					<div class="form-group">
						<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked>
						</label>

						<p>
							Some information about this general settings option
						</p>
					</div>
					<!-- /.form-group -->
				</form>
			</div>
			<!-- /.tab-pane -->
		</div>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
			 immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
*/ ?>

	<!-- REQUIRED JS SCRIPTS -->
	<script src="/js/admin/jQuery-2.2.0.min.js"></script><!-- jQuery 2.2.0 -->
	<script src="/js/admin/bootstrap.min.js"></script><!-- Bootstrap 3.3.6 -->
	<script src="/js/bootstrap-select.min.js"></script><!-- Bootstrap SELECT -->
	<script src="/js/admin/app.min.js"></script><!-- AdminLTE App -->
<?php if(($this->request->params['controller'] == 'Newproducts' || $this->request->params['controller'] == 'SzlaProductDescs' || $this->request->params['controller'] == 'Texts' || $this->request->params['controller'] == 'Posts') && ($this->request->params['action'] == 'edit' || $this->request->params['action'] == 'add')){ ?>
	<script src="/js/admin/tinymce/tinymce.min.js"></script><!-- TinyMCE App -->
	<script>
		$(document).ready( function(){
			tinymce.init({
				selector: '.tinymce',
				height: 400,
				entity_encoding : "raw",
				plugins: [
					'advlist autolink lists link image imagetools charmap print preview anchor textcolor emoticons textpattern',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste code hr'
				],
				imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
				toolbar: 'undo redo | formatselect | bold italic underline strikethrough superscript subscript | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media hr | removeformat | code',

/*
				plugins: "textcolor hr link image spellchecker emoticons charmap preview code textpattern table print contextmenu insertdatetime",
				toolbar: [
					"undo redo bold italic underline strikethrough subscript superscript | alignleft aligncenter alignright alignjustify | forecolor backcolor | charmap | code removeformat",
					"styleselect formatselect | bullist numlist table hr link"
				]
*/

				content_css: [
					'/css/admin/bootstrap.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
					'/css/admin/AdminLTE.min.css',
					'/css/admin/skins/skin-blue.min.css',
					'/css/admin/admin.css'
					// '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
					// '//www.tinymce.com/css/codepen.min.css'
				],
				language: 'hu_HU',
				menu: {
					edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
					table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
				},
<?php //if(($this->request->params['controller'] == 'Texts' || $this->request->params['controller'] == 'Posts') && ($this->request->params['action'] == 'edit' || $this->request->params['action'] == 'add')){ ?>
	<?php
	if(isset($postimages)){
		$i=0;
		echo "\t\t\timage_list: [\n";
		$count=0;
		foreach ($postimages as $postimage):
			$count++;
		endforeach;

		foreach ($postimages as $postimage):
?>
                    {title: '<?= $postimage->title ?>', value: '/images/uploads/postimages/<?= $postimage->id ?>_big.jpg', height: "200px"}<?php

		if($i++<($count-1)){
			echo ",\n";
		}else{
			echo "\n";
		}
		endforeach;
		echo"],\n";
	}
// } //2. if
?>

			image_advtab : true,

			});

			//Ha a text mezőbe illesztett kép lebegtetve van, akkor ellenkező oldalra margó 10px
			if( $(".box-info img").css('float')=='left' ){
				$(".box-info img").css('marginRight', '10px');
			}
			if( $(".box-info img").css('float')=='right' ){
				$(".box-info img").css('marginLeft', '10px');
			}

			$(".box-info img").click( function(){
				alert('Klikkeltés');
			});


		});	//jQuery

	</script>
<?php } //if Posts || Texts ?>
	<script src="/plugins/select2/select2.full.min.js"></script><!-- Select2 -->
	<script src="/plugins/input-mask/jquery.inputmask.js"></script><!-- InputMask -->
	<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script><!-- bootstrap time picker -->
	<script src="/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script><!-- bootstrap datepicker -->

	<script src="/plugins/iCheck/icheck.min.js"></script><!-- iCheck 1.0.1 -->
	<script>
	$(document).ready(function(){
		//-- CheckBox design --
		$('input').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});

<?php if($this->request->params['controller'] == 'ChPackagesPrograms' && ($this->request->params['action'] == 'add' || $this->request->params['action'] == 'edit') ){ ?>
		//-- Csatornák kezeléséhez. Az analóg/Digitális választása esetén a megflelő mezők elrejtése/megjelenítése --
		$("#PackagesProgramLcn").select();	//Az autofocus mező tartalma "0" kijelölése a beíráshoz...
		if( $("#PackagesProgramBroadcast").val()=='Analóg' ){
			$('.analog').show();
			$('.digitalis').hide();
		}
		if( $("#PackagesProgramBroadcast").val()=='Digitális' ){
			$('.analog').hide();
			$('.digitalis').show();
		}
		$("#PackagesProgramBroadcast").change( function(){
			if( $(this).val()=='Analóg' ){
				$('.analog').fadeIn(500);
				$('.digitalis').fadeOut(500);
			}
			if( $(this).val()=='Digitális' ){
				$('.analog').fadeOut(500);
				$('.digitalis').fadeIn(500);
			}
		});
<?php } ?>

		//-- Soronkövetkező jQ ...
		//...

	});
	</script>


<?php if($this->request->params['controller'] == 'Postimages' && $this->request->params['action'] == 'index'){ ?>
	<script>
		$(document).ready( function(){
			$("input[name=postimage-title]:first").focus( function(){
				$(this).select();
			});

			$(".eye").click( function(){
		        var data = {};
		        var id 		= $(this).attr("eye-id");
		        data['id'] 	= id;
		        //data['title'] 	= $(this).val();
				$.ajax({
					type: "POST",
					cache: false,
					dataType: 'json',
					//contentType: "application/json; charset=utf-8",
					url: "/admin/postimages/ajaxchangecurrent",
					data: JSON.stringify(data),
					success: function(result){
						if(result == 1){
							$("[eye-icon-id='"+id+"']").css('color','green');
							$("[eye-id='"+id+"']").attr('title','Látható a szöveg szerkesztésekor');
						}else{
							$("[eye-icon-id='"+id+"']").css('color','red');
							$("[eye-id='"+id+"']").attr('title','NEM látható a szöveg szerkesztésekor');
						}
					}
				});
			});

			$("input[name=postimage-title]").blur( function(){
		        var data = {};
		        data['id'] 		= $(this).attr("title-id");
		        data['title'] 	= $(this).val();
				$.ajax({
					type: "POST",
					cache: false,
					dataType: 'json',
					//contentType: "application/json; charset=utf-8",
					url: "/admin/postimages/ajaxupdatetitle",
					data: JSON.stringify(data),
					success: function(result){
						//console.log( 'Result:' );
						//console.log( result );
					},
				})
				/*
			    .done( function( data ) {
			        console.log('Done:');
			        //console.log( data );
			    })
			    .fail(function( data ) {
			    	console.log('Fail:');
			        //console.log( data );
			    });
				*/

			});
		});
	</script>
<?php } ?>


</body>
</html>

