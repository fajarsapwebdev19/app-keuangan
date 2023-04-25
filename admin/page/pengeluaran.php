<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-success mb-4 add-pengeluaran">
                    <em class="fas fa-plus"></em> Tambah Pengeluaran
                </button>
                <div id="msg"></div>
                <div class="table-responsive">
                    <table class="table data-pengeluaran">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Keterangan Pengeluaran</th>
                                <th>Untuk Pengeluaran</th>
                                <th>Jumlah Pengeluaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'modal/pengeluran.php'; ?>