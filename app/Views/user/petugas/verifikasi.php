<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <h1>Detail Pengaduan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Verifikasi</div>
    </div>
    </div> 
    <div class="section-body">
    <form action="<?= base_url(); ?>/pengaduan/verifikasiall" method="post">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Verifikasi</h4>
                    <div class="card-header-action">
                        <!-- <form method="post" action="" autocomplete="off" >
                            <div class="input-group">
                                <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form> -->
                        <button class="btn btn-primary float-right d-block" name="btnverif" type="submit">Verifikasi</button>
                        <button class="btn btn-danger float-right d-block mr-3" name="btntolak" type="submit">Tolak Pengaduan</button>
                    </div>
                </div>
                <div class="collapse show" id="belumverif">
                <div class="card-body">
                    <?php if (session()->get('message')) : ?>
                        <!-- <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= session()->getFlashdata('message'); ?>
                        </div> -->
                    <?php elseif (session()->get('success')) : ?>
                        <!-- <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= session()->getFlashdata('success'); ?>
                        </div> -->
                    <?php endif; ?>
                <div class="swaldata" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
                <div class="red" data-red="<?= session()->getFlashdata('message'); ?>"></div>
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="unverif-tab" data-toggle="tab" href="#unverif" role="tab" aria-controls="unverif" aria-selected="true">Belum diverifikasi</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="verif-tab" data-toggle="tab" href="#verif" role="tab" aria-controls="verif" aria-selected="false">Terverifikasi</a>
                      </li>
                </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="unverif" role="tabpanel" aria-labelledby="unverif-tab">
        <div class="table-responsive">
        <table class="table table-striped" id="datapengaduan">
            <thead>
                <tr>
                <th scope="col">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                              </div>
                </th>
                <th class="text-center">No</th>
                <th>Judul Pengaduan</th>
                <th>Tanggal Pengaduan</th>
                <th>Level</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                      
                <?php foreach($pengaduan as $p) : ?>
                <tr>
                <td>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" name="check_pengaduan[]" data-checkboxes="mygroup" class="custom-control-input" value="<?= $p['id_pengaduan']; ?>" id="<?= $p['id_pengaduan']; ?>">
                        <label for="<?= $p['id_pengaduan']; ?>" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $p['judul']; ?></td>
                <td><?= $p['tgl_pengaduan']; ?></td>
                <td <?php if($p['level'] == 'urgent'){echo 'style="color: red; font-weight:bold;"';}; ?>>
                    <?= $p['level']; ?>
                </td>
                <td>
                <div class="<?php if($p['status'] == 0){echo 'badge badge-danger';} elseif($p['status'] == 'verifikasi'){echo 'badge badge-primary';}elseif($p['status'] == 'proses'){echo 'badge badge-warning';}elseif($p['status'] == 'tolak'){echo 'badge badge-danger';}else{echo 'badge badge-success';} ?>">
                    <?php if($p['status'] == 0){ echo "Belum Diverifikasi";} ?>
                    <?php if($p['status'] == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                    <?php if($p['status'] == 'proses'){ echo "Sedang Diproses";} ?>
                    <?php if($p['status'] == 'selesai'){ echo "Sudah Ditanggapi";} ?>
                    <?php if($p['status'] == 'tolak'){ echo "Pengaduan Ditolak";} ?>
                </div>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?= base_url('pengaduan/verifikasi_detail/' . $p['id_pengaduan']); ?>">Detail</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
                </form>
        </div>
        </div>
        <div class="tab-pane fade" id="verif" role="tabpanel" aria-labelledby="verif-tab">
        <div class="table-responsive">
        <table class="table table-striped" id="dataverif">
            <thead>
                <tr>
                <th class="text-center">No</th>
                <th>Judul Pengaduan</th>
                <th>Tanggal Pengaduan</th>
                <th>Level</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                      
                <?php foreach($nonverif as $n) : ?>
                <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $n['judul']; ?></td>
                <td><?= $n['tgl_pengaduan']; ?></td>
                <td <?php if($n['level'] == 'urgent'){echo 'style="color: red; font-weight:bold;"';}; ?>>
                    <?= $n['level']; ?>
                </td>
                <td>
                <div class="<?php if($n['status'] == 0){echo 'badge badge-danger';} elseif($n['status'] == 'verifikasi'){echo 'badge badge-primary';}elseif($n['status'] == 'proses'){echo 'badge badge-warning';}elseif($n['status'] == 'tolak'){echo 'badge badge-danger';}else{echo 'badge badge-success';} ?>">
                    <?php if($n['status'] == 0){ echo "Belum Diverifikasi";} ?>
                    <?php if($n['status'] == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                    <?php if($n['status'] == 'proses'){ echo "Sedang Diproses";} ?>
                    <?php if($n['status'] == 'selesai'){ echo "Sudah Ditanggapi";} ?>
                    <?php if($n['status'] == 'tolak'){ echo "Pengaduan Ditolak";} ?>
                </div>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?= base_url('pengaduan/verifikasi_detail/' . $n['id_pengaduan']); ?>">Detail</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        </div>
        </div>       
    </div>
</div>
</section>

<?= $this->endSection(); ?>