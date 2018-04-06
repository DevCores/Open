<div class="col-md-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Подтверждение оплаты</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <form class="form-horizontal form-label-left" method='get'
                  action='http://www.free-kassa.ru/merchant/cash.php'>
                <input type='hidden' name='m' value='<?php echo $data['merchant_id']; ?>'>
                <input type='hidden' name='oa' value='<?php echo $data['order_amount']; ?>'>
                <input type='hidden' name='o' value='<?php echo $data['order_id']; ?>'>
                <input type='hidden' name='s' value='<?php echo $data['sign']; ?>'>
                <input type='hidden' name='lang' value='ru'>
                <input type='hidden' name='us_login' value='<?php echo $data['username']; ?>'>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Сумма  <?php echo $data['order_amount']; ?>
                        р</label>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <input type="submit" name='pay' class="btn btn-info" value="Подтвердить">
                    </div>
                </div>
            </form>
        </div>
</div>