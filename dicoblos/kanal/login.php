<div class="inner cover login">
    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
        <form class="form-horizontal" method="POST" action="diadmin/core/user_auth.php">
            <h4>Masuk untuk memulai</h4>
            <div class="form-group-lg">
                <div class="input-group">
                    <span class="input-group-addon input-lg" id="addon1"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" name="nik" class="form-control input-lg" placeholder="Masukan NIK" required autofocus>
                </div><br>
                <div class="input-group">
                    <span class="input-group-addon input-lg" id="addon1"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" name="pswd" class="form-control input-lg" placeholder="Masukan Password" required>
                </div><br>
                <button class="btn btn-info btn-lg" name="loginBtn" type="submit">Masuk</button>
                <button class="btn btn-danger btn-lg" name="btnHelp" type="submit">Bantuan</button>
            </div>
            <div class="divider">&nbsp;</div>
            <?php
            error_reporting(0);
            if($_GET['info'] == 'a1')
                {
                echo "<div class='alert alert-danger'>"
                . "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
                . "<strong> NIK / Password salah </strong>"
                . "</div>";
            }  else if($_GET['info'] == 'a2'){
                echo "<div class='alert alert-success'>"
                . "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
                . "<strong>Terima kasih  telah menggunakan hak pilih Anda dengan bijak</strong>"
                . "</div>";
            }
            ?>
        </form>
    </div>
</div>    