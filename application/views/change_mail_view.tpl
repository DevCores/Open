<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Смена почты</h2>
            </div>
            <div class="x_content">
                <form action="#" id="change_mail" method="post">
                    <div class="form-group">
                        <div id="result"></div>
                    </div>
                    <input type="hidden" id="CSRF" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Новая почта <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="mail" required="required" name="mail" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <br>
                            <input type="submit" class="btn btn-info" value="Сменить">
                        </div>
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
                            $("#change_mail").submit(function () {
                                var formData = {
                                    "CSRF": $("#CSRF").val()
                                    , "mail": $("#mail").val()
                                };
                                $.ajax({
                                    url: '/ajax/change_mail/'
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
                </form>
            </div>
        </div>
    </div>
</div>
