<!-- Begin Page Content -->
<?php foreach ($penjualan as $user) : ?>
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $user->id_sales ?></h1>
    </div>

    <!-- Content Row -->

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-12">

      </div>

      <div class="col-xl-12 col-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <div class="row">
              <div class="col-12">

                <form method="POST" action="<?= base_url() ?>penjualan/update">
                  <div class="form-row">

                    <input type="hidden" name="id_sales" value="<?= $user->id_sales ?>">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tgl_sales" value="<?= $user->tgl_sales ?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="id_customer" class="form-control">
                          <option value="<?= $user->id_customer ?>"><?= $user->nama_customer ?></option>
                          <?php foreach ($pelanggan as $plg) : ?>
                            <option value="<?= $plg->id_customer ?>"><?= $plg->nama_customer ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Sales</label>
                        <select name="id_users" class="form-control">
                          <option value="<?= $user->id_users ?>"><?= $user->username ?></option>
                          <?php foreach ($pengguna as $pgn) : ?>
                            <option value="<?= $pgn->id_users ?>"><?= $pgn->username ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Potongan</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="number" name="potongan" class="form-control" value="<?= $user->potongan ?>">
                        </div>
                        <label class="sr-only">Potongan</label>
                      </div>
                    </div>

                  </div>
                </form>
                
              </div>

              <hr>

              <div class="col-12">

                <form id="tambahBarang" method="POST" action="<?= base_url() ?>detail/tambah">

                  <div class="form-row">

                    <input type="hidden" name="id_sales" value="<?= $user->id_sales ?>">
                    <div class="col-12 col-md-3">
                      <div class="form-group">
                        <select class="form-control js-example-basic-single" name="id_barang[]">
                          <option selected>Pilih Barang</option>
                          <?php foreach ($barang as $brg) : ?>
                            <option value="<?= $brg->id_barang ?>">[<?= $brg->id_barang ?>] <?= $brg->nama_barang ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-12 col-md-3">
                      <div class="form-group">
                        <label class="sr-only">Jumlah</label>
                        <input type="number" class="form-control" name="qty[]" placeholder="Tambah jumlah disini...">
                      </div>
                    </div>

                    <div class="col-12 col-md-2">
                      <button type="submit" class="btn btn-primary btn-sm mb-2">Tambah (Enter)</button>
                    </div>

                  </div>
                </form>

              </div>

            </div>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php $jumlah = 0; ?>
                  <?php foreach ($detail as $det) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $det->nama_barang ?></td>
                      <td><?= $det->qty ?></td>
                      <td>Rp<?= number_format($det->qty * $det->harga_jual, 0, ",", ".") ?></td>
                      <?php $jumlah += $det->qty * $det->harga_jual ?>
                      <td>
                        <a href="<?= base_url() ?>detail/delete/<?= $det->id_detail_sales ?>" class="badge badge-danger">hapus</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <p>Potongan: Rp<?= number_format($user->potongan, 0, ",", ".") ?></p>
              <p>Harga: Rp<?= number_format($jumlah, 0, ",", ".") ?></p>
              <hr>
              <h3><b>Total: Rp<?= number_format($jumlah - $user->potongan, 0, ",", ".") ?></b></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

<script>
  document.addEventListener('keyup', (event) => {
    if (event.code === 'Enter') {
      document.getElementById("tambahBarang").submit();
    }
  }, false);
</script>