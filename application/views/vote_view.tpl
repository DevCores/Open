<div class="col-md-12">


    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Бонусы за голосование в рейтинге MMOTOP</h3>
        </div>
        <div class="panel-body">
            <p>Для того, чтобы получить бонусы, Вам всего лишь надо проголосовать за наш сервер в рейтинге <a href="http://wow.mmotop.ru/servers/30055">MMOTOP</a>!
                <br>
                При голосовании вводите <strong>логин</strong> вашего аккаунта (<strong>{USERNAME}</strong>).</p>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">СПИСОК ГОЛОСОВ</h3>
        </div>
        <div id="result"></div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Дата голосования</th>
                    <th class="column-title">Дата бонуса</th>
                    <th class="column-title">Получено бонусов голосования</th>
                </tr>
                </thead>
                <tbody>
                <?php
           $id = 0;
       while ($row = $data['data']->fetch_assoc()) {
                $id++;
                if ($row['date_bonus'] == '-') {
                $dateBonus = '-';
                } else {
                $dateBonus = date("Y-m-d H:i:s" , $row['date_bonus']);
                }


                if ($row['action'] == 1)
                {
                $disable = 'disabled';
                } else {
                $disable = '';
                }
                echo '
                <tr>
                    <td>'.$id.'</td>
                    <td>
                        '.$row['time_vote'].'
                    </td>
                    <td>
                        '.$dateBonus.'
                    </td>
                    <td> ';     ?>

       <input type="submit" onclick="setVoteBonus('<?php echo $row['time_vote']; ?>', '<?php echo $data['csrfToken']; ?>');" class="btn btn-info" value="Получить бонус голосования!" <?php echo $disable; ?>>

                        <?php                  echo '         </td>
                </tr>
                ';
                }
                ?>

                </tbody>
            </table>
        </div>

    </div>


    <div class="alert alert-danger">
        <b>
            ВНИМАНИЕ! <br>
            Все неиспользованные в течение текущего месяца голоса в начале следующего месяца сгорают. <br>
            Получайте бонусы за голоса своевременно!</b>

    </div>

    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Ваши голоса не появляются в списке?</h3>
        </div>
        <div class="panel-body">
            <p>Возможные причины их отсутствия</p>
            <ul>
                <li>При голосовании Вы не указали имя аккаунта. А как тогда найти Ваш голос?</li>
                <li>Вы указали имя персонажа, Вашего кота... А нужно это - <strong
                            class="text-info">{USERNAME}</strong>.
                </li>
                <li>Вы голосовали не за наш сервер, но все равно почему то решили получить бонус.</li>
                <li>Если не отображается последний голос, то помните, что задержка составляет до 4 часов.</li>
                <li>Возможно сегодня первое число. Голосование начинается снова, но накопленные бонусы сохранены, их у
                    вас (<?php echo $data['bonus_vp']; ?>)
                </li>
            </ul>
        </div>
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
        $('#result').html('{ERRORAGAINLATER}');
    }

    function setVoteBonus(time, csrf) {
        var formData = {
            "CSRF": csrf
            , "time": time
        };
        $.ajax({
            url: '/ajax/receipt_bonus/'
            , type: 'POST'
            , data: 'jsonData=' + toJSON(formData)
            , error: errors
            , success: success
            , beforeSend: beforeSend
        });
    }


</script>