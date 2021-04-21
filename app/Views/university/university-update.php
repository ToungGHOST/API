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
                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลสถาบัน</h6>

                </div>
                <!-- Card Body -->

                <div class="card-body">

               
                    <form method="post">
                    <?php foreach ($data as $item) : ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="hidden" class="form-control" id="user_id" name="id" placeholder="" value="<?= $item['cou_id']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ชื่อสถาบัน</label>
                                <input type="text" class="form-control" id="firstname" name="name_th" placeholder="ชื่อไทย" value="<?= $item['cou_name_th']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">ชื่อ(รอง)</label>
                                <input type="text" class="form-control" id="lastname" name="name_en" placeholder="ชื่ออังกฤษ" value="<?= $item['cou_name_en']; ?>">
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="inputAddress">เลขกำกับถาษี 13 หลัก</label>
                                <input type="number" class="form-control" id="idcard" maxlength="13" name="idcard" placeholder="" value="<?= $item['cou_tax_id']; ?>" >
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="inputAddress">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= $item['cou_email']; ?>">
                            </div>
                        
                            <div class="form-group col-md-5">
                                <label for="inputAddress">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="phone" maxlength="10" minlength="10"name="phone" placeholder="เบอร์โทรศัพท์" value="<?= $item['phone']; ?>">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="status">สถานะ</label>
                                <select name="status" class="form-control">
                                    <option value="0" <?php if($item['status']==0){echo "selected";} ?>>ไม่อนุมัติ</option>
                                    <option value="1"<?php if($item['status']==1){echo "selected";} ?>>อนุมัติ</option>
                                    <option value="2"<?php if($item['status']==2){echo "selected";} ?>>แบน</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="inputAddress">รายละเอียด</label>
                                <textarea  type="text" class="form-control"  style="resize:none" id="description" name="description" placeholder="รายละเอียด"><?= $item['cou_description']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">ที่อยู่</label>
                                <textarea  type="text" class="form-control"  style="resize:none" id="address" name="address" placeholder="ที่อยู่"><?= $item['address']; ?>
                                </textarea>
                            </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="province_id">จังหวัด</label>
                                <select id="province_id" name="province_id"class="form-control">
                                    <option value="<?= $item['provinceID']; ?>" selected><?= $item['provinceName']; ?></option>
                                    <!-- <option selected>= เลือก =</option> -->
                              
                                    <!--  -->
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphur_id">เขต/อำเภอ</label>
                                <select id="amphur_id" name="amphur_id" class="form-control">
                                <option value="<?= $item['amphurID']; ?>" selected><?= $item['amphurName']; ?></option>
                                    <!-- <option selected>= เลือก =</option> -->
                                </select>
                            </div>
                           
                        </div>
                  

                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    <?php endforeach; ?>
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
            url: "<?php echo site_url(); ?>admin/getprovince",
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
                    url: "<?php echo site_url(); ?>admin/getamphur",
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

  
    })
</script>