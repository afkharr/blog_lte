<!-- /*
* Template Name: Blogy
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

	<link rel="stylesheet" href="css/tiny-slider.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/glightbox.min.css">
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="css/flatpickr.min.css">


	<title>BlogLTE &mdash; List</title>
</head>

<?php
session_start();
require ('config/koneksi.php');

function blogItems()
{
	global $koneksi;
	$sql = "SELECT blog.id,blog.title, blog.thumbnail, blog.deskripsi, blog.tanggal, user.name AS user_name 
            FROM blog 
            JOIN user ON blog.user_id = user.id 
            ORDER BY blog.id DESC";
	$result = mysqli_query($koneksi, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function formatDate($date)
{
	$str = strtotime($date);
	$new_date = date("F jS, Y", $str);

	return $new_date;
}

?>

<body>

	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<nav class="site-nav">
		<div class="container">
			<div class="menu-bg-wrap">
				<div class="site-navigation">
					<div class="row g-0 align-items-center">
						<div class="col-2">
							<a href="index.php" class="logo m-0 float-start">BlogLTE<span
									class="text-primary">.</span></a>
						</div>
						<div class="col-8 text-center">
							<form action="#" class="search-form d-inline-block d-lg-none">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="bi-search"></span>
							</form>

							<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
								<li><a href="index.php">Home</a></li>
								<li class="has-children active">
									<a href="list.php">Pages</a>
									<ul class="dropdown">
										<li class="active"><a href="list.php">Blog</a></li>
									</ul>
								</li>

							</ul>
						</div>
						<div class="col-2 text-end">
							<a href="#"
								class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
								<span></span>
							</a>

							<?php if (isset($_SESSION['user'])): ?>
								<a href="logout.php"
									class="btn btn-sm btn-outline-danger mt-2 d-none d-lg-inline-block">Logout</a>
							<?php elseif (!isset($_SESSION['user'])): ?>
								<a href="login.php"
									class="btn btn-sm btn-outline-success mt-2 d-none d-lg-inline-block">Login</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<div class="section search-result-wrap">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="heading">List Pages</div>
				</div>
			</div>
			<div class="row posts-entry">
				<div class="col-lg-8">

					<?php
					foreach (blogItems() as $data):
						?>
						<div class="blog-entry d-flex blog-entry-search-item">
							<a href="article.php?id=<?= $data['id'] ?>" class="img-link me-4">
								<img src="<?= $data['thumbnail'] ?>" alt="Image" class="img-fluid">
							</a>
							<div>
								<span class="date"><?= formatDate($data['tanggal']) ?></span>
								<h2><a href="article.php?id=<?= $data['id'] ?>"><?= $data['title'] ?></a></h2>
								<p><a href="article.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-outline-primary">Read
										More</a></p>
							</div>
						</div>
					<?php endforeach; ?>


					<div class="row text-start pt-5 border-top">
						<!-- <div class="col-md-12">
							<div class="custom-pagination">
								<span>1</span>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<span>...</span>
								<a href="#">15</a>
							</div>
						</div> -->
					</div>

				</div>

				<div class="col-lg-4 sidebar">


					<!-- END sidebar-box -->
					<div class="sidebar-box">
						<h3 class="heading">Popular Posts</h3>
						<div class="post-entry-sidebar">
							<ul>
								<li>
									<a href="article.php?id=<?= blogItems()[0]['id'] ?>">
										<img src="<?= blogItems()[0]['thumbnail'] ?>" alt="Image placeholder"
											class="me-4 rounded">
										<div class="text">
											<h4><?= blogItems()[0]['title'] ?></h4>
											<div class="post-meta">
												<span class="mr-2"><?= formatDate(blogItems()[0]['tanggal']) ?> </span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="article.php?id=<?= blogItems()[1]['id'] ?>">
										<img src="<?= blogItems()[1]['thumbnail'] ?>" alt="Image placeholder"
											class="me-4 rounded">
										<div class="text">
											<h4><?= blogItems()[1]['title'] ?></h4>
											<div class="post-meta">
												<span class="mr-2"><?= formatDate(blogItems()[1]['tanggal']) ?> </span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="article.php?id=<?= blogItems()[2]['id'] ?></a>">
										<img src="<?= blogItems()[2]['thumbnail'] ?>" alt="Image placeholder"
											class="me-4 rounded">
										<div class="text">
											<h4><?= blogItems()[2]['title'] ?></h4>
											<div class="post-meta">
												<span class="mr-2"><?= formatDate(blogItems()[2]['tanggal']) ?> </span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- END sidebar-box -->


				</div>
			</div>
		</div>
	</div>

	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="widget">
						<h3 class="mb-4">About</h3>
						<p>Sesuai mottonya SMK yaitu SMK Bisa, SMK Hebat, Siap Kerja, Santun, Mandiri dan Kreatif.</p>
					</div> <!-- /.widget -->
					<div class="widget">
						<h3>Social</h3>
						<ul class="list-unstyled social">
							<li><a href="#"><span class="icon-instagram"></span></a></li>
							<li><a href="#"><span class="icon-twitter"></span></a></li>
							<li><a href="#"><span class="icon-facebook"></span></a></li>
							<li><a href="#"><span class="icon-linkedin"></span></a></li>
							<li><a href="#"><span class="icon-pinterest"></span></a></li>
							<li><a href="#"><span class="icon-dribbble"></span></a></li>
						</ul>
					</div> <!-- /.widget -->
				</div> <!-- /.col-lg-4 -->
				<div class="col-lg-4 ps-lg-5">
					<div class="widget">
						<h3 class="mb-4">Company</h3>
						<ul class="list-unstyled float-start links">
							<li><a href="#">About us</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">Vision</a></li>
							<li><a href="#">Mission</a></li>
							<li><a href="#">Terms</a></li>
							<li><a href="#">Privacy</a></li>
						</ul>
						<ul class="list-unstyled float-start links">
							<li><a href="#">Partners</a></li>
							<li><a href="#">Business</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Creative</a></li>
						</ul>
					</div> <!-- /.widget -->
				</div> <!-- /.col-lg-4 -->
				<div class="col-lg-4">
					<div class="widget">
						<h3 class="mb-4">Recent Post Entry</h3>
						<div class="post-entry-footer">
							<ul>
								<li>
									<a href="article.php?id=<?= blogItems()[0]['id'] ?>">
										<img src="<?= blogItems()[0]['thumbnail'] ?>" alt="Image placeholder"
											class="me-4 rounded bg-white">
										<div class="text">
											<h4><?= blogItems()[0]['title'] ?></h4>
											<div class="post-meta">
												<span class="mr-2"><?= formatDate(blogItems()[0]['tanggal']) ?> </span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="article.php?id=<?= blogItems()[1]['id'] ?>">
										<img src="<?= blogItems()[1]['thumbnail'] ?>" alt="Image placeholder"
											class="me-4 rounded bg-white">
										<div class="text">
											<h4><?= blogItems()[1]['title'] ?></h4>
											<div class="post-meta">
												<span class="mr-2"><?= formatDate(blogItems()[1]['tanggal']) ?> </span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="article.php?id=<?= blogItems()[2]['id'] ?>">
										<img src="<?= blogItems()[2]['thumbnail'] ?>" alt="Image placeholder"
											class="me-4 rounded bg-white">
										<div class="text">
											<h4><?= blogItems()[2]['title'] ?></h4>
											<div class="post-meta">
												<span class="mr-2"><?= formatDate(blogItems()[2]['tanggal']) ?> </span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>

					</div> <!-- /.widget -->
				</div> <!-- /.col-lg-4 -->
			</div> <!-- /.row -->

			<div class="row mt-5">
				<div class="col-12 text-center">
					<!-- 
			  **==========
			  NOTE: 
			  Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
			  **==========
			-->

					<p>Copyright &copy;
						<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash;
						Designed with love by <a href="https://untree.co">BlogLTE</a>
						<!-- License information: https://untree.co/license/ -->
					</p>
				</div>
			</div>
		</div> <!-- /.container -->
	</footer> <!-- /.site-footer -->

	<!-- Preloader -->
	<div id="overlayer"></div>
	<div class="loader">
		<div class="spinner-border text-primary" role="status">
			<span class="visually-hidden">Loading...</span>
		</div>
	</div>


	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/tiny-slider.js"></script>

	<script src="js/flatpickr.min.js"></script>


	<script src="js/aos.js"></script>
	<script src="js/glightbox.min.js"></script>
	<script src="js/navbar.js"></script>
	<script src="js/counter.js"></script>
	<script src="js/custom.js"></script>


</body>

</html>