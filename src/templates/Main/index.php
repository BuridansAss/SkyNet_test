<?php foreach ($tariffs as $tariff): ?>
    <div class="tariff">
        <div class="title"> Тариф "<?=$tariff['title'] ?>"</div>
        <div class="hr"></div>
        <div class="getVariant" id="<?= $tariff['id']?>" pref="<?=PREFIX?>">
            <span class="speed"> <?=$tariff['speed'] ?> Мбит/с</span>
            <div class="prices"> <?=$tariff['prices'] . ' ' . htmlspecialchars_decode('&#8381') ?> /мес</div>

            <?php if (isset($tariff['freeOptions'])):?>
                <div class="option">
                    <?php foreach ($tariff['freeOptions'] as $option): ?>
                        <div><?=$option ?></div>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
        </div>
        <div class="hr"></div>
        <div class="link"> <a href="<?=$tariff['link'] ?>" target="_blank">узнать подробнее на сайте www.sknt.ru</a></div>
    </div>
<?php endforeach;?>
