
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Магазин</h3>
        </div>
        <?php
    if ($data['data']->num_rows == 0) {
        echo "<div class=\"alert alert-danger\"> В данной категории нет товаров!
    </div";
            }
            ?>
    <div class="panel-body">
    
<div class="dataTables_paginate paging_simple_numbers">
    <ul class="pagination pagination-sm">
        <?php
        $pervpage = null; $nextpage = null; $page2right = null; $page1right = null; $page1left = null; $page2left = null;
if ($data['pages']['page'] != 1) $pervpage = '<a href= /shop/'. ($data['pages']['page'] - 1) .' class="paginate_button previous" ></a>';
        if ($data['pages']['page'] != $data['pages']['total']) $nextpage = ' <a href=/auth/shop/'. ($data['pages']['page']
        + 1) .' class="sled" ></a>';
        if($data['pages']['page'] - 2 > 0) $page2left = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] - 2) .' class="footesr" >'.
            ($data['pages']['page'] - 2) .'</a> </li>
        ';
        if($data['pages']['page'] - 1 > 0) $page1left = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] - 1) .' class="footesr">'.
            ($data['pages']['page'] - 1) .'</a> </li> ';
            if($data['pages']['page'] + 2 <= $data['pages']['total']) $page2right = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] + 2) .' class="footesr">'.
            ($data['pages']['page'] + 2) .'</a>  </li>
        ';
        if($data['pages']['page'] + 1 <= $data['pages']['total']) $page1right = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] + 1) .' class="footesr">'.
            ($data['pages']['page']+ 1) .'</a>  </li>
        ';
        echo $page2left.$page1left.'
        <li class="active"><a>'.$data['pages']['page'].'</a></li>
        '.$page1right.$page2right;
        ?>
    </ul>
</div>
        <table class="table  table-bordered">
            <thead>
            <tr class="headings">
                <th class="column-title">Номер</th>
                <th class="column-title">Предмет</th>
                <th class="column-title">Количество</th>
                <th class="column-title">Купить за DP</th>
                <th class="column-title">Купить за VP</th>
            </tr>
            </thead>
            <tbody>
            <?php
    while ($row = $data['data']->fetch_assoc())
            {
            echo "
            <tr>
                <td>
                    ".$row['id_item']."
                </td>
                <td>
                   <a href=\"http://wowroad.info/?item=".$row['id_item']."\" target=\"_blank\"> ".$row['name_item']." </a>
                </td>
                <td>
                    ".$row['number']." шт
                </td>
                <td>
                    <form action=\"\" method=\"post\">
                        <input name=\"CSRF\" value=\"".$data['csrfToken']."\" type=\"hidden\">
                        <input name=\"bonus\" value=\"dp\" type=\"hidden\">
                        <input name=\"id\" value=\"".$row['id_item']."\" type=\"hidden\">
                        <input name=\"id_t\" value=\"".$row['id']."\" type=\"hidden\">
                        <input type=\"submit\" class=\"btn btn-info buy\" name=\"buy\" value=\"Купить
                        ".$row['price']." DP\" >
                    </form>
                </td>
                <td>
                    <form action=\"\" method=\"post\">
                        <input name=\"CSRF\" value=\"".$data['csrfToken']."\" type=\"hidden\">
                        <input name=\"bonus\" value=\"vp\" type=\"hidden\">
                        <input name=\"id\" value=\"".$row['id_item']."\" type=\"hidden\">
                        <input name=\"id_t\" value=\"".$row['id']."\" type=\"hidden\">
                        <input type=\"submit\" class=\"btn btn-info\" name=\"buy\" value=\"Купить
                        ".$row['price_vp']." VP\">
                    </form>
                </td>
            </tr>
            ";
            }
            ?>
            </tbody>
        </table>
    
<div class="dataTables_paginate paging_simple_numbers">
    <ul class="pagination pagination-sm">
        <?php
        $pervpage = null; $nextpage = null; $page2right = null; $page1right = null; $page1left = null; $page2left = null;
if ($data['pages']['page'] != 1) $pervpage = '<a href= /shop/'. ($data['pages']['page'] - 1) .' class="paginate_button previous" ></a>';
        if ($data['pages']['page'] != $data['pages']['total']) $nextpage = ' <a href=/auth/shop/'. ($data['pages']['page']
        + 1) .' class="sled" ></a>';
        if($data['pages']['page'] - 2 > 0) $page2left = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] - 2) .' class="footesr" >'.
            ($data['pages']['page'] - 2) .'</a> </li>
        ';
        if($data['pages']['page'] - 1 > 0) $page1left = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] - 1) .' class="footesr">'.
            ($data['pages']['page'] - 1) .'</a> </li>  ';
            if($data['pages']['page'] + 2 <= $data['pages']['total']) $page2right = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] + 2) .' class="footesr">'.
            ($data['pages']['page'] + 2) .'</a>  </li>
        ';
        if($data['pages']['page'] + 1 <= $data['pages']['total']) $page1right = '
        <li><a href=/auth/shop/'. ($data['pages']['category']) .'/'. ($data['pages']['page'] + 1) .' class="footesr">'.
            ($data['pages']['page']+ 1) .'</a>  </li>
        ';
        echo $page2left.$page1left.'
        <li class="active"><a>'.$data['pages']['page'].'</a></li>
        '.$page1right.$page2right;
        ?>
    </ul>
</div>
</div>