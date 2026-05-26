<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
$user_data = $_SESSION['user'];
?>
<form id="profile-data">
    <div class="row g-3">
        <div class="col">
            <div class="row g-0 ">
                <label for="profile_img" class="fw-bold">Foto Profil</label>
                <div class="col-auto m-2">
                    <img src="<?= $user_data['foto'] ?>" alt="Foto Profil" class="img-thumbnail" id="profile_img_preview" style="max-width: 150px;">
                </div>
                <div class="col">
                    <input type="file" name="profile_img" id="profile_img" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
        <div class="col">
            <div>
                <label for="name" class="fw-bold">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= isset($user_data['nama']) ? $user_data['nama'] : '' ?>">
            </div>
            <div>
                <label for="telepon" class="fw-bold">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control" value="<?= isset($user_data['no_telp']) ? $user_data['no_telp'] : '' ?>">
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <label for="username" class="fw-bold">Username</label>
            <input type="text" name="username" id="username" class="form-control mb-2" value="<?= isset($user_data['username']) ? $user_data['username'] : '' ?>">
        </div>
        <div class="col">
            <label for="email" class="fw-bold">Email</label>
            <input type="email" name="email" id="email" class="form-control mb-2" value="<?= isset($user_data['email']) ? $user_data['email'] : '' ?>">
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <label for="password" class="fw-bold">Password</label>
            <input type="password" name="password" id="password" class="form-control mb-2" value="">
        </div>
        <div class="col">
            <label for="confirm_password" class="fw-bold">Konfirmasi Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control mb-2" value="">
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <button class="btn btn-primary" id="save_profile">Simpan Perubahan</button>
        </div>
    </div>
</form>
<script>
    $("#profile_img").change(function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                $("#profile_img_preview").attr("src", e.target.result);
            }

            reader.readAsDataURL(file);
        }
    });

    $("#profile-data").submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "/model/akun_model.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(response) {

                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },

            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan server.");
            }
        });
    });
</script>