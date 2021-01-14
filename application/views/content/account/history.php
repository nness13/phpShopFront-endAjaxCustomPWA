<div class="container" id="container">

    <? if($_SESSION['account']['status'] == 3): ?>
        <div class="triple_w big_h m_full_w">
            <div class="content_card">
                <div>Історія активності користувача</div>
                <?php if (isset($visit_user)): ?>
                    <div class="divOrderGoods">
                        <div class="btn-fifty btn-text btn-black">Дата: </div>
                        <div class="btn-fifty btn-text btn-black">IP: </div>
                        <div class="btn-fifty btn-text btn-black">Route: </div>
                    </div>
                    <? foreach ($visit_user as $key => $val):?>
                        <div class="divOrderGoods">
                            <div class="btn-fifty btn-text"><? echo $val["time_v"] ?></div>
                            <div class="btn-fifty btn-text"><? echo $val["ip"] ?></div>
                            <a href="/<? echo $val["route"] ?>" target="_blank" class="btn-fifty btn-text"> <? echo $val["route"] ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

</div>