<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex">
        <div>
            <?php $this->load->view('components/sidebar')?>
        </div>

        <div class="container mt-12">
            <?php $this->load->view('components/navbar')?>
            <div class="card mb-4 shadow">
            <div class="card-body">
                <h5 class="card-title">Edit Data Siswa</h5>
                <?php foreach ($siswa as $data_siswa): ?>
                    <form action="<?php echo base_url('admin/aksi_ubah_siswa') ?>" enctype="multipart/form-data"
                        method="POST">
                        <input name="id_siswa" type="hidden" value="<?php echo $data_siswa->id_siswa ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan Nama Siswa" value="<?php echo $data_siswa->nama_siswa ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        placeholder="Masukkan NISN" value="<?php echo $data_siswa->nisn ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option selected value="<?php echo $data_siswa->gender ?>">
                                            <?php echo $data_siswa->gender ?>
                                        </option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <label for="mapel">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option selected value="<?php $data_siswa->id_kelas ?>">
                                        <?php echo tampil_full_kelas_byid($data_siswa->id_kelas) ?>
                                    </option>
                                    <?php foreach ($kelas as $row): ?>
                                        <option value="<?php echo $row->id ?>">
                                            <?php echo $row->tingkat_kelas . ' ' . $row->jurusan_kelas ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary text-dark">Simpan</button>
                    </form>
                <?php endforeach ?>
            </div>
        </div>
        </div>
    </div>
</body>

</html>