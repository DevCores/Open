<div class="col-md-12">
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Пополнение бонусов (DP)</h3>
        </div>
        <div class="col-md-5">
        <div class="panel-body">
            <form class="form-horizontal form-label-left" action="" method="post">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Сумма</label>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="number" class="form-control" name="summa" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken']; ?>">
                        <input type="submit" name="donat" class="btn btn-info" value="Оплатить">
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>