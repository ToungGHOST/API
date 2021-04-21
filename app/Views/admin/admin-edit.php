<div class="container-fluid">
    <div class="row">

        <div class="col-xl-8">
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
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูล</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post">

                        <?php foreach ($data as $item) : ?>
                            <div class="col-md-6 mb-3">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="First name" value="<?= $item['id']; ?>" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="show_email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="XXXX@EMAILL.COM" value="<?= $item['admin_email']; ?>"required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault01">ชื่อจริง</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="<?= $item['firstname']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">นามสกุล</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" value="<?= $item['lastname']; ?>" required>
                                </div>

                            </div>


                            <button class="btn btn-primary" type="submit">แก้ไขข้อมูล</button>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>



    </div>

</div>