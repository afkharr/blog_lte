<?php $title = "Dashboard"; ?>
<?php include_once ('layout/header.php'); ?>

<?php


function getCountPengguna()
{
  global $koneksi;
  $sql = "SELECT * FROM user";
  $query = mysqli_query($koneksi, $sql);
  $count = mysqli_num_rows($query);
  return $count;
}

function getCountBlog()
{
  global $koneksi;
  $sql = "SELECT * FROM blog WHERE user_id = " . $_SESSION['user']['id'];
  $query = mysqli_query($koneksi, $sql);
  $count = mysqli_num_rows($query);
  return $count;
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
          <div class="col-lg-6">
            <div class="card card-success card-outline">
              <div class="card-body p-0">
                <div class="row">
                  <div class="col-lg-3 text-center p-0" style="font-size: 3.3em;">
                    <div class="badge badge-success rounded">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                  </div>
                  <div class="col-lg-9 text-center text-uppercase py-2 px-2">
                    <h3>pengguna</h3>
                    <h2><?= getCountPengguna(); ?></h2>
                    <a href="pengguna.php" class="btn btn-outline-success col-lg-10">Lihat</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="col-lg-6">
          <div class="card card-primary card-outline">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-3 text-center p-0" style="font-size: 3.3em;">
                  <div class="badge badge-primary rounded">
                    <i class="fa fa-newspaper" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="col-lg-9 text-center text-uppercase py-2 px-2">
                  <h3>Postingan</h3>
                  <h2><?= getCountBlog(); ?></h2>
                  <a href="postingan.php" class="btn btn-outline-primary col-lg-10">Lihat</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once ('layout/footer.php'); ?>