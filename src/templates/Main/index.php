<?php for($i = 0 ; $i < count($tariffs); $i++): ?>
    <div class="main-tariffs <?= $i ?>">
        <p>
            <?=$tariffs[$i]['title']?>
        </p>
        <p>
            <?=$tariffs[$i]['speed']?> мбит/с
        </p>
        <p>
            <?=$tariffs[$i]['prices'] . htmlspecialchars_decode('&#8381')?> /мес
        </p>

        <p>
            <?php if (!empty($tariffs[$i]['freeOptions'])): ?>
                <?php for ($j = 0; $j < count($tariffs[$i]['freeOptions']); $j++):?>
                    <p>
                        <?=$tariffs[$i]['freeOptions'][$j]?>
                    </p>
                <?php endfor;?>
            <?php endif;?>
        </p>

        <p>
            <a href="<?=$tariffs[$i]['link']?>"> узнать подробнее на сайте <?=$tariffs[$i]['link']?></a>
        </p>
    </div>

<?php endfor;?>


