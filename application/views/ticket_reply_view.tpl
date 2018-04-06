<div class="col-md-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Техническая поддержка по личному кабинету!</h2>

            <div class="clearfix"></div>
            <a  <?php echo ' href="/main/reply_ticket/'.$data['ticket_one']['id'].'" ' ?> > Обновить</a>
        </div>
        <div class="x_content">
            <div class="alert" style="background: #d0e3f7;  color: #3f5163;">
                <?php echo $data['ticket_one']['text'];     ?>

            </div>
        </div>


        <?php
    if ($data['data']->num_rows == 0) {
        echo "
        <div class=\"error\">Нету истории
        </div";
                } else {
                while ($row = $data['data']->fetch_assoc())
                { $date = date("Y-m-d H:i:s", $row['time']); ?>
        <div class="alert"


        <?php
if ($row['access'] == 1) {
echo 'style="background: #bbb5e0; margin-left: 5px; color: #fff;"'; 
} else {
  echo 'style="background: #d0e3f7;  color: #3f5163;"'; 
}
 ?>

        >
        <?php echo $date; ?> <br>

        <?php echo $row['reply'];     ?>


    </div>


    <?php      }
    } ?>
    <div class="row">
        <form class="form-horizontal form-label-left" action="" method="post">
            <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken'];?>">

            <div class="form-group">

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea class="form-control" rows="3" name="text"></textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">
                    <input type="submit" name="ticket" class="btn btn-success" value="Ответить">
                </div>
            </div>

        </form>
    </div>
      