<div class="variant-title">Тариф "<?=$variants['title']?>"</div>

<?php foreach ($variants['variants'] as $variant):?>
    <div class="variant">
        <div class="period"><?=$variant['month']?></div>
        <div class="hr"></div>
        <div class="pricePerMonth"><?=$variant['pricePerMonth']?></div>
        <div class="priceAll"><?=$variant['price']?></div>
    </div>
<?php endforeach;?>
