<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="msg"></div>
                <form method="post" id="form-pass">
                    <div class="mb-3">
                        <label for="">
                            Password Lama
                        </label>
                        <div class="input-group">
                            <input type="password" name="pass_lama" class="form-control shw-pwl" required>
                            <span class="input-group-text pw-lm icon"><em class="fas fa-eye icn-pwl"></em></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">
                            Password Baru
                        </label>
                        <div class="input-group">
                            <input type="password" name="pass_baru" class="form-control shw-pwb pass-baru" required>
                            <span class="input-group-text pwb icon"><em class="fas fa-eye icn-pwb"></em></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">
                           Konfirmasi Password Baru
                        </label>
                        <div class="input-group">
                            <input type="password" name="kon_pass_baru" class="form-control shw-kpwb" required>
                            <span class="input-group-text icon kpwb"><em class="fas fa-eye icn-kpwb"></em></span>
                        </div>
                    </div>
                   
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success update">
                            <em class="fas fa-key"></em> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>