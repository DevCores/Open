<div class="col-md-12">
    <div class="panel panel-primary" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title"> Просмотр логов</h3>
        </div>
        <div class="form-group">
            <div id="result"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">Ip</th>
                    <th class="column-title">Логин</th>
                    <th class="column-title">Страница</th>
                    <th class="column-title">Время</th>
                    <th class="column-title">Доступ</th>
                    <th class="column-title">Bonus Dp</th>
                    <th class="column-title">Bonus Vp</th>
                </tr>
                </thead>
                <tbody>
                <?php
                 foreach ($data['data'] as $value) {
                  $row = explode(':',$value);
                  $time = date('Y-m-d H:i:s', $row['3']); ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $time; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[6]; ?></td>
                </tr>
                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>