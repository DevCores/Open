<div class="col-md-12">
    <div class="form-group">
        <div id="result"></div>
    </div>
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Получить бонусы</h3>
        </div>
        <div class="panel-body">
            <p>
                Для получение бонусов вам нужен ключь. (Вида: 75257-FBE91A-AD421A-3F989B1B)
            </p>
            <form action="#" method="post" id="getBonuses">
                <input type="hidden" name="CSRF" id="CSRF" value="<?php echo $data['csrfToken']; ?>">
                <input type="text" name="key" id="key" style="width: 195px;">
                <input type="submit" class="btn btn-info" name="bingind" value="Получить">
            </form>
            <hr>
            <p> Обычно его получают в конкурсах и содержит различное количество бонусов.
                <br> Вы так же можете передать бонусы другу или подарить кому либо!
                <br>
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
            $("#getBonuses").submit(function () {
                var formData = {
                    "CSRF": $("#CSRF").val()
                    , "key": $("#key").val()
                };
                $.ajax({
                    url: '/ajax/get_bonuses/'
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