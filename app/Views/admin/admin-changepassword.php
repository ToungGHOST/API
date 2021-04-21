<div class="container-fluid">
    <div class="row">

        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">เปลี่ยนรหัสผ่าน</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php if (!empty(session()->getFlashdata('notification-success'))) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('notification-success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php } ?>
                    <?php if (!empty(session()->getFlashdata('notification-danger'))) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('notification-danger'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php } ?>
                    <form method="post">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="old_password">รหัสผ่านเดิม</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="รหัสผ่านเดิม" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password">รหัสผ่านใหม่</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="รหัสผ่านใหม่" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password_con">ยืนยันรหัสผ่านใหม่</label>
                                <input type="password" class="form-control" name="new_password_con" id="new_password_con" placeholder="ยืนยันรหัสผ่านใหม่" required>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">ยืนยันข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>



    </div>

</div>