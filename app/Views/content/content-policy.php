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
                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลนโยบาย</h6>

                </div>
                <!-- Card Body -->

                <div class="card-body">
                    <form method="post">
                    <?php foreach ($data as $item) : ?>
                            <input type="hidden" class="form-control" id="id" name="id"  value="<?= $item['po_id']; ?>">       
                            <div class="form-group">
                                <label for="inputAbout">หัวข้อที่ 1</label>
                                <input type="text" class="form-control" id="abouthead" name="abouthead" placeholder="" value="<?= $item['po_container_1_title']; ?>">
                            </div>  
                            <div class="form-group">
                                <label for="inputAbout">รายละเอียดที่1</label>
                                <textarea name="aboutdetail" class="form-control" id="aboutdetail" cols="30" rows="10"><?= $item['po_container_1_detail']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputAbout">หัวข้อที่ 2</label>
                                <input type="text" class="form-control" id="abouthead_2" name="abouthead_2" placeholder="" value="<?= $item['po_container_2_title']; ?>">
                            </div>  
                            <div class="form-group">
                                <label for="inputAbout">รายละเอียดที่2</label>
                                <textarea name="aboutdetail_2" class="form-control" id="aboutdetail_2" cols="30" rows="10"><?= $item['po_container_2_detail']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputAbout">หัวข้อที่ 3</label>
                                <input type="text" class="form-control" id="abouthead_3" name="abouthead_3" placeholder="" value="<?= $item['po_container_3_title']; ?>">
                            </div>  
                            <div class="form-group">
                                <label for="inputAbout">รายละเอียดที่3</label>
                                <textarea name="aboutdetail_3" class="form-control" id="aboutdetail_3" cols="30" rows="10"><?= $item['po_container_3_detail']; ?></textarea>
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
