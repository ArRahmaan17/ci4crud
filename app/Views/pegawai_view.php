<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title><?= $title ?></title>
  <style>
    .container {
      max-width: 900px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <?= $title ?>
      </div>
      <div class="card-body">
        <form action="" method="get">
          <div class="input-group mb-3">
            <input type="text" autocomplete="off" name="katakunci" value="<?= $katakunci ?>" class="form-control" placeholder="Kata Kunci Pencarian" aria-label="Kata Kunci Pencarian" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
          </div>
        </form>
        <!-- modal -->
        <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Tambah Data Pegawai</a>
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Form Input Data Pegawai</h5>
                <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="alert alert-success sukses" role="alert" style="display: none;">
                </div>
                <div class=" alert alert-danger error" role="alert" style="display: none;">
                </div>
                <input type="hidden" id="inputId">
                <div class="mb-3 row">
                  <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" autocomplete="off" maxlength="50" minlength="5" class="form-control" id="inputNama">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" autocomplete="off" maxlength="50" minlength="5" class="form-control" id="inputEmail">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="bidang" id="inputBidang">
                      <option value="finance">Finance</option>
                      <option value="marketing">Marketing</option>
                      <option value="hr">HR</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" autocomplete="off" maxlength="50" minlength="5" class="form-control" id="inputAlamat">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="tombolSimpan" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Table Data Pegawai -->
        <div class="container-md ">
          <div class="row align-items-center">
            <div class="col-12">
              <!-- table data pegawai -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Bidang</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $p => $pegawai) {
                    $nomer = $nomer + 1
                  ?>
                    <tr>
                      <th scope="row"><?= $nomer ?></th>
                      <td><?= $pegawai['nama'] ?></td>
                      <td><?= $pegawai['email'] ?></td>
                      <td><?= $pegawai['bidang'] ?></td>
                      <td><?= $pegawai['alamat'] ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" href="#exampleModalToggle" role="button" onclick="edit(<?= $pegawai['id'] ?>)">Edit</button>
                        <button type=" button" class="btn btn-danger btn-sm" onclick="hapus(<?= $pegawai['id'] ?>)">Delete</button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php
        $link = $pager->links();
        $link = str_replace('<li class="active">', '<li class="page-item active">', $link);
        $link = str_replace('<li>', '<li class="page-item">', $link);
        $link = str_replace('<a', '<a class="page-link"', $link);
        echo $link;
        ?>
      </div>
      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

      <script>
        function hapus($id) {
          var result = confirm("yakin Mau Delete?");
          if (result) {
            window.location = "<?= base_url('Pegawai/hapus') ?>/" + $id;
          }
        }

        function edit($id) {
          $.ajax({
            url: "<?= base_url('Pegawai/edit') ?>/" + $id,
            type: "get",
            success: function(hasil) {
              var $hasilobj = $.parseJSON(hasil);
              if ($hasilobj.id != null) {
                $('#inputId').val($hasilobj.id);
                $('#inputNama').val($hasilobj.nama);
                $('#inputEmail').val($hasilobj.email);
                $('#inputBidang').val($hasilobj.bidang);
                $('#inputAlamat').val($hasilobj.alamat);
              }
            }
          });
        }

        function bersihkan() {
          $('#inputId').val('');
          $('#inputNama').val('');
          $('#inputEmail').val('');
          $('#inputAlamat').val('');
        }

        $('.tombol-tutup').on('click', function() {
          if ($('.sukses').is(':visible')) {
            window.location.href = "<?= current_url() . "?" . $_SERVER['QUERY_STRING']  ?>";
          }
          $('.alert').hide();
          bersihkan();
        });

        $('#tombolSimpan').on('click', function() {
          var $id = $('#inputId').val();
          var $nama = $('#inputNama').val();
          var $email = $('#inputEmail').val();
          var $bidang = $('#inputBidang').val();
          var $alamat = $('#inputAlamat').val();

          $.ajax({
            url: "<?= base_url('Pegawai/simpan') ?>",
            type: "POST",
            data: {
              'id': $id,
              'nama': $nama,
              'email': $email,
              'bidang': $bidang,
              'alamat': $alamat,
            },
            success: function(hasil) {
              var $hasilobj = $.parseJSON(hasil);
              if ($hasilobj.status == true) {
                $('.error').hide();
                $('.sukses').show();
                $('.sukses').html($hasilobj.pesan);
                window.location.href = "<?= current_url()?>";
                bersihkan();
              } else {
                $('.suskses').hide();
                $('.error').show();
                $('.error').html($hasilobj.pesan);
              }
            }
          });
        });
      </script>
</body>

</html>