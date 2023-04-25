<div class="row">
    <div class="col-md-4">
        <div class="card">
                <div class="card-body bg-success text-white">
                    <div class="row">
                        <div class="col-sm-2 d-flex justify-content-center mt-2">
                            <h1 class="fas fa-money-check-alt"></h1>
                        </div>
                        <div class="col-sm-10">
                            <h5>Pemasukan</h5>
                            <h6>Rp. <?= number_format($pem->jumlah, 0,'.','.'); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-4">
        <div class="card">
                <div class="card-body bg-danger text-white">
                    <div class="row">
                        <div class="col-sm-2 d-flex justify-content-center mt-2">
                            <h1 class="fas fa-money-check-alt"></h1>
                        </div>
                        <div class="col-sm-10">
                            <h5>Pengeluaran</h5>
                            <h6>Rp. <?= number_format($pgl->jumlah, 0,'.','.'); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-4">
        <div class="card">
                <div class="card-body bg-primary text-white">
                    <div class="row">
                        <div class="col-sm-2 d-flex justify-content-center mt-2">
                            <h1 class="fas fa-money-check-alt"></h1>
                        </div>
                        <div class="col-sm-10">
                            <h5>Saldo</h5>
                            <h6>Rp. <?= number_format($tot, 0,'.','.'); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>