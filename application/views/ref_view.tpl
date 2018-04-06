<div class="col-md-12">
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Реферальная система</h3>
        </div>
        <div class="panel-body">
            <p> Реферал (или реферрал, от англ. referral — «направление») — участник партнёрской программы,
                зарегистрировавшийся по рекомендации другого <br>участника.
                <br><br>
                Ваша реферальная ссылка: <a
                        class="refs"><?php echo "http://".$_SERVER['SERVER_NAME']."/ref/reg/".$data['link_ref']; ?></a>
            </p>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Ваши рефералы</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">Аккаунт</th>
                    <th class="column-title">Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php
   while($row = $data['data']->fetch_assoc())
                {
                echo "
                <tr>
                    <td>
                        ".$row['id']."
                    </td>
                    <td>
                        <form action=\"\" method=\"post\">
                            <input type=\"hidden\" name=\"CSRF\" value=\"".$data['csrfToken']."\">
                            <input name=\"username\" value=\"".$row['username']."\" type=\"hidden\">
                            <input type=\"submit\" class=\"btn btn-info\" name=\"ref\" value=\"Подтвердить\">
                        </form>
                    </td>

                </tr>
                ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>