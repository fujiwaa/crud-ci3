                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-8">
                        <?= form_error('addrps', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        
                        <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AddRps">Tambah RPS</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Kode Mata Kuliah</th>
                                    <th scope="col">Nama Mata Kuliah</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Tanggal Disusun</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($menu as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $m['kode_matkul']; ?></td>
                                    <td><?= $m['nama_matkul']; ?></td>
                                    <td><?= $m['semester']; ?></td>
                                    <td><?= $m['tanggal_disusun']; ?></td>
                                    <td>
                                        <a href="<?= base_url('menu/detail_rps?id=' . $m['id'])?>" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-eye"></i> Lihat
                                        </a>
                                        <!-- <form action="<?= base_url('menu/cetak_rps?id=' . $m['id']) ?>" method="GET" class="d-inline" id="cetak-rps-<?= $m['id'] ?>">
                                        </form> -->
                                        <a href="<?= base_url('menu/cetak_rps?id=' . $m['id'])?>" class="btn btn-sm btn-success">
                                            <i class="mdi mdi-printer"></i> Cetak
                                        </a>
                                        <a href="<?= base_url('menu/delete?id=' . $m['id'])?>" class="btn btn-sm btn-danger">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            
            <!-- Modal -->
           <div class="modal fade" id="AddRps" tabindex="-1" aria-labelledby="AddRpsLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="AddRpsLabel">Tambah RPS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('menu/tambah_rps_aksi'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <select class="form-select" name="id_matkul">
                                <option selected>Pilih Matkul</option>
                                <?php foreach ($matkuls as $matkul) : ?>
                                    <option value="<?= $matkul->id ?>"><?= $matkul->kode_matkul ?> - <?= $matkul->nama_matkul ?></option>
                                <?php endforeach; ?>
                            </select>
                        <label for="floatingSelect">Mata Kuliah</label>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester">
                        </div>
                        <div class="form-group">
                            <label for="bobot_sks">Bobot SKS</label>
                            <input type="text" class="form-control" id="bobot_sks" name="bobot_sks" placeholder="Bobot SKS">
                        </div>
                        <div class="form-group">
                            <label for="detail_penilaian">Detail Penilaian</label>
                            <textarea class="form-control border border-info" name="detail_penilaian" id="ck_dp"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Gambaran_umum">Gambaran Umum</label>
                            <textarea class="form-control border border-info" name="gambaran_umum" id="ck_gu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Gambaran_umum">Capaian</label>
                            <textarea class="form-control border border-info" name="capaian" id="ck_cp"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Gambaran_umum">Prasyarat</label>
                            <textarea class="form-control border border-info" name="prasyarat" id="ck_pr"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan RPS</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div> 