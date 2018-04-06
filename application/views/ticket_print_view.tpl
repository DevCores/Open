 <?php
    if ($data['data']->num_rows == 0) {
                    echo "
                    <div class=\"alert alert-danger\">Нету истории
                    </div";
                            } ?>
          <div class="col-md-12">
    <div class="form-group">
        <div id="result"></div>
    </div>
    
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Ваши тикеты</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="headings">
                        <th class="column-title">#</th>
                        <th class="column-title">Название</th>
                        <th class="column-title">Вопрос</th>
                        <th class="column-title">Время создания</th>
                        <th class="column-title">Приоритет</th>
                        <th class="column-title">Статус</th>
                        <th class="column-title">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php
                            while ($row = $data['data']->fetch_assoc())
                            {
                            $date = date("Y-m-d H:i:s", $row['time']);
                            if ($row['primary_ticket'] == 1) {
                            $primany = 'Низкий';
                            } elseif ($row['primary_ticket'] == 2) {
                            $primany = 'Cредний';
                            } else {
                            $primany = 'Высокий';
                            }

                            if ($row['status'] == 1) {
                            $status = 'Ожидание проверки.';
                            } elseif ($row['status'] == 2) {
                            $status = 'Вам ответили.';
                            } else {
                            $status = 'Закрыт.';
                            }
                            $text = substr($row['text'], 0, 8);
                            echo "
                    <tr>
                        <td>
                            ".$row['id']."
                        </td>
                        <td>
                            ".$row['name']."
                        </td>
                        <td>
                            ".$text."..
                        </td>
                        <td>
                            ".$date."
                        </td>
                        <td>
                            ".$primany."
                        </td>
                        <td>
                            ".$status."
                        </td>
                        <td>
                            <a href=\"/auth/reply_ticket/".$row['id']."\">Ответить</a>
                        </td>
                    </tr>
                    ";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
              $pervpage = null; $nextpage = null; $page2right = null; $page1right = null; $page1left = null; $page2left = null;
if ($data['pages']['page'] != 1) $pervpage = '<a href= /admin/view_ticket/'. ($data['pages']['page'] - 1) .' class="pred" ></a>
            ';

            if ($data['pages']['page'] != $data['pages']['total']) $nextpage = ' <a href=/admin/view_ticket/'. ($data['pages']['page']
            + 1) .' class="sled" ></a>
            ';

            if($data['pages']['page'] - 2 > 0) $page2left = ' <a href=/admin/view_ticket/'. ($data['pages']['page'] - 2)
            .' class="footesr" >'. ($data['pages']['page'] - 2) .'</a>  ';
            if($data['pages']['page'] - 1 > 0) $page1left = '<a href=/admin/view_ticket/'. ($data['pages']['page'] - 1)
            .' class="footesr">'. ($data['pages']['page'] - 1) .'</a>  ';
            if($data['pages']['page'] + 2 <= $data['pages']['total']) $page2right = ' <a href=/admin/view_ticket/'.
                                                                                         ($data['pages']['page'] + 2) .'
            class="footesr">'. ($data['pages']['page'] + 2) .'</a>';
            if($data['pages']['page'] + 1 <= $data['pages']['total']) $page1right = ' <a href=/admin/view_ticket/'.
                                                                                         ($data['pages']['page'] + 1) .'
            class="footesr">'. ($data['pages']['page']+ 1) .'</a>';

            echo $page2left.$page1left.'<b>'.$data['pages']['page'].'</b>'.$page1right.$page2right;
            ?>
      </div>
          </div>  </div>
          </div>