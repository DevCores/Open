<div class="col-md-12">
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">{ADDBONUSPANEL}</h3>
        </div>
        <div class="form-group">
            <div id="result"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="#" id="add_bonus" method="post" data-parsley-validate
                    class="form-horizontal form-label-left">
                    <input type="hidden" id="CSRF" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{ACCOUNT}
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="account" name="account" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{NUMBONUSDP}<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="bonus" name="bonus" required="required"
                            class="form-control col-md-7 col-xs-12" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{NUMBONUSVP}<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="numbera" id="bonus_vp" name="bonus_vp" required="required" class="form-control col-md-7 col-xs-12" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{YOUPASSWORD}<span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" required="required" name="password" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="check"><input type="checkbox" name="chk[]" id="rule" class="icheckbox"/>{CHARGEALLACCOUNTS}</label>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="add_bonus" class="btn btn-success">{ADDBONUS}</button>
                        </div>
                    </div>
                </form>

                <script type="text/javascript">
                    function success(result) {
                        $('#result').html(result);
                    }

                    function beforeSend() {
                        $('#result').html('<img id="imgcode" src="/default.gif">');
                    }

                    function errors() {
                        $('#result').html('{ERRORAGAINLATER}');
                    }

                    $(function () {
                        $("#add_bonus").submit(function () {
                            var checkbox;
                            if ($(":checkbox").is(":checked")) {
                                checkbox = '1';
                            } else {
                                checkbox = '0';
                            }

                            var formData = {
                                "account": $("#account").val()
                                , "bonus": $("#bonus").val()
                                , "bonus_vp": $("#bonus_vp").val()
                                , "CSRF": $("#CSRF").val()
                                , "password": $("#password").val()
                                , "rule": checkbox

                            };
                            $.ajax({
                                url: '/ajax/add_bonus/'
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
            </div>
        </div>
    </div>
</div>
</div>