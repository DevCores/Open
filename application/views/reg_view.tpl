<?php
            if (!empty($data['error'])) {

                echo "
                  <div class=\"alert alert-danger\">
".$data['error']."
</div>
";

} elseif (!empty($data['succes'])) {
echo "
<div class=\"alert alert-success\">
".$data['succes']."
</div>";
}
?>
<div class="login-title"><strong>{CHECKINREG}</strong></div>
<form action="" class="form-horizontal" method="post">
    <div class="form-group">
        <div class="col-md-12">
            <input type="text" name="account" class="form-control" placeholder="{LOGIN}" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="email" name="mail" class="form-control" placeholder="{EMAIL}" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" name="password" class="form-control" placeholder="{PASSWORD}" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" name="password_2" class="form-control" placeholder="{REPAITPASSWORD}" required autocomplete="off"/>
        </div>
    </div>
    <?php
                      if (!class_exists( 'KeyCAPTCHA_CLASS')) { // Replace '/home/path_to_keycaptcha_file/' with the real path to keycaptcha.php 
                    include( './application/captcha/keycaptcha.php');
                     } 
                     $kc_o= new KeyCAPTCHA_CLASS(); echo $kc_o->render_js(); ?>

    <input type="hidden" name="capcode" id="capcode" value="false"/>

    <div class="form-group">
        <div class="col-md-6">
            <button class="btn btn-info btn-block" id="postbut" name="reg">Зарегистрировать</button>
        </div>
    </div>
</form>
</div>
<div class="login-footer">
    <div class="pull-left">
        &copy; 2016 {PROJECT}
    </div>
    <div class="pull-right">
        <a href="/login">{SINGIN}</a>
    </div>
</div>

