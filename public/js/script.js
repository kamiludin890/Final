/** @format */

function hasAkses(menu) {
  if (typeof aksesUser === "undefined" || aksesUser === null) return true;
  return aksesUser.indexOf(menu) !== -1;
}

function tampilAksesDitolak(namaMenu) {
  $("#main-content").html(`
    <div class="d-flex flex-column align-items-center justify-content-center text-center py-5 text-muted" style="min-height:300px">
      <i class="bi bi-lock-fill" style="font-size:4rem;color:#dc3545;"></i>
      <h4 class="mt-3 text-danger">Akses Ditolak</h4>
      <p class="mb-0">Anda tidak memiliki izin untuk membuka menu <strong>${namaMenu}</strong>.</p>
      <small>Hubungi Administrator untuk mengatur hak akses.</small>
    </div>
  `);
}

$(document).ready(function () {
  $.post("view/dashboard.php", function (data) {
    $("#main-content").html(data);
  });
});

$("#toggleSidebar").on("click", function () {
  $("#sidebar").toggle();
  $(this).find("i").toggleClass("bi-x-lg bi-list");
});

function setActive(el) {
  $(".nav-link").removeClass("active");
  el.classList.add("active");
}

$("#dashboard").click(function () {
  if (!hasAkses("dashboard")) {
    tampilAksesDitolak("Dashboard");
    setActive(this);
    return;
  }
  $.post("view/dashboard.php", function (data) {
    $("#main-content").html(data);
  });
  setActive(this);
});

$("#data").click(function () {
  if (!hasAkses("data")) {
    tampilAksesDitolak("Data");
    setActive(this);
    return;
  }
  $.post("view/data.php", function (data) {
    $("#main-content").html(data);
  });
  setActive(this);
});

$("#laporan").click(function () {
  if (!hasAkses("laporan")) {
    tampilAksesDitolak("Laporan");
    setActive(this);
    return;
  }
  $.post("view/laporan.php", function (data) {
    $("#main-content").html(data);
  });
  setActive(this);
});

$("#pengaturan").click(function () {
  if (!hasAkses("pengaturan")) {
    tampilAksesDitolak("Pengaturan");
    setActive(this);
    return;
  }
  $.post("view/pengaturan.php", function (data) {
    $("#main-content").html(data);
  });
  setActive(this);
});
