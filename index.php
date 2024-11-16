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


	<title>BlogLTE</title>
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
								<li class="active"><a href="index.php">Home</a></li>
								<li class="has-children">
									<a href="list.php">Pages</a>
									<ul class="dropdown">
										<li><a href="list.php">Blog</a></li>

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

	<!-- Start retroy layout blog posts -->
	<section class="section bg-light">
		<div class="container">
			<div class="row align-items-stretch retro-layout">
				<div class="col-md-4">
					<a href="article.php?id=<?= blogItems()[0]['id'] ?>" class="h-entry mb-30 v-height gradient">

						<div class="featured-img" style="background-image: url('<?= blogItems()[0]['thumbnail'] ?>');">
						</div>

						<div class="text">
							<span class="date"><?= formatDate(blogItems()[0]['tanggal']) ?></span>
							<h2><?= blogItems()[0]['title'] ?></h2>
						</div>
					</a>
					<a href="article.php?id=<?= blogItems()[1]['id'] ?>" class="h-entry v-height gradient">

						<div class="featured-img" style="background-image: url('<?= blogItems()[1]['thumbnail'] ?>');">
						</div>

						<div class="text">
							<span class="date"><?= formatDate(blogItems()[1]['tanggal']) ?></span>
							<h2><?= blogItems()[1]['title'] ?></h2>
						</div>
					</a>
				</div>
				<div class="col-md-4">
					<a href="article.php?id=<?= blogItems()[2]['id'] ?>" class="h-entry img-5 h-100 gradient">

						<div class="featured-img" style="background-image: url('<?= blogItems()[2]['thumbnail'] ?>');">
						</div>

						<div class="text">
							<span class="date"><?= formatDate(blogItems()[2]['tanggal']) ?></span>
							<h2><?= blogItems()[2]['title'] ?></h2>
						</div>
					</a>
				</div>
				<div class="col-md-4">
					<a href="article.php?id=<?= blogItems()[3]['id'] ?>" class="h-entry mb-30 v-height gradient">

						<div class="featured-img" style="background-image: url('<?= blogItems()[3]['thumbnail'] ?>');">
						</div>

						<div class="text">
							<span class="date"><?= formatDate(blogItems()[3]['tanggal']) ?></span>
							<h2><?= blogItems()[3]['title'] ?></h2>
						</div>
					</a>
					<a href="article.php?id=<?= blogItems()[4]['id'] ?>" class="h-entry v-height gradient">

						<div class="featured-img" style="background-image: url('<?= blogItems()[4]['thumbnail'] ?>');">
						</div>

						<div class="text">
							<span class="date"><?= formatDate(blogItems()[4]['tanggal']) ?></span>
							<h2><?= blogItems()[4]['title'] ?></h2>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End retroy layout blog posts -->



	<section class="section">
		<div class="container">

			<div class="row mb-4">
				<div class="col-sm-6">
					<h2 class="posts-entry-title">Our list</h2>
				</div>
				<div class="col-sm-6 text-sm-end"><a href="list.php" class="read-more">View All</a></div>
			</div>

			<div class="row">

				<?php
				$items = blogItems();
				$total_items = count($items);
				$max_items = min(9, $total_items); // Ensure we don't exceed 9 items
				
				for ($i = 0; $i < $max_items; $i++):
					?>
					<div class="col-lg-4 mb-4">
						<div class="post-entry-alt">
							<a href="article.php?id=<?= $items[$i]['id'] ?>" class="img-link"><img
									src="<?= $items[$i]['thumbnail'] ?>" alt="Image" class="img-fluid"></a>
							<div class="excerpt">
								<h2><a href="article.php?id=<?= $items[$i]['id'] ?>"><?= $items[$i]['title'] ?></a></h2>
								<div class="post-meta align-items-center text-left clearfix">
									<figure class="author-figure mb-0 me-3 float-start"><img src="images/person_1.jpg"
											alt="Image" class="img-fluid"></figure>
									<span class="d-inline-block mt-1">By <a
											href="#"><?= $items[$i]['user_name'] ?></a></span>
									<span>&nbsp;-&nbsp; <?= formatDate($items[$i]['tanggal']) ?></span>
								</div>
								<p><?= $items[$i]['deskripsi'] ?></p>
								<p><a href="article.php?id=<?= $items[$i]['id'] ?>" class="read-more">Continue Reading</a>
								</p>
							</div>
						</div>
					</div>
				<?php endfor; ?>

			</div>

		</div>
	</section>

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
						Designed with love by <gL href="https://untree.co">BlogLTE</a>
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