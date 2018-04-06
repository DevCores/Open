<div class="col-md-12">
 
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Покупка валют</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered" style="text-align: center;">
                <thead>
                <tr class="headings">
                    <th class="column-title">Валюта</th>
                    <th class="column-title">Цена</th>
                     <th class="column-title">Количество комплектов</th>
                      <th class="column-title">Действие</th>
                </tr>
                </thead>
                <tbody>
               <tr>
                    <td>
                     Honor (Очки чести) <img src="/img/icon/valuts/honor.png" width="18" class="icon">
                    </td>
                    <td>
                      <?php echo $data['system']['price_honor']; ?> dp за  <?php echo $data['system']['num_honor']; ?> Очков чести
                    </td>
                    <td>
                         <form action="" method="post">
                          <input type="number" name="num" value="0"  style="text-align: center;">
                    </td>
                  
                    <td>
                       
                            <input type="hidden" name="CSRF" value="">
                            <input type="submit" class="btn btn-info" name="honor" value="Купить Валюту">
                        </form>
                    </td>

                </tr>

                  <tr>
                    <td>
                      Arena (Очки Арены) <img src="/img/icon/valuts/arena.png" width="18" class="icon">
                    </td>
                    <td>
                        <?php echo $data['system']['price_arena']; ?> dp за  <?php echo $data['system']['num_arena']; ?> Очков арены
                    </td>
                    <td>
                         <form action="" method="post">
                          <input type="number" name="num" value="0"  style="text-align: center;">
                    </td>
                  
                    <td>
                       
                            <input type="hidden" name="CSRF" value="">
                            <input type="submit" class="btn btn-info" name="arena" value="Купить Валюту">
                        </form>
                    </td>

                </tr>


                  <tr>
                    <td>
                      Gold (Голд)  <img src="/img/icon/valuts/gold.png" width="18" class="icon">
                    </td>
                    <td>
                        <?php echo $data['system']['price_gold']; ?> dp за  <?php echo $data['system']['num_gold']; ?> Золотых
                    </td>
                    <td>
                         <form action="" method="post">
                          <input type="number" name="num" value="0"  style="text-align: center;">
                    </td>
                  
                    <td>
                       
                            <input type="hidden" name="CSRF" value="">
                            <input type="submit" class="btn btn-info" name="gold" value="Купить Валюту">
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">Как правильно покупать валюту!</h3>
        </div>
        <div class="panel-body">
            <p>
                Для того чтобы ваши бонусы списались необходимо<br>
                просто ввести количество комплектов которое вы собираетесь купить.<br>
                Тоесть если вы хотите купить <?php $summ = 10*$data['system']['num_honor'];
                echo $summ;
                ?> хонора, то необходимо вводить 10 комплектов<br>
                стоимость которых составляет <?php echo $data['system']['price_honor']; ?> за <?php echo $data['system']['num_honor']; ?> Очков чести <br>
            </p>

        </div>
    </div>