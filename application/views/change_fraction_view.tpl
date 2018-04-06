<div class="col-md-12">
    <div class="form-group">
        <div id="result"></div>
    </div>
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">{CHANGEFRACTION}</h3>
        </div>
        <div class="panel-body">
            <p> При входе в игру появится окно для смены фракции. (Персонаж: {CHAR} )<br>

            <form action="#" method="post" id="changeFraction">
                <input type="hidden" name="CSRF" id="CSRF" value="<?php echo $data['csrfToken']; ?>">
                <input type="submit" class="btn btn-info" value="{CHANGEFRACTION} 100 DP">
            </form>
            <hr>
        </div>
    </div>

    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">По ту сторону баррикад</h3>
        </div>
        <div class="panel-body">
            <p>
                «Предатель!..» Да, легко бросаться громкими фразами. <br>
                Вашим союзникам по фракции навряд ли понравится, что вы решили уйти. Но по сути, чем вы, собственно, им обязаны? <br>
                Может, пора взглянуть, как там у других? Может, у вас там уже есть друзья!  <br>
                Кто знает, вдруг, как говорится, «эпики» действительно фиолетовее там, где нас нет… <br>
                В смену фракции входит смена расы, чтобы было проще влиться в ряды новых союзников.<br>
            </p>

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
            $("#changeFraction").submit(function () {
                var formData = {
                    "CSRF": $("#CSRF").val()
                };
                $.ajax({
                    url: '/ajax/change_fraction/'
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
