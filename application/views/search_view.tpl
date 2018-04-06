<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Поиск предмета</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form action="" id="demo-form2" method="post" data-parsley-validate
                      class="form-horizontal form-label-left">
                    <input type="hidden" name="CSRF" value="">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Номер<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="first-name" required="required" name="id"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="search" class="btn btn-success">Поиск</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Результат поиска</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">Номер</th>
                    <th class="column-title">Предмет</th>
                    <th class="column-title">Купить за DP</th>
                    <th class="column-title">Купить за VP</th>
                </tr>
                </thead>
                <tbody>
                <?php
    if ($data['data'] == false) {
        echo "<div class=\"error\"> Предмет не найден!
        </div";
                } else {
                echo "
        <tr>
            <td>
                ".$data['data']['id_item']."
            </td>
            <td>
                ".$data['data']['name_item']."
            </td>
            <td>
                <form action=\"\" method=\"post\">
                    <input name=\"bonus\" value=\"dp\" type=\"hidden\">
                    <input name=\"id\" value=\"".$data['data']['id_item']."\" type=\"hidden\">
                    <input type=\"submit\" class=\"btn btn-primary\" name=\"buy\" value=\"Купить
                    ".$data['data']['price']." DP\">
                </form>
            </td>
            <td>
                <form action=\"\" method=\"post\">
                    <input name=\"bonus\" value=\"vp\" type=\"hidden\">
                    <input name=\"id\" value=\"".$data['data']['id_item']."\" type=\"hidden\">
                    <input type=\"submit\" class=\"btn btn-primary\" name=\"buy\" value=\"Купить
                    ".$data['data']['price_vp']." VP\">
                </form>
            </td>
        </tr>
        ";
        }
        ?>
        </tbody>
        </table>
    </div>
