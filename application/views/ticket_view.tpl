<div class="col-md-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Техническая поддержка по личному кабинету!</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>

            <form class="form-horizontal form-label-left" action="" method="post">
                <input type="hidden" name="CSRF" value="<?php echo $data['csrfToken'];?>">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Вопрос кратко</label>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Приоритет</label>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="primany" class="select2_group form-control">
                            <option value="1">Низкий</option>
                            <option value="2">Средний</option>
                            <option value="3">Высокий</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ваш вопрос развернуто. <span
                                class="required">*</span>
                    </label>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="text"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <input type="submit" name="ticket" class="btn btn-success" value="Спросить">
                    </div>
                </div>

            </form>
        </div>
