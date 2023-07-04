                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-6">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($role as $r) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $r['role']; ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/roleakses/') . $r['id']; ?>" class="badge badge-warning text-decoration-none">Access</a>
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