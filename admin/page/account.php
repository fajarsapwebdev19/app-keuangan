<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-success mb-3 tambah-user">
                    <em class="fas fa-user-plus"></em> Tambah User
                </button>
                <div id="msg"></div>
                <div class="table-responsive">
                    <table class="table table-hover account">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Status Akun</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'modal/account.php'; ?>