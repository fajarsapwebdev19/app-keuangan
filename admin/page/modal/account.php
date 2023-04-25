<div class="modal fade" id="add-users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-user">
        <div class="modal-body">
            <div class="mb-3">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Jenis Kelamin</label>
                <br>
                <div class="radio">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="L">
                        <label class="form-check-label" for="inlineRadio1">Laki Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="P">
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Tanggal Lahir</label>
                <input type="text" name="tanggal_lahir" class="form-control date">
            </div>
            <div class="mb-3">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <div class="input-group">
                     <input type="password" name="password" class="form-control shw-pwd">
                    <span class="input-group-text pwd icon"><em class="fas fa-eye icn-pwd"></em></span>
                </div>
            </div>
            <div class="mb-3">
                <label for="">
                    Role
                </label>
                <select name="role" id="" class="form-control">
                    <option value="">-- Pilih --</option>
                    <?php
                        $query = mysqli_query($con, "SELECT * FROM roles");
                        while($r = mysqli_fetch_object($query))
                        {
                            ?>
                                <option value="<?= $r->role_id?>"><?= $r->role_name; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success tambah"><em class="icon-load"></em> Tambah</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form_update_user"></form>
    </div>
  </div>
</div>

<div class="modal fade" id="delete_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form_delete_users"></form>
    </div>
  </div>
</div>