<div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Сменить имя персонажа</h3>
        </div>
        <div class="panel-body">
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">Персонаж</th>
                            <th class="column-title">Введите новое имя</th>
                            <th class="column-title">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> <?php if (!isset($data['char'])) {  ?>
                                Выберите персонажа!
                                <?php   } else {
                                echo $data['char']['name'];
                             }  ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                                    <input name="name" type="text">
                            </td>
                            <td>
                                <input type="submit" name="change_name"  class="btn btn-info" value="Cменить 1000 VP">
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">До идеального имени рукой подать!</h3>
        </div>
        <div class="panel-body">
            <p>
                Необязательно всю жизнь носить одно и то же имя. Может, вас утомило, что за вами бегают за автографами <br>
                (или чтобы дать вам по шее),а может, вам просто пришло в голову что-нибудь получше. В любом случае, новое имя – новая жизнь!<br>
            </p>

        </div>
    </div>
</div>