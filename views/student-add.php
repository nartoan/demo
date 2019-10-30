<?php require_once "views/commons/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Tên</label>
        <span id="name-info" class="info"></span>
        <br />
        <input type="text" name="name" id="name" class="demoInputBox">
    </div>
    <div>
        <label>Điểm</label>
        <span id="roll-number-info" class="info"></span>
        <br />
        <input type="text" name="grade" id="roll_number" class="demoInputBox">
    </div>
    <div>
        <label>Ngày sinh</label>
        <span id="dob-info" class="info"></span>
        <br />
        <input type="date" name="dob" id="dob" class="demoInputBox">
    </div>
    <div>
        <label>Lớp</label>
        <span id="class-info" class="info"></span>
        <br />
        <input type="text" name="class" id="class" class="demoInputBox">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div>
</form>
<?php require_once "views/commons/footer.php"; ?>