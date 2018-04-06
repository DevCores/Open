<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <span class="title"><i class="icon-warning-sign"></i> Пополнение баланса</span>
            </div>
            <div class="box-content">
                <form class="form-horizontal fill-up validatable" action="/donat/buy" method="post">
                    <div class="padded">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Сумма</label>
                            <div class="col-lg-10">
                                <input type="text" class="validate[required]" name="price"
                                       data-prompt-position="topLeft" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="donat" class="btn btn-info">Оплатить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


