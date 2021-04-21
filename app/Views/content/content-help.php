<div class="container-fluid">
    <div class="row">

        <div class="col-xl-12">
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
                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลช่วยเหลือ</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post">
                    <?php foreach ($data as $item) : ?>
                            <input type="hidden" class="form-control" id="id" name="id"  value="<?= $item['id']; ?>">       
                            <div class="form-group">
                                <label for="inputAbout">ช่วยเหลือ</label>
                                <textarea name="help_detail" class="form-control" id="help" cols="30" rows="10"><?= $item['help_detail']; ?></textarea>
                            </div>
                    <?php endforeach; ?>                     
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div>



    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
