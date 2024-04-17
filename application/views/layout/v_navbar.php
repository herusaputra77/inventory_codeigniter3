<body>

	<!-- Begin page -->
	<div id="wrapper">

		<!-- Top Bar Start -->
		<div class="topbar">

			<!-- LOGO -->
			<div class="topbar-left">
				<a href="index.html" class="logo">
					<span class="logo-light">
						<i class="mdi mdi-camera-control"></i> Sistem User
					</span>
					<span class="logo-sm">
						<i class="mdi mdi-camera-control"></i>
					</span>
				</a>
			</div>

			<nav class="navbar-custom">
				<ul class="navbar-right list-inline float-right mb-0">

					<!-- language-->
					<!-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?= base_url() ?>assets/template/images/flags/us_flag.jpg" class="mr-2" height="12" alt=""/> English <span class="mdi mdi-chevron-down"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                        <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/template/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                        <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/template/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                        <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/template/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                        <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/template/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                        <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/template/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                    </div>
                </li> -->

					<!-- full screen -->
					<li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
						<a class="nav-link waves-effect" href="#" id="btn-fullscreen">
							<i class="mdi mdi-arrow-expand-all noti-icon"></i>
						</a>
					</li>

					<!-- notification -->
					<li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
						<h5><?= ($this->session->userdata('role_id') ==  1) ? 'Admin' : 'Member' ?></h5>
					</li>


					<li class="dropdown notification-list list-inline-item">
						<div class="dropdown notification-list nav-pro-img">
							<a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#"
								role="button" aria-haspopup="false" aria-expanded="false">
								<img src="<?= base_url() ?>assets/template/images/users/user-4.jpg" alt="user"
									class="rounded-circle">
							</a>
							<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
								<!-- item-->
								<?php if ($this->session->userdata('role_id') == 1) { ?>
								<a class="dropdown-item" href="<?= base_url('admin/user/profile') ?>"><i
										class="mdi mdi-account-circle"></i> Profile</a>
								<?php } else { ?>
								<a class="dropdown-item" href="<?= base_url('user/user/profile') ?>"><i
										class="mdi mdi-account-circle"></i> Profile</a>
								<?php } ?>
								<a class="dropdown-item text-danger" href="<?= base_url('welcome/logout') ?>"><i
										class="mdi mdi-power text-danger"></i> Logout</a>
							</div>
						</div>
					</li>

				</ul>

				<ul class="list-inline menu-left mb-0">
					<li class="float-left">
						<button class="button-menu-mobile open-left waves-effect">
							<i class="mdi mdi-menu"></i>
						</button>
					</li>
					<li class="d-none d-md-inline-block">
						<form role="search" class="app-search">
							<div class="form-group mb-0">
								<input type="text" class="form-control" placeholder="Search..">
								<button type="submit"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
				</ul>

			</nav>

		</div>
		<!-- Top Bar End -->

		<!-- ========== Left Sidebar Start ========== -->
		<div class="left side-menu">
			<div class="slimscroll-menu" id="remove-scroll">

				<!--- Sidemenu -->
				<div id="sidebar-menu">
					<!-- Left Menu Start -->
					<ul class="metismenu" id="side-menu">
						<li class="menu-title">Menu</li>
						<?php if ($this->session->userdata('role_id') == 1) { ?>

						<li>
							<a href="<?= base_url('admin/adminberanda') ?>" class="waves-effect">
								<i class="icon-accelerator"></i> <span> Dashboard </span>
							</a>
						</li>
						<li>
							<a href="<?= base_url('admin/barang') ?>" class="waves-effect">
								<i class="icon-happy-drop"></i> <span> Barang </span>
							</a>
						</li>
						<li>
							<a href="<?= base_url('admin/user') ?>" class="waves-effect">
								<i class="icon-key"></i> <span> User </span>
							</a>
						</li>
						<li>
							<a href="<?= base_url('admin/stok') ?>" class="waves-effect">
								<i class="icon-happy-drop"></i> <span> Stok </span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span>
									Transaksi <span class="float-right menu-arrow"><i
											class="mdi mdi-chevron-right"></i></span> </span></a>
							<ul class="submenu">
								<li><a href="<?= base_url('admin/BarangMasuk')?>">Barang Masuk</a></li>
								<li><a href="<?= base_url('admin/BarangKeluar')?>">Barang Keluar</a></li>
							</ul>
						</li>

						<li>
							<a href="javascript:void(0);" class="waves-effect"><i
									class="icon-paper-sheet"></i><span>Laporan Transaksi <span
										class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
								</span></a>
							<ul class="submenu">
								<li><a href="<?= base_url('admin/LaporanStok')?>">Laporan Stok Akhir</a></li>
								<li><a href="<?= base_url('admin/ClosingBulanan')?>">Closingan Bulanan</a></li>
							</ul>
						</li>


						<?php } else { ?>

						<li>
							<a href="<?= base_url('user/userberanda') ?>" class="waves-effect">
								<i class="icon-accelerator"></i> <span> Dashboard </span>
							</a>
						</li>
						<li>
							<a href="<?= base_url('user/user') ?>" class="waves-effect">
								<i class="icon-happy-drop"></i> <span> User </span>
							</a>
						</li>
						<li>
							<a href="<?= base_url('user/barang') ?>" class="waves-effect">
								<i class="icon-happy-drop"></i> <span> Barang </span>
							</a>
						</li>
						<?php } ?>


						<!-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> Email <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="email-inbox.html">Inbox</a></li>
                                <li><a href="email-read.html">Email Read</a></li>
                                <li><a href="email-compose.html">Email Compose</a></li>
                            </ul>
                        </li> -->

					</ul>

				</div>
				<!-- Sidebar -->
				<div class="clearfix"></div>

			</div>
			<!-- Sidebar -left -->

		</div>
		<!-- Left Sidebar End -->

		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<!-- ============================================================== -->
		<div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="container-fluid">
					<div class="page-title-box">
						<div class="row align-items-center">
							<div class="col-sm-6">
								<h4 class="page-title"><?= $judul ?></h4>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-right">

									<li class="breadcrumb-item active"><?= $judul ?></li>
								</ol>
							</div>
						</div> <!-- end row -->
					</div>
					<!-- end page-title -->
