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
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar siswa</h5>
                    <a href="<?php echo base_url('admin/tambah_siswa') ?>" class="btn btn-success m-2">
                        <i></i> Tambah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama siswa</th>
                                <th>NISN</th>
                                <th>Gender</th>
                                <th>Mapel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($siswa as $row):
                                $no++ ?>
                                <tr>
                                    <td>
                                        <?php echo $no ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nama_siswa ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nisn ?>
                                    </td>
                                    <td>
                                        <?php echo $row->gender ?>
                                    </td>
                                    <td>
                                        <?php echo tampil_full_kelas_byid($row->id_kelas) ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/ubah_siswa/') . $row->id_siswa ?>"
                                            class="btn btn-primary">
                                            <i></i> ubah
                                        </a>
                                        <button onClick="hapus(<?php echo $row->id_siswa; ?>)" class="btn btn-danger">
                                            <i></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    function hapus(id) {
        var yes = confirm('Yakin Di Hapus?');
        if (yes == true) {
            window.location.href = "<?php echo base_url('admin/hapus_siswa/')?>" + id;
        }
    }
    </script>
</body>

</html>