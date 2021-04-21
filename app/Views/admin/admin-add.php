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
                    <h6 class="m-0 font-weight-bold text-primary">เพิ่มผู้ดูแลระบบ</h6>

                </div>
                <!-- Card Body -->

                <div class="card-body">


                    <form method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ชื่อ</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ"required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="นามสกุล"required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required> 
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required> 
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Password</label>
                            <input type="password" class="form-control" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                             placeholder="Password">
                            <div id="message">
                                <p>กำหนดรหัสผ่าน</p>
                                <p id="letter" class="invalid"><b>อักษรตัวพิมพ์เล็ก(a-z)</b></p>
                                <p id="capital" class="invalid"><b>อักษรตัวพิมพ์ใหญ่(A-Z)</b></p>
                                <p id="number" class="invalid"><b>ตัวเลข(0-9)</b></p>
                                <p id="length" class="invalid"><b>รหัสอย่างน้อย 8 ตัว</b></p>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    </form>
                
                </div>
            </div>
        </div>



    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
