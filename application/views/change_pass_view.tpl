<div class="col-md-12 col-sm-12 col-xs-12">
<div class="panel panel-info" id="grid_block_1">
    <div class="panel-heading">
        <h3 class="panel-title">Смена пароля</h3>
    </div>
                <div class="form-group">
                    <div id="result"></div>
                </div>
                <form action="#" id="change_pass" method="post" data-parsley-validate
                      class="form-horizontal form-label-left">
                    <input type="hidden" id="CSRF" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Новый пароль <span
                                    class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" required="required" name="password"
                                   class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Повторите пароль <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password_2" name="password_2" required="required"
                                   class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Старый пароль <span
                                    class="required" >*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password_old" required="required" name="password_old"
                                   class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="change_pass" class="btn btn-info">Сменить</button>
                        </div>
                    </div>
                </form>
    <br>

    </div>
            <script type="text/javascript">
                function success(result) {
                    $('#result').html(result);
                }

                function beforeSend() {
                    $('#result').html('<img id="imgcode" src="/default.gif">');
                }

                function errors() {
                    $('#result').html('Ошибка попробуйте позже.');
                }

                $(function () {
                    $("#change_pass").submit(function () {
                        var formData = {
                            "password": $("#password").val()
                            , "password_2": $("#password_2").val()
                            , "password_old": $("#password_old").val()
                            , "CSRF": $("#CSRF").val()

                        };
                        $.ajax({
                            url: '/ajax/change_pass/'
                            , type: 'POST'
                            , data: 'jsonData=' + toJSON(formData)
                            , error: errors
                            , success: success
                            , beforeSend: beforeSend
                        });
                        return false;
                    });
                });
            </script>
