<div class="variant-title">Тариф "<?=$variants['title']?>"</div>

<?php foreach ($variants['variants'] as $variant):?>
    <div class="variant">
        <div class="period"><?=$variant['month'] . ' ' . $variant['declension']?></div>
        <div class="hr"></div>
        <div class="choice" id="<?=$variant['id']?>" tariff="<?=$variant['tariffId']?>" pref="<?=PREFIX?>">
            <div class="pricePerMonth"><?=$variant['pricePerMonth'] . ' ' . htmlspecialchars_decode('&#8381')?>/мес </div>
            <div class="priceAll">разовый платеж - <?=$variant['price'] . ' ' . htmlspecialchars_decode('&#8381')?></div>
            <?php if ($variant['discount'] !== 0):?>
                <div class="discount">скидка - <?=$variant['discount']?></div>
            <?php endif;?>
        </div>
    </div>
<?php endforeach;?>
