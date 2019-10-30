<?php require_once "views/commons/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Tên</label>
        <span id="name-info" class="info"></span>
        <br />
        <input type="text" name="name" id="name" class="demoInputBox" value="<?php echo $result["name"]; ?>">
    </div>
    <div>
        <label>Điểm</label>
        <span id="roll-number-info" class="info"></span>
        <br /> 
        <input type="number" name="grade" id="roll_number" class="demoInputBox" value="<?php echo $result["grade"]; ?>">
    </div>
    <div>
        <label>Ngày sinh</label> 
        <span id="dob-info" class="info"></span>
        <br />
        <input type="text" name="dob" id="dob" class="demoInputBox" value="<?php echo $result["dob"]; ?>">
    </div>
    <div>
        <label>Lớp</label> 
        <span id="class-info" class="info"></span>
        <br />
        <input type="text" name="class" id="class" class="demoInputBox" value="<?php echo $result["class"]; ?>">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Save" />
    </div>
</form>

<?php require_once "views/commons/footer.php"; ?>