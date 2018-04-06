<div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Повысить уровни (BETA)</h3>
        </div>
        <div class="panel-body">
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">Персонаж</th>
                            <th class="column-title">Уровень</th>
                            <th class="column-title">Количество уровней</th>
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
                            <td> <?php if (!isset($data['char'])) {  ?>
                                Выберите персонажа!
                                <?php   } else {
                                echo $data['char']['level'];
                             }  ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                                    <input name="level" type="text">
                            </td>
                            <td>
                                <input type="submit" name="levelup"  class="btn btn-info" value="Повысить">
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
            <h3 class="panel-title">Стоимость 1 уровня составляет 5dp!</h3>
        </div>
    </div>
</div>