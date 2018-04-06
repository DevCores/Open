<div class="col-md-12">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{TELEHOMECHAR}</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div id="result"></div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">Персонаж</th>
                    <th class="column-title">Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?php if (!isset($data['char'])) {
                                echo 'Выберите персонажа!';
                            } else {
                                echo $data['char']['name']; 
                            }
                        ?>
                    </td>
                    <td>
                        <form action="#" method="post" id="tele">
                            <input type="hidden" id="CSRF" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                            <input type="submit" class="btn btn-info" name="tele" value="Телепортировать">
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

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
                    $("#tele").submit(function () {
                        var formData = {
                            "CSRF": $("#CSRF").val()
                        };
                        $.ajax({
                            url: '/ajax/tele/'
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