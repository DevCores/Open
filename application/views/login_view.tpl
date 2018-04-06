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

<div class="login-title"><strong>Добро пожаловать</strong>, Авторизируйтесь</div>
<form action="#" class="form-horizontal" method="post">

    <div class="form-group">
        <div class="col-md-12">
            <input type="text" name="account" class="form-control" placeholder="Логин" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required autocomplete="off"/>
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
            <button type="submit" class="btn btn-info btn-block" id="postbut" name="enter">Войти</button>
        </div>
    </div>
</form>
</div>
<div class="login-footer">
    <div class="pull-left">
        &copy; 2018 {PROJECT}
    </div>
    <div class="pull-right">
        <a href="http://freewow.org/index.php?app=core&module=global&section=register">Регистрация</a> |
       <a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/16.png"></a>
    </div>
</div>