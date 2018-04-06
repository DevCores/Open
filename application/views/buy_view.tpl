<form action="https://wl.walletone.com/checkout/checkout/Index" method="POST">
    <?php  foreach($data as $key => $val)
    {
    if (is_array($val))
    foreach($val as $value)
    { ?>
    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>"/>';
    <?php  }  else ?>
<input type="hidden" name="<?php echo $key; ?>" value="<?php echo val; ?>"/>
    <?php } ?>
    <div class="block_form"><input type="submit" value="Подтвердить" class="buy"/></div>
</form>


   

