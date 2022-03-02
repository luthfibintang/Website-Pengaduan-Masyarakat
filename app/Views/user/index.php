<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
              <div class="breadcrumb-item">Profile</div>
            </div>
          </div>
          <div class="section-body">
          <?php if (session()->get('success')) : ?>
          <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('success'); ?> -->
            </div>
        <div class="swaldata" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="red" data-red="<?= session()->getFlashdata('message'); ?>"></div>
        <?php endif; ?>
            <h2 class="section-title">Hi, <?= user()->fullname; ?></h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="<?= base_url('/img/user-profile/' . user()->user_image); ?>" class="rounded-circle profile-widget-picture img-preview">
                    <div class="profile-widget-items">
                      <?php if(in_groups('masyarakat')) : ?>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Jumlah Pengaduan</div>
                        <div class="profile-widget-item-value"><?= $total; ?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Pengaduan Selesai</div>
                        <div class="profile-widget-item-value"><?= $selesai; ?></div>
                      </div>
                      <?php elseif(in_groups('petugas')) : ?>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Belum terverifikasi</div>
                        <div class="profile-widget-item-value"><?= $belumverif; ?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Sudah Verifikasi</div>
                        <div class="profile-widget-item-value"><?= $verif; ?></div>
                      </div>
                      <?php elseif(in_groups('admin')) : ?>
                      <?php else : ?>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Sudah Menanggapi</div>
                        <div class="profile-widget-item-value"><?= $tanggapan; ?> Masyarakat</div>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name"><?= user()->fullname; ?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div><?= $users[0]->name; ?></div></div>
                    <?php if(!empty(user()->nik)) : ?>
                    <div>NIK : <?= user()->nik; ?></div>
                    <?php endif; ?>
                    <div>Username : <?= user()->username; ?></div>
                    <?= user()->bio; ?>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" class="needs-validation" action="<?= base_url('user/updateprofile/' . user()->id) ?>"  enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                      <input type="hidden" name="id" value="<?= user()->id ?>">
                      <input type="hidden" name="old_userImage" value="<?= user()->user_image ?>" >
                      <input type="hidden" name="nik" value="<?= user()->nik; ?>" >
                      <div class="row">
                      <div class="form-group col-12">
                      <label>Foto Profile</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input <?= ($validation->hasError('user_image'))? 'is-invalid' : ''; ?>" id="user_image" name="user_image" onchange="previewProfile()"> 
                        <label class="custom-file-label" for="customFile">Choose File</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('user_image'); ?>
                        </div>
                      </div>
                      </div>
                      </div>
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Nama Lengkap</label>
                            <input type="text" name="fullname" class="form-control <?= ($validation->hasError('fullname'))? 'is-invalid' : ''; ?>" value="<?= ($validation->hasError('fullname')) ? old('fullname') : user()->fullname ?>">
                            <div class="invalid-feedback">
                            <?= $validation->getError('fullname'); ?>
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?= ($validation->hasError('username'))? 'is-invalid' : ''; ?>" value="<?= ($validation->hasError('username')) ? old('username') : user()->username ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-7 col-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?= ($validation->hasError('email'))? 'is-invalid' : ''; ?>" value="<?= ($validation->hasError('email')) ? old('email') : user()->email ?>">
                            <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                            </div>
                          </div>
                          <div class="form-group col-md-5 col-12">
                            <label>Phone</label>
                            <input type="tel" name="telp" class="form-control <?= ($validation->hasError('telp'))? 'is-invalid' : ''; ?>" value="<?= ($validation->hasError('telp')) ? old('telp') : user()->telp ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('telp'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Bio</label>
                            <textarea class="form-control summernote-simple" name="bio" style="height: 150px;"><?= user()->bio; ?></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

<?= $this->endSection(); ?>