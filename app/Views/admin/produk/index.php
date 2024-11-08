<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content'); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= !empty($title) ? 'Daftar ' . $title :  '-'; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Produk</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header justify-content-end d-flex">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                    Tambah Produk
                </button>
            </div>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success flash-message">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger flash-message">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah Stok</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php if (count($produk) > 0) : ?>
                            <?php foreach ($produk as $val) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($val->nama_produk) ?></td>
                                    <td><?= esc(number_format($val->harga, 0, ',', '.')) ?></td>
                                    <td><?= esc($val->jumlah_stok) ?></td>
                                    <td><?= esc($val->description) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="modalbtn(this);" data-id="<?= esc($val->produk_id) ?>" data-nama="<?= esc($val->nama_produk) ?>" data-harga="<?= esc(number_format($val->harga, 0, ',', '')) ?>" data-jumlah="<?= esc($val->jumlah_stok) ?>" data-description="<?= esc($val->description) ?>">
                                            Ubah Data
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            onclick="if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) { window.location.href = '/produk/delete/<?= esc($val->produk_id) ?>'; }">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <!-- <//?php else : ?>
                            <tr>
                                <td colspan="6">Tidak ada produk yang ditemukan.</td>
                            </tr> -->
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('produk/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ubahDataModal" tabindex="-1" aria-labelledby="ubahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahDataModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('produk/ubah') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" class="form-control" id="id_produk" name="id_produk" maxlength="100" required>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="ubah_nama_produk" name="nama_produk" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="ubah_description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="ubah_harga" name="harga" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" id="ubah_jumlah_stok" name="jumlah_stok" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    setTimeout(function() {
        var flashMessages = document.querySelectorAll('.flash-message');

        flashMessages.forEach(function(message) {
            message.style.display = 'none';
        });

        var errorMessages = document.querySelectorAll('.alert-danger');
        errorMessages.forEach(function(message) {
            message.style.display = 'none';
        });
    }, 5000); // 10000 ms = 10 detik
</script>
<script>
    function modalbtn(x) {
        var id = $(x).data('id');
        var nama = $(x).data('nama');
        var harga = $(x).data('harga');
        var jumlah = $(x).data('jumlah');
        var description = $(x).data('description');

        $('#id_produk').val(id);
        $('#ubah_nama_produk').val(nama);
        $('#ubah_harga').val(harga);
        $('#ubah_jumlah_stok').val(jumlah);
        $('#ubah_description').val(description);

        $('#ubahDataModal').modal('show');
    }
</script>
<?= $this->endSection() ?>