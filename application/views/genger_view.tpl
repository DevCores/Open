<div class="col-md-12">
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Сменить пол персонажа</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">Персонаж</th>
                    <th class="column-title">Пол</th>
                    <th class="column-title">Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $data['data']->fetch_assoc()) {  ?>
                <tr>
                    <td> <?php echo $row['name']; ?> </td>
                    <td>
                        <form action="" method="post">
                            <?php   if ($row['gender'] == 0) { ?>
                          <input name="gender_char" type="hidden" value="1">Девушка
                            <?php } else {  ?>
                           <input name="gender_char" type="hidden" value="0">Мужщина
                            <?php   }  ?>
                    </td>
                    <td>
                        <input name="name" value="<?php echo $row['name']; ?>" type="hidden">
                        <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                        <input type="submit" class="buy" name="change_gender" value="Cменить пол 50 VP">
                        </form>
                    </td>
                </tr>
                <?php    }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
