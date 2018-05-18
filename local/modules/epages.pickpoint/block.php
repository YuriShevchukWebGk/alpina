<?IncludeModuleLangFile(__FILE__); if(strlen($_SESSION['PICKPOINT']['PP_NAME']) > 0) {
    $displayValue = 'block';
} else {
    $displayValue = 'none';
} ?>
<div class="bx_result_price">
<?if($displayValue == 'none'){?>
    <span class="delivery_date">Ожидаемая дата доставки:</span> <br>
    <a onclick="PickPoint.open(PickpointHandler<?if ($str_from_city):?>, {fromcity:'<?=$str_from_city?>'}<?endif;?>);return false" style="cursor:pointer;"><?=GetMessage("PP_CHOOSE")?></a>
<?} else {?>
    <a onclick="PickPoint.open(PickpointHandler<?if ($str_from_city):?>, {fromcity:'<?=$str_from_city?>'}<?endif;?>);return false" style="cursor:pointer;"><?=GetMessage("PP_CHOOSE")?></a>
<?}?>
</div>
<?
$adress = explode(',', $_SESSION['PICKPOINT']["PP_ADDRESS"]);
$str = file("/var/www/alpinabook.ru/html/parse_pickpoint.csv");

  if(is_array($str))
  {
    //разбор csv
    $cnt = count($str);
    for($i = 0; $i < $cnt; $i++)
    {
      $line = $str[$i];
      $values[$i] = explode(';', $line);
    }
  }
?>
<table id="tPP" onclick="return false;" style="display:<?=$displayValue?>;">
    <tr>
        <td><?=GetMessage("PP_DELIVERY_IN_PLACE")?>:</td>
        <td>

        <?
          foreach($values as $pickpoint){

              if($pickpoint[0] == trim($adress[2]) || $pickpoint[1] == trim($adress[1])){
                  $start = preg_replace('~\D+~','',$pickpoint[3]); // доставка начало;
                  $end = preg_replace('~\D+~','',$pickpoint[4]); // доставка конец
                  if($start == $end){
                    $delivery_time = date_day(trim($start));
                  } else {
                    $delivery_time = date_day(trim($start)).' - '.date_day(trim($end));
                  }
              }
          }
        ?>
        <span id="sPPDelivery">
            <?=($_SESSION['PICKPOINT']['PP_ADDRESS']?$_SESSION['PICKPOINT']['PP_ADDRESS']."<br/>".$_SESSION['PICKPOINT']['PP_NAME']:GetMessage("PP_sNONE"))?>
            <br>
            <span class="delivery_date">Ожидаемая дата доставки: <?=$delivery_time?></span>
        </span>
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td><?=GetMessage("PP_SMS_PHONE")?>:</td>
        <td><input type="text" name="PP_SMS_PHONE" value="<?=htmlspecialcharsbx($_REQUEST["PP_SMS_PHONE"])?>" id="pp_sms_phone"/>
        <br/><?=GetMessage("PP_EXAMPLE")?>: +79160000000</td>
    </tr>
</table>
