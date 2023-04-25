<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-success mb-4 tmb-pemasukan">
                    <em class="fas fa-plus"></em> Tambah Pemasukan
                </button>
                <div id="msg"></div>
                <table class="table data-pemasukan">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan Pemasukan</th>
                            <th>Sumber Pemasukan</th>
                            <th>Jumlah Pemasukan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require 'modal/pemasukan.php'; ?>