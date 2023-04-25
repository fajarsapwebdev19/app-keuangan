if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

function frm_profile(){
    $('#form-profile').load("ajax/method/profile_form.php");
    $('#detail-profile').load("ajax/method/detail_profile.php");
}

frm_profile();

$('.date').datepicker({
    format: 'dd-mm-yyyy',
    autohighlight: true,
    todayHighlight: true,
    autoclose: true
});

$('#form-profile').on('click', '.update', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // yyyy-mm-dd
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );

    $("#form-profile").validate({
        rules: {
            nama: {
                required: true
            },
            jenis_kelamin:{
                required: true
            },
            tanggal_lahir: {
                required: true, 
                date: true
            },
            tempat_lahir: {
                required: true
            }
            
        },
        messages: {
            jenis_kelamin : {
                required:"Pilih Salah Satu <br/>"
            },
            tanggal_lahir: {
                required: 'Tanggal Lahir Kosong',
                date: "Masukan Tanggal Dengan Format dd-mm-yyyy"
            },
            nama: "Nama Kosong",
            tempat_lahir: "Tempat Lahir Kosong"
        },
        errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.radio') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
        },
        submitHandler: function(form)
        {
            var data = $('#form-profile').serialize();

            $.ajax({
                url: "ajax/update/profile.php",
                data: data,
                type: "post",
                beforeSend:function()
                {
                    $('.icon').addClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $('#message').show();
                        $('#message').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times"></em> Lengkapi Data</div>');
                        O
                    }
                    else if(response == "sukses")
                    {
                        $('#message').show();
                        $('#message').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check"></em> Berhasil Ubah Data</div>');
                        $('#message').delay(5000).fadeOut('slow').slideUp(500);
                        frm_profile();
                    }
                    else{
                        $('#message').show();
                        $('#message').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times"></em> Terjadi Kesalahan !</div>');
                        $('#message').delay(5000).fadeOut('slow');
                    }
                }
            });
        }
    });
});

// show pass and hide pass
$('#form-pass').on('click', '.pw-lm', function(){
    var pwl = $('.shw-pwl').attr("type");

    if(pwl == "password")
    {
        $('.shw-pwl').attr("type", "text");
        $('.icn-pwl').removeClass("fa-eye");
        $('.icn-pwl').addClass("fa-eye-slash");
    }else{
        $('.shw-pwl').attr("type", "password");
        $('.icn-pwl').removeClass("fa-eye-slash");
        $('.icn-pwl').addClass("fa-eye");
    }
});

$('#form-pass').on('click', '.pwb', function(){
    var pwl = $('.shw-pwb').attr("type");

    if(pwl == "password")
    {
        $('.shw-pwb').attr("type", "text");
        $('.icn-pwb').removeClass("fa-eye");
        $('.icn-pwb').addClass("fa-eye-slash");
    }else{
        $('.shw-pwb').attr("type", "password");
        $('.icn-pwb').removeClass("fa-eye-slash");
        $('.icn-pwb').addClass("fa-eye");
    }
});

$('#form-pass').on('click', '.kpwb', function(){
    var pwl = $('.shw-kpwb').attr("type");

    if(pwl == "password")
    {
        $('.shw-kpwb').attr("type", "text");
        $('.icn-kpwb').removeClass("fa-eye");
        $('.icn-kpwb').addClass("fa-eye-slash");
    }else{
        $('.shw-kpwb').attr("type", "password");
        $('.icn-kpwb').removeClass("fa-eye-slash");
        $('.icn-kpwb').addClass("fa-eye");
    }
});

// eksekusi klik tombol ubah password
$('#form-pass').on('click', '.update', function(){
   var validate = $('#form-pass').validate({
        errorClass: "error",
        errorElement: "span",
        rules: {
            pass_lama:{
                required: true
            },
            pass_baru: {
                required: true
            },
            kon_pass_baru: {
                required: true,
                equalTo: ".pass-baru"
            }
        },
        messages:{
            pass_lama : "Password Lama Kosong",
            pass_baru: "Password Baru Kosong",
            kon_pass_baru: {
                required: "Konfirmasi Password Baru Kosong",
                equalTo: "Konfirmasi Password Tidak Sama"
            }
        },

        errorPlacement: function ( error, element ) {
            if(element.parent().hasClass('input-group')){
            error.insertAfter( element.parent() );
            }else{
                error.insertAfter( element );
            }

        },

        submitHandler:function(){
            var data = $('#form-pass').serialize();            
            $.ajax({
                url: "ajax/update/password.php",
                data: data,
                type: "post",
                beforeSend:function()
                {
                    $('.icon-load').addClass("fal fa-spinner fa-spin");
                },
                complete: function()
                {
                    $('.icon-load').removeClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $('#msg').show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Form Kosong !</div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon-load').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                    }
                    else if(response == "notsame")
                    {
                        $('#msg').show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Konfirmasi Password Tidak Sama !</div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon-load').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                    }
                    else if(response == "passoldnotfound")
                    {
                        $('#msg').show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Password Lama Tidak Sesuai !</div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon-load').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                    }
                    else if(response == "usernotfound")
                    {
                        $('#msg').show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> User Tidak Dikenali !</div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon-load').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                    }
                    else if(response == "update")
                    {
                        validate.resetForm();
                        $('#form-pass')[0].reset();
                        $('#msg').show();
                        $('#msg').html("<div class='alert alert-success bg-success text-white'><em class='fas fa-check-circle'></em> Berhasil Ubah Password !</div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon-load').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                    }else{
                        $('#msg').show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Terjadi Kesalahan !</div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon-load').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                    }
                }
            });
        }
    });
});

$('.tambah-user').click(function(){
    $('#add-users').modal('show');
});

var account = $('.account').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "ajax/data/users.php",
    "fnRowCallback": function(nRow, aData, iDisplayIndex) {
        var info = $(this).DataTable().page.info();
        $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
        return nRow;
    },
    order: [ 6, 'asc' ],
    "columnDefs":[
        {className: "text-center", targets: [0,2,5,6,7]}
    ]
});

$('.account').on('click', '.update', function(){
    var id = $(this).data("id");

    $.ajax({
        url: "ajax/method/update_user.php",
        data: {id:id},
        type: "post",
        success:function(response)
        {
            $('#update_user').modal('show');
            $('#form_update_user').html(response);
        }
    })
})

$('#form-user').on('click', '.pwd', function(){
    var pwl = $('.shw-pwd').attr("type");

    if(pwl == "password")
    {
        $('.shw-pwd').attr("type", "text");
        $('.icn-pwd').removeClass("fa-eye");
        $('.icn-pwd').addClass("fa-eye-slash");
    }else{
        $('.shw-pwd').attr("type", "password");
        $('.icn-pwd').removeClass("fa-eye-slash");
        $('.icn-pwd').addClass("fa-eye");
    }
});

$('#form-user').on('click', '.tambah', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // yyyy-mm-dd
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );
    var validated = $('#form-user').validate({
        rules: {
            nama: {
                required: true
            },
            jenis_kelamin: {
                required: true
            },
            password: {
                required: true
            },
            tempat_lahir:{
                required: true
            },
            tanggal_lahir: {
                required: true,
                date: true
            },
            username:{
                required: true
            },
            password:{
                required: true
            },
            role: {
                required: true
            }
        },
        messages: {
            nama: "Nama Kosong",
            jenis_kelamin: "Pilih Salah Satu",
            tempat_lahir: "Tempat Lahir Kosong",
            tanggal_lahir: {
                required: "Tanggal Lahir Kosong",
                date: "Masukan Format Tanggal dd-mm-yyyy"
            },
            username: "Username Kosong",
            password: "Password Kosong",
            role: "Pilih Salah Satu"
        },

        errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.radio') );
            }
            else if(element.parent().hasClass('input-group')){
            error.insertAfter( element.parent() );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
        },
        submitHandler:function(){
            var data = $('#form-user').serialize();

            $.ajax({
                url: "ajax/add/users.php",
                data: data,
                type: "post",
                beforeSend:function(){
                    $('.icon-load').addClass("fal fa-spinner fa-spin");
                },
                complete:function(){
                    $('.icon-load').removeClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Form Kosong !</div>');
                        $('#msg').delay(5000).fadeOut("slow");
                    }
                    else if(response == "success")
                    {
                        $('#form-user')[0].reset();
                        validated.resetForm();
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Tambah Pengguna !</div>');
                        $('#msg').delay(5000).fadeOut("slow");
                        $('#add-users').modal('hide');
                        account.ajax.reload(0);
                    }else{
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Terjadi Kesalahan !</div>');
                        $('#msg').delay(5000).fadeOut("slow");
                    }
                }
            });
        }
    });
});

$('#form_update_user').on('click', '.update', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // dd-mm-yyyy
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );
    var validate = $("#form_update_user").validate({
        rules:{
            nama: {
                required: true
            },
            jenis_kelamin: {
                required: true
            },
            tempat_lahir : {
                required: true
            },
            tanggal_lahir: {
                required: true,
                date: true
            },
            status_akun:{
                required: true
            }
        },
        messages: {
            nama: "Nama Kosong",
            jenis_kelamin: "Pilih Salah Satu",
            tempat_lahir: "Tempat Lahir Kosong",
            tanggal_lahir: {
                required: "Tanggal Lahir Kosong",
                date: "Masukan Tanggal Dengan Format : dd-mm-yyyy"
            },
            status_akun: "Pilih Salah Satu"
        },
        errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.radio') );
            }
            else if(element.parent().hasClass('input-group')){
            error.insertAfter( element.parent() );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
        },
        submitHandler:function()
        {
            var data = $('#form_update_user').serialize();

            $.ajax({
                url: "ajax/update/users.php",
                data: data,
                type: "post",
                beforeSend:function(){
                    $('.icon-load').addClass("fal fa-spinner fa-spin");
                },
                complete:function(){
                    $('.icon-load').removeClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $("#msg").show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Form Kosong </div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#update_user').modal('hide');
                    }
                    else if(response == "sukses")
                    {
                        $("#msg").show();
                        $('#msg').html("<div class='alert alert-success bg-success text-white'><em class='fas fa-check-circle'></em> Berhasil Ubah Data Pengguna </div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#update_user').modal('hide');
                        account.ajax.reload(0);
                    }else{
                        $("#msg").show();
                        $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Error Terjadi Kesalahan ! </div>");
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#update_user').modal('hide');
                    }
                }
            });
        }
    });
});

$('.account').on('click', '.delete', function(){
    var id = $(this).data("id");
    $.ajax({
        url: "ajax/method/delete_users.php",
        data: {id:id},
        type: "post",
        success:function(response)
        {
            $('#delete_user').modal('show');
            $('#form_delete_users').html(response);
        }
    });
});

$('#form_delete_users').on('click', '.hapus', function(){
    var data = $('#form_delete_users').serialize();

    $.ajax({
        url: "ajax/delete/users.php",
        data: data,
        type: "post",
        beforeSend:function(){
            $('.icon-load').addClass("fal fa-spinner fa-spin");
        },
        complete:function(){
            $('.icon-load').removeClass("fal fa-spinner fa-spin");
        },
        success:function(response)
        {
            if(response == "notfound")
            {
                $("#msg").show();
                $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> ID Tidak Valid </div>");
                $('#msg').delay(5000).fadeOut('slow');
                $('#delete_user').modal('hide');
            }else if(response == "sukses")
            {
                $("#msg").show();
                $('#msg').html("<div class='alert alert-success bg-success text-white'><em class='fas fa-check-circle'></em> Berhasil Ubah Data Pengguna </div>");
                $('#msg').delay(5000).fadeOut('slow');
                $('#delete_user').modal('hide');
                account.ajax.reload(0);
            }else{
                $("#msg").show();
                $('#msg').html("<div class='alert alert-danger bg-danger text-white'><em class='fas fa-times-circle'></em> Error Terjadi Kesalahan ! </div>");
                $('#msg').delay(5000).fadeOut('slow');
                $('#delete_user').modal('hide');
            }
        }
    });
});

var pemasukan = $('.data-pemasukan').DataTable({
    "serverSide": true,
    "processing": true,
    "ajax": "ajax/data/pemasukan.php",
    "fnRowCallback": function(nRow, aData, iDisplayIndex) {
        var info = $(this).DataTable().page.info();
        $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
        return nRow;
    },
    order: [1, 'asc'],
    "columnDefs":[
        {className: "text-center", targets: [0,1,4,5]}
    ]
});

$('.tmb-pemasukan').click(function(){
    $("#tambah_pemasukan").modal("show");
});

$('#form_pemasukan').on('click', '.add', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // dd-mm-yyyy
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );

    var validate = $('#form_pemasukan').validate({
        rules: {
            tgl_pemasukan:{
                required: true,
                date: true
            },
            ket_pemasukan:{
                required: true
            },
            sum_pemasukan: {
                required: true
            },
            jumlah_pemasukan:{
                required: true,
                number: true
            }
        },
        messages: {
            tgl_pemasukan:{
                required: "Tanggal Pemasukan Tidak Boleh Kosong !",
                date: "Masukan Tanggal dengan format dd-mm-yyyy"
            },
            ket_pemasukan: "Keterangan Pemasukan Tidak Boleh Kosong !",
            sum_pemasukan: "Sumber Pemasukan Tidak Boleh Kosong !",
            jumlah_pemasukan: {
                required: "Masukan Jumlah Pemasukan !",
                number: "Masukan Inputan Angka"
            }
        },
        submitHandler:function(){
            var data = $('#form_pemasukan').serialize();

            $.ajax({
                url: "ajax/add/pemasukan.php",
                data: data,
                type: "post",
                beforeSend:function(){
                    $('.icon-load').addClass("fal fa-spinner fa-spin");
                },
                complete:function(){
                    $('.icon-load').removeClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Formulir Kosong !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#tambah_pemasukan').modal('hide');
                    }
                    else if(response == "sukses")
                    {
                        $('#form_pemasukan')[0].reset();
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Tambah Data Pemasukan !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#tambah_pemasukan').modal('hide');
                        validate.resetForm();
                        pemasukan.ajax.reload(0);
                    }
                    else
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Terjadi Kesalahan !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#tambah_pemasukan').modal('hide');
                    }
                }
            });
        }
    });
});

$('.data-pemasukan').on('click', '.update', function(){
    var id = $(this).data("id");

    $.ajax({
        url: "ajax/method/update_pemasukan.php",
        data: {id:id},
        type: "post",
        beforeSend:function(){
            $('.icon-load').addClass("fal fa-spinner fa-spin");
        },
        complete:function(){
            $('.icon-load').removeClass("fal fa-spinner fa-spin");
        },
        success:function(response)
        {
            $('#ubah_pemasukan').modal('show');
            $('#form_edit_pemasukan').html(response);
        }
    });
});

$('#form_edit_pemasukan').on('click', '.update', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // dd-mm-yyyy
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );

    var validate = $('#form_edit_pemasukan').validate({
        rules: {
            tgl_pemasukan: {
                required: true,
                date: true
            },
            ket_pemasukan: {
                required : true
            },
            sum_pemasukan: {
                required : true
            },
            jumlah_pemasukan: {
                required: true,
                number: true
            }
        }, 
        messages: {
            tgl_pemasukan: {
                required: "Tanggal Pemasukan Tidak Boleh Kosong !",
                date: "Masukan tanggal dengan format : dd-mm-yyyy"
            },
            ket_pemasukan: "Keterangan Pemasukan Tidak Boleh Kosong !",
            sum_pemasukan: "Sumber Pemasukan Tidak Boleh Kosong !",
            jumlah_pemasukan: {
                required: "Jumlah Pemasukan Tidak Boleh Kosong !",
                number: "Input Hanya Berupa Angka !"
            }
        },
        submitHandler:function(){
            var data = $('#form_edit_pemasukan').serialize();

            $.ajax({
                url: "ajax/update/pemasukan.php",
                data: data,
                type: "post",
                beforeSend:function(){
                    $('.icon-load').addClass("fal fa-spinner fa-spin");
                },
                complete:function(){
                    $('.icon-load').removeClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Formulir Kosong !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#ubah_pemasukan').modal('hide');
                    }
                    else if(response == "sukses")
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Ubah Data Pemasukan !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#ubah_pemasukan').modal('hide');
                        validate.resetForm();
                        pemasukan.ajax.reload(0);
                    }
                    else
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Error Terjadi Kesalahan !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#ubah_pemasukan').modal('hide');
                    }
                }
            });
        }
    });
});

$('.data-pemasukan').on('click', '.delete', function(){
    var id = $(this).data("id");

    $.ajax({
        url: "ajax/method/konfirmasi_hapus_pemasukan.php",
        data: {id:id},
        type: "post",
        beforeSend:function(){
            $('.icon-load').addClass("fal fa-spinner fa-spin");
        },
        complete:function(){
            $('.icon-load').removeClass("fal fa-spinner fa-spin");
        },
        success:function(response)
        {
            $('#hapus_pemasukan').modal('show');
            $('#form_hapus_pemasukan').html(response);
        }
    });
});

$('#form_hapus_pemasukan').on('click', '.yes', function(){
    var data = $("#form_hapus_pemasukan").serialize();

    $.ajax({
        url: "ajax/delete/pemasukan.php",
        data: data,
        type: "post",
        beforeSend:function(){
            $('.icon-load').addClass("fal fa-spinner fa-spin");
        },
        complete:function(){
            $('.icon-load').removeClass("fal fa-spinner fa-spin");
        },
        success:function(response)
        {
            if(response == "invalid")
            {
                $('#msg').show();
                $('#msg').html('<div class="alert alert-danger text-white bg-danger"><em class="fas fa-times-circle"></em> ID Tidak Valid </div>');
                $('#msg').delay(5000).fadeOut("slow");
                $("#hapus_pemasukan").modal('hide');
            }
            else if(response == "sukses")
            {
                $('#msg').show();
                $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Hapus Data Pemasukan !</div>');
                $('#msg').delay(5000).fadeOut("slow");
                $('#hapus_pemasukan').modal('hide');
                pemasukan.ajax.reload(0);
            }
            else
            {
                $('#msg').show();
                $('#msg').html('<div class="alert alert-danger text-white bg-danger"><em class="fas fa-times-circle"></em> Error Terjadi Kesalahan ! </div>');
                $('#msg').delay(5000).fadeOut("slow");
                $("#hapus_pemasukan").modal('hide');
            }
        }
    });
});

var pengeluaran = $('.data-pengeluaran').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "ajax/data/pengeluaran.php",
    "fnRowCallback": function(nRow, aData, iDisplayIndex) {
        var info = $(this).DataTable().page.info();
        $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
        return nRow;
    }
});

$(".add-pengeluaran").click(function(){
    $('#tambah-pengeluaran').modal("show");
});

$('#form_pengeluaran').on('click', '.add', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // dd-mm-yyyy
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );

    var validate = $('#form_pengeluaran').validate({
        rules:{
            tgl_pengeluaran: {
                required: true,
                date: true
            },
            ket_pengeluaran:{
                required: true
            },
            utk_pengeluaran:{
                required: true
            },
            jumlah_pengeluaran:{
                required: true,
                number: true
            }
        },
        messages: {
            tgl_pengeluaran:{
                required: "Tanggal Pemasukan Tidak Boleh Kosong !",
                date: "Masukan Tanggal Pengeluaran Dengan Format : dd-mm-yyyy"
            },
            ket_pengeluaran: "Keterangan Pengeluaran Tidak Boleh Kosong !",
            utk_pengeluaran: "Untuk Pengeluaran Tidak Boleh Kosong !",
            jumlah_pengeluaran: {
                required: "Jumlah Pengeluaran Tidak Boleh Kosong !",
                number: "Input Hanya Berupa Angka !"
           }
        },
        submitHandler:function()
        {
            var data = $('#form_pengeluaran').serialize();

            $.ajax({
                url: "ajax/add/pengeluaran.php",
                data: data,
                type: "post",
                timeout: 2000,
                beforeSend: function() {
                    $('.icon').addClass("fal fa-spinner fa-spin");
                },
                complete: function(){
                    $('.icon').removeClass("fal fa-spinner fa-spin");
                },
                success:function(response)
                {
                    if(response == "null")
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Form Kosong !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#tambah-pengeluaran').modal("hide");
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        })
                    }
                    else if(response == "sukses")
                    {
                        $('#form_pengeluaran')[0].reset();
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Tambah Data Pengeluaran !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#tambah-pengeluaran').modal("hide");
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        });
                        pengeluaran.ajax.reload(0);
                        validate.resetForm();
                    }
                    else
                    {
                        $('#msg').show();
                        $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Error Terjadi Kesalahan !</div>');
                        $('#msg').delay(5000).fadeOut('slow');
                        $('#tambah-pengeluaran').modal("hide");
                        $(window).on('load', function(){
                            window.setTimeout(function(){
                                $('.icon').removeClass("fal fa-spinner fa-spin");
                            }, 2000)
                        })
                    }
                }
            });
        }
    });
});

$('.data-pengeluaran').on('click', '.update', function(){
    var id = $(this).data("id");

    $.ajax({
        url: "ajax/method/update_pengeluaran.php",
        data: {id:id},
        type: "post",
        success:function(response)
        {
            $('#update_pengeluaran').modal("show");
            $('#form_update_pengeluaran').html(response);
        }
    });
});

$('#form_update_pengeluaran').on('click', '.update', function(){
    $.validator.addMethod(
        "date",
        function(value, element) {
            // dd-mm-yyyy
            var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

            // valid if optional and empty OR if it passes the regex test
            return (this.optional(element) && value=="") || re.test(value);
        }
    );

    var validate = $('#form_update_pengeluaran').validate({
        rules: {
            tgl_pengeluaran:{
                required: true,
                date: true
            },
            ket_pengeluaran:{
                required: true
            },
            utk_pengeluaran:{
                required: true
            },
            jumlah_pengeluaran: {
                required: true,
                number: true
            }
        },
        messages:{
            tgl_pengeluaran:{
                required: "Tanggal Pengeluaran Tidak Boleh Kosong !",
                date: "Masukan Tanggal Pengeluaran Dengan Format : dd-mm-yyyy"
            },
            ket_pengeluaran:{
                required: "Keterangan Pengeluaran Tidak Boleh Kosong !"
            },
            utk_pengeluaran: {
                required: "Untuk Pengeluaran Tidak Boleh Kosong !"
            },
            jumlah_pengeluaran: {
                required: "Jumlah Pengeluaran Tidak Boleh Kosong !",
                number: "Input Hanya Berupa Angka !"
            },
        },
        submitHandler:function()
            {
                var data = $('#form_update_pengeluaran').serialize();

                $.ajax({
                    url: "ajax/update/pengeluaran.php",
                    data: data,
                    type: "post",
                    beforeSend:function(){
                        $('.icon').addClass("fal fa-spinner fa-spin");
                    },
                    success:function(response)
                    {
                        if(response == "null")
                        {
                            $('#msg').show();
                            $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Form Kosong !</div>');
                            $('#msg').delay(5000).fadeOut('slow');
                            $('#update_pengeluaran').modal("hide");
                            $(window).on('load', function(){
                                window.setTimeout(function(){
                                    $('.icon').removeClass("fal fa-spinner fa-spin");
                                }, 2000)
                            });
                        }
                        else if(response == "sukses")
                        {
                            $('#form_update_pengeluaran')[0].reset();
                            $('#msg').show();
                            $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Ubah Data Pengeluaran !</div>');
                            $('#msg').delay(5000).fadeOut('slow');
                            $('#update_pengeluaran').modal("hide");
                            $(window).on('load', function(){
                                window.setTimeout(function(){
                                    $('.icon').removeClass("fal fa-spinner fa-spin");
                                }, 2000)
                            });
                            pengeluaran.ajax.reload(0);
                            validate.resetForm();
                        }
                        else
                        {
                            $('#msg').show();
                            $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Error Terjadi Kesalahan !</div>');
                            $('#msg').delay(5000).fadeOut('slow');
                            $('#update_pengeluaran').modal("hide");
                            $(window).on('load', function(){
                                window.setTimeout(function(){
                                    $('.icon').removeClass("fal fa-spinner fa-spin");
                                }, 2000)
                            });
                        }
                    }
                });
            }
    });
});

$('.data-pengeluaran').on('click', '.delete', function(){
    var id = $(this).data('id');

    $.ajax({
        url: "ajax/method/delete_pengeluaran.php",
        data: {id:id},
        type: "post",
        success:function(response)
        {
            $('#delete_pengeluaran').modal('show');
            $('#form_delete_pengeluaran').html(response);
        }
    });
});

$('#form_delete_pengeluaran').on('click', '.delete', function(){
    var data = $('#form_delete_pengeluaran').serialize();

    $.ajax({
        url: "ajax/delete/pengeluaran.php",
        data: data,
        type: 'post',
        beforeSend:function(){
            $('.icon').addClass("fal fa-spinner fa-spin");
        },
        success:function(response)
        {
            if(response == "sukses")
            {
                $('#msg').show();
                $('#msg').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check-circle"></em> Berhasil Hapus Data Pengeluaran !</div>');
                $('#msg').delay(5000).fadeOut('slow');
                $('#delete_pengeluaran').modal("hide");
                $(window).on('load', function(){
                    window.setTimeout(function(){
                        $('.icon').removeClass("fal fa-spinner fa-spin");
                    }, 2000)
                });
                pengeluaran.ajax.reload(0);
            }
            else
            {
                $('#msg').show();
                $('#msg').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times-circle"></em> Error Terjadi Kesalahan !</div>');
                $('#msg').delay(5000).fadeOut('slow');
                $('#delete_pengeluaran').modal("hide");
                $(window).on('load', function(){
                    window.setTimeout(function(){
                        $('.icon').removeClass("fal fa-spinner fa-spin");
                    }, 2000)
                });
            }
        }
    });
});