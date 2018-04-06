<div class="col-md-12">
    <div class="form-group">
        <div id="result"></div>
    </div>
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">{CHANGERACE}</h3>
        </div>
        <div class="panel-body">
            <p> При входе в игру появится окно для смены расы. (Персонаж: {CHAR} )<br>
            <form action="#" method="post" id="changeRace">
                <input type="hidden" name="CSRF" id="CSRF" value="<?php echo $data['csrfToken']; ?>">
                <input type="submit" class="btn btn-info" value="{CHANGERACE} 50 DP">
            </form>
            <hr>
        </div>


        <div class="panel panel-info" id="grid_block_1">
            <div class="panel-heading">
                <h3 class="panel-title">Каждый имеет право быть гномом! Правда?</h3>
            </div>
            <div class="panel-body">
                <p>
                    Генетика — жестокая штука. Попробуй поживи все время зеленым. Или синим. Или фиолетовым. <br> И к тому же остроухим.
                    Иногда косметической смены имиджа недостаточно и требуются радикальные меры: сменить расу напрочь!<br>
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
            $("#changeRace").submit(function () {
                var formData = {
                    "CSRF": $("#CSRF").val()
                };
                $.ajax({
                    url: '/ajax/change_race/'
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