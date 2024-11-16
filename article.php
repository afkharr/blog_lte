<!-- /*
* Template Name: Blogy
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<?php
session_start();
require ('config/koneksi.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
  return header('location: index.php');
}

$id = $_GET['id'];

function komentarDetails()
{
  global $koneksi;
  $id = $_GET['id']; // Assuming you get the blog ID from the URL parameter
  $sql = "SELECT komentar.id, komentar.text, komentar.tanggal, user.name AS user_name 
            FROM komentar 
            JOIN user ON komentar.user_id = user.id 
            WHERE komentar.blog_id = $id 
            ORDER BY tanggal ASC";
  $result = mysqli_query($koneksi, $sql);
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function blogDetails()
{
  global $id, $koneksi;
  $sql = "SELECT blog.id, blog.title, blog.body, blog.thumbnail, blog.deskripsi, blog.tanggal, user.name AS user_name 
            FROM blog 
            JOIN user ON blog.user_id = user.id 
            WHERE blog.id = $id";
  $result = mysqli_query($koneksi, $sql);
  return mysqli_fetch_assoc($result);
}

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

function formatTimestamp($timestamp)
{
  $timestamp = strtotime($timestamp); // Assuming the timestamp is in this format

  $formatted_date = date("F j, Y \a\t g:ia", $timestamp);

  return $formatted_date;
}
?>

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


  <title>BlogLTE &mdash; <?= blogDetails()['title'] ?></title>
</head>

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
              <a href="index.php" class="logo m-0 float-start">BlogLTE<span class="text-primary">.</span></a>
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
                <a href="logout.php" class="btn btn-sm btn-outline-danger mt-2 d-none d-lg-inline-block">Logout</a>
              <?php elseif (!isset($_SESSION['user'])): ?>
                <a href="login.php" class="btn btn-sm btn-outline-success mt-2 d-none d-lg-inline-block">Login</a>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="site-cover site-cover-sm same-height overlay single-page"
    style="background-image: url('<?= blogDetails()['thumbnail'] ?>');">
    <div class="container">
      <div class="row same-height justify-content-center">
        <div class="col-md-6">
          <div class="post-entry text-center">
            <h1 class="mb-4"><?= blogDetails()['title'] ?></h1>
            <div class="post-meta align-items-center text-center">
              <figure class="author-figure mb-0 me-3 d-inline-block"><img src="images/person_1.jpg" alt="Image"
                  class="img-fluid"></figure>
              <span class="d-inline-block mt-1">By <?= blogDetails()['user_name'] ?></span>
              <span>&nbsp;-&nbsp; <?= formatDate(blogDetails()['tanggal']) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <section class="section">
    <div class="container">

      <div class="row blog-entries element-animate">

        <div class="col-md-12 col-lg-8 main-content">

          <div class="post-content-body">
            <?= blogDetails()['body'] ?>
          </div>


          <div class="pt-5 comment-wrap" id="komentar">
            <h3 class="mb-5 heading"><?= (count(komentarDetails())) ?> Comments</h3>
            <ul class="comment-list">
              <?php
              foreach (komentarDetails() as $value):
                ?>
                <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3><?= $value['user_name'] ?></h3>
                    <div class="meta"><?= formatTimestamp($value['tanggal']) ?></div>
                    <p><?= $value['text'] ?></p>
                    <!-- <p><a href="#" class="reply rounded">Reply</a></p> -->
                  </div>
                </li>
              <?php endforeach; ?>


            </ul>
            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5 mb-3">
              <h3 class="mb-5">Leave a comment</h3>
              <form onsubmit="konfirmasi(event)" id="formKomentar" method="post"
                action="proses.komentar.kirim.php?id=<?= $_GET['id'] ?>" class="p-5 bg-light">
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="text" id="text" cols="15" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn btn-primary">
                </div>

              </form>
            </div>
          </div>

        </div>

        <!-- END main-content -->

        <div class="col-md-12 col-lg-4 sidebar">

          <!-- END sidebar-box -->
          <div class="sidebar-box ">
            <div class="bio text-center">
              <img src="images/person_1.jpg" alt="Image Placeholder" class="img-fluid mb-3">
              <div class="bio-body">
                <h2><?= blogDetails()['user_name'] ?></h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, eos.</p>
                <p><a type="button" class="btn btn-outline-primary btn-sm rounded px-2 py-2">Thanks for visit</a></p>

                <p class="social">
                  <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                  <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                  <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                  <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                </p>
              </div>
            </div>
          </div>
          <!-- END sidebar-box -->
          <div class="sidebar-box">
            <h3 class="heading">Popular Posts</h3>
            <div class="post-entry-sidebar">
              <ul>
                <li>
                  <a href="article.php?id=<?= blogItems()[0]['id'] ?>">
                    <img src="<?= blogItems()[0]['thumbnail'] ?>" alt="Image placeholder" class="me-4 rounded">
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
                    <img src="<?= blogItems()[1]['thumbnail'] ?>" alt="Image placeholder" class="me-4 rounded">
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
                    <img src="<?= blogItems()[2]['thumbnail'] ?>" alt="Image placeholder" class="me-4 rounded">
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

        </div>
        <!-- END sidebar -->

      </div>
    </div>
  </section>


  <!-- Start posts-entry -->
  <section class="section posts-entry posts-entry-sm bg-light">
    <div class="container">
      <div class="row mb-4">
        <div class="col-12 text-uppercase text-black">More Blog Posts</div>
      </div>
      <div class="row">
        <?php
        $items = blogItems();
        $total_items = count($items);
        $max_items = min(4, $total_items); // Ensure we don't exceed 9 items
        
        for ($i = 0; $i < $max_items; $i++):
          ?>
          <div class="col-md-6 col-lg-3">
            <div class="blog-entry">
              <a href="article.php?id=<?= $items[$i]['id'] ?>" class="img-link">
                <img src="<?= $items[$i]['thumbnail'] ?>" alt="Image" class="img-fluid">
              </a>
              <span class="date"><?= formatDate($items[$i]['tanggal']) ?></span>
              <h2><a href="article.php?id=<?= $items[$i]['id'] ?>"><?= $items[$i]['title'] ?></p>
                  <p><a href="#" class="read-more">Continue Reading</a></p>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>
  <!-- End posts-entry -->

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
                    <img src="<?= blogItems()[0]['thumbnail'] ?>" alt="Image placeholder" class="me-4 rounded bg-white">
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
                    <img src="<?= blogItems()[1]['thumbnail'] ?>" alt="Image placeholder" class="me-4 rounded bg-white">
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
                    <img src="<?= blogItems()[2]['thumbnail'] ?>" alt="Image placeholder" class="me-4 rounded bg-white">
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
            <script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love
            by <a href="https://untree.co">BlogLTE</a> <!-- License information: https://untree.co/license/ -->
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


  <script>
    function konfirmasi(event) {
      event.preventDefault();
      var session_user = <?= json_encode($_SESSION['user'] ?? null) ?>;

      if (!session_user) {
        if (confirm("Mohon lakukan login terlebih dahulu.")) {
          window.location.href = "login.php?id=" + <?php echo $_GET['id'] ?>;
        }
      } else {
        document.getElementById('formKomentar').submit();
      }
    }
  </script>


</body>

</html>