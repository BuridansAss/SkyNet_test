<div class="choice-title">Выбор тарифа</div>
<div class="buy-variant">
    <div class="choice-name">Тарифф "<?=$variant['title']?>"</div>
    <div class="hr"></div>
    <div class="pay-period">Период оплаты - <?=$variant['payPeriod'] . ' ' . $variant['declension']?></div>
    <div class="pricePerMonth-choice"><?=$variant['pricePerMonth'] . ' ' . htmlspecialchars_decode('&#8381')?>/мес</div>
    <div class="price">разовый платеж - <?=$variant['price'] . ' ' . htmlspecialchars_decode('&#8381')?></div>
    <div class="price">со счета спишется - <?=$variant['price'] . ' ' . htmlspecialchars_decode('&#8381')?></div>
    <div class="inPower">вступит в силу - сегодня</div>
    <div class="tariff-active">активно до - <?=$variant['activeBy']?></div>
    <div class="hr"></div>
    <div class="button" id="buy-button">Выбрать</div>
</div>