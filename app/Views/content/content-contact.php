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
                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลติดต่อ</h6>

                </div>
                <!-- Card Body -->

                <div class="card-body">
                    <form method="post">
                    <?php foreach ($data as $item) : ?>
                            <input type="hidden" class="form-control" id="id" name="id"  value="<?= $item['conus_id']; ?>">       
                            <div class="form-group">
                                <label for="inputAddress">ที่อยู่</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?= $item['conus_address']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">เวลาทำการ</label>
                                <input type="text" class="form-control" id="ourservice" name="ourservice" placeholder="" value="<?= $item['conus_ourservice']; ?>">
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">อีเมลล์ฝ่ายลูกค้า/แนะนำบริการ</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= $item['conus_email']; ?>">
                            </div>
                        
                            <div class="form-group col-md-6">
                                <label for="inputAddress">อีเมลล์ฝ่ายการตลาด/เสนอขายสินค้า</label>
                                <input type="text" class="form-control" id="email" name="email1" placeholder="name@example.com" value="<?= $item['conus_email1']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">อีเมลล์ฝ่ายบุคคล/สมัครงาน</label>
                                <input type="email" class="form-control"id="email" name="email2" placeholder="name@example.com" value="<?= $item['conus_email2']; ?>">
                            </div>
                        
                            <div class="form-group col-md-6">
                                <label for="inputAddress">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="phone"name="phone" placeholder="เบอร์โทรศัพท์" value="<?= $item['conus_tel']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="<?= $item['conus_facebook']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Line</label>
                                <input type="text" class="form-control" id="line" name="line" placeholder="Line" value="<?= $item['conus_line']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?= $item['conus_instagram']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Youtube</label>
                                <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Youtube" value="<?= $item['conus_youtube']; ?>">
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="inputAddress">ตำแหน่งบน Googlemap (Lat/Lon)</label>
                                <input type="text" class="form-control" id="latlon"  name="latlon" placeholder="" value="<?= $item['conus_latlon']; ?>" >
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
<script>
    $(document).ready(function() {
        $.ajax({
            method: "GET",
            url: "<?php echo site_url(); ?>adminmanagement/getprovince",
            success: function(data) {
                $('#province_id').append(data);
                // $('#amphur_id').html('<option value="">= เลือก =</option>');
                // $('#district_id').html('<option value="">= เลือก =</option>');
            },

        });


        $('#province_id').change(function() {
            var province_id = $('#province_id').val();
            if (province_id != '') {
                $.ajax({
                    method: "POST",
                    url: "<?php echo site_url(); ?>adminmanagement/getamphur",
                    data: {
                        province_id: province_id
                    },
                    success: function(data) {
                        $('#amphur_id').html(data);
                        // $('#district_id').html('<option value="">= เลือก =</option>');
                    },

                });
            } else {
                // $('#amphur_id').html('<option value="">= เลือก =</option>');
                // $('#district_id').html('<option value="">= เลือก =</option>');
            }
        });

        $('#amphur_id').change(function() {
            var amphur_id = $('#amphur_id').val();
            if (amphur_id != '') {
                $.ajax({
                    url: "<?php echo site_url(); ?>adminmanagement/getdistrict",
                    method: "POST",
                    data: {
                        amphur_id: amphur_id
                    },
                    success: function(data) {
                        $('#district_id').html(data);
                    }
                });
            } else {
                // $('#district_id').html('<option value="">= เลือก =</option>');
            }
        });
    })
</script>