<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Сменить персонажа</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered" style="text-align: center;">
                <thead>
                <tr class="headings">
                    <th class="column-title">Персонаж</th>
                    <th class="column-title">Класс</th>
                    <th class="column-title">Уровень</th>
                    <th class="column-title">Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php  while ($row = $data['data']->fetch_assoc()) {
                $class = $this->getClass($row['class']); ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><img src="/img/icon/classes/<?php echo $class; ?>.jpg" class="icon"></td>
                    <td><?php echo  $row['level']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                            <input name="name" value="<?php echo $row['name']; ?>" type="hidden">
                            <input type="submit" class="btn btn-info" name="change_char" value="Выбрать">
                        </form>
                    </td>
                </tr>
                <?php   } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


  