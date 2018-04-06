<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cмена реалма</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Название</th>
                    <th class="column-title">Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $data['data']->fetch_assoc())
                {
                echo "
                <tr>
                    <td> ".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>
                        <form action=\"\" method=\"post\">
                            <input name=\"realm\" value=\"".$row['name']."\" type=\"hidden\">
                            <input type=\"submit\" class=\"btn btn-primary\" name=\"change_realm\" value=\"Сменить\">
                        </form>
                    </td>
                </tr>
                ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
