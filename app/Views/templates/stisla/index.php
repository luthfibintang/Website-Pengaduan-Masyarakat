
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/selectric/public/selectric.css">
  <link rel="stylesheet" href="<?= base_url()?>/template/node_modules/chocolat/dist/css/chocolat.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css">

  <!-- Custom style for print -->
  <style>
    @media print {
      .main-sidebar, .main-footer, div#debug-icon, .main-navbar, .card-header, .section-header, .navbar-bg, .section-header-back {
        display: none;
      }
      .card {
        margin-top: -50px;
        width: 100%;
      }
    }
  </style>
</head>

<?php if(in_groups('masyarakat')) : ?>
  <body class="layout-3">
    <div class="main-wrapper container">
      <?= $this->include('templates/stisla/navbar') ?>
      
      <?php else : ?>
  <body>
      <div id="app">
      <div class="main-wrapper">
      <!-- Topbar -->
      <?= $this->include('templates/stisla/topbar') ?>

      <!-- Sidebar -->
      <?= $this->include('templates/stisla/sidebar'); ?>
    <?php endif; ?>


      <!-- Main Content -->
      <div class="main-content">
          
          <?= $this->renderSection('user-content'); ?>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2022 <div class="bullet"></div> Made by <a href="https://www.instagram.com/luthfibintang3/">Azisya Luthfi Bintang</a>
        </div>
        <div class="footer-right">
          Bina Informatika
        </div>
      </footer>
    </div>
  </div>


<!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url(); ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
  <script src="<?= base_url(); ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
  <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url(); ?>/template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url(); ?>/template/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>
  <script src="<?= base_url(); ?>/template/assets/js/page/modules-datatables.js"></script>

  <script>
    $(document).ready(function(){
        $('#datapengaduan').DataTable({
          // paging: false,
          // searching: false,
        });
    })
</script>
<script>
    $(document).ready(function(){
        $('#dataverif').DataTable({
          // paging: false,
          // searching: false,
        });
    })
</script>



  <script>
        function previewProfile(){

            const user_image = document.querySelector('#user_image');
            const imageLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');
    
            imageLabel.textContent = user_image.files[0].name;
    
            const fileImage = new FileReader();
            fileImage.readAsDataURL(user_image.files[0]);
    
            fileImage.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>
</html>
