                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg">
                        <?php if(validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                        <?php endif; ?>

                        <?= $this->session->flashdata('message'); ?>
                        <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#SubAddRps">Add New Submenu</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($subMenu as $sm) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['title']; ?></td>
                                    <td><?= $sm['menu']; ?></td>
                                    <td><?= $sm['url']; ?></td>
                                    <td><?= $sm['icon']; ?></td>
                                    <td><?= $sm['is_active']; ?></td>
                                    <td>
                                        <a href="" class="badge badge-success text-decoration-none">edit</a>
                                        <a href="" class="badge badge-danger text-decoration-none">delete</a>
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
            
        <!-- Modal -->
    <div class="modal fade" id="SubAddRps" tabindex="-1" aria-labelledby="SubAddRpsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="SubAddRpsLabel">Tambah RPS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="modal-body">
                        <!-- <div class="form-floating">
                            <select class="form-select" id="fakultas">
                                <option selected>Pilih Fakultas</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        <label for="floatingSelect">Fakultas</label>
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu berapa?">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id">
                                <option value="">Select Menu</option>
                                <?php foreach($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">Active?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan Submenu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>