<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Print Laporan</h1>
    </div>

    <!-- Page Heading -->
    <div class="section-body">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    Print Berdasarkan :
                </div>
                <div class="card-body">
                    <form action="<?= base_url('laporan/getLaporan'); ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="from" class="form-control" placeholder="Tanggal awal" onfocusin="(this.type='date')" onfocusout="(this.type='text')">

                            <input type="text" name="to" class="form-control ml-3" placeholder="Tanggal Akhir" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group">
                        <select name="kategori" id="kategori" class="form-control selectric">
                            <option value="">-- Pilih kategori --</option>
                            <?php foreach($kategori as $k) : ?>
                            <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                            <?php endforeach ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <select name="status" id="status" class="form-control selectric">
                            <option value="">-- Pilih Status --</option>
                            <option value="0">Belum Diverifikasi</option>
                            <option value="masuk">Terverifikasi</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="printPage('laporan/getLaporan')" style="width: 100%;">Print</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?= $this->endSection(); ?>