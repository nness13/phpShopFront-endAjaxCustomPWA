<div class="container" id="container">

    <div class="big_w big_h m_full_w">
        <div class="content_card">
            <a href="#" class="btn btn-black btn-full"><? echo $who ?></a>
            Налаштування
            <div class="posRel">
                <label class="placeholder"></label>
                <input type="text" id="login" class="form-control" name="login" maxlength="9" value="<? echo $_SESSION['account']['login']; ?>" required>
            </div>
            <div class="posRel">
                <label class="placeholder"></label>
                <input type="text" id="number" class="form-control" name="number" value="<? echo $_SESSION['account']['email']; ?>" required>
            </div>
            <div class="posRel">
                <label class="placeholder">Пароль</label>
                <input type="password" id="password" class="form-control" name="password" inputChange="inputChange" onfocus="this.removeAttribute('readonly');" readonly required>
            </div>

            <a href="/account/logout" class="btn btn-black btn-full">Вийти</a>
        </div>
    </div>

    <? if($_SESSION['account']['status'] == 3): ?>
        <div class="big_w big_h m_full_w">
            <div class="content_card">
                <div>Історія активності користувачів</div>
                <?php if (isset($visit_user)): ?>
                    <div class="divOrderGoods">
                        <div class="btn btn-fifty btn-text btn-black">Дата: </div>
                        <div class="btn btn-fifty btn-text btn-black">IP: </div>
                        <div class="btn btn-fifty btn-text btn-black">Route: </div>
                    </div>
                    <? foreach ($visit_user as $key => $val):?>
                        <a href="/account/user_history/<? echo $val["id"] ?>" id="pushajax" data-type="pushajax" class="divOrderGoods">
                            <div class="btn-fifty btn-text"><? echo $val["time_v"] ?></div>
                            <div class="btn-fifty btn-text"><? echo $val["ip"] ?></div>
                            <div class="btn-fifty btn-text"> <? echo $val["route"] ?></div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($_SESSION['account']['status'] == 4): ?>
        <div class="big_w big_h m_full_w">
            <div class="content_card">
                <a href="/transport_route/add" id="pushajax" data-type="pushajax" class="btn btn-black btn-full">Додати маршут</a>
                <div>Мої маршути</div>
                <?php if (isset($transportRoute)): ?>
                    <? foreach ($transportRoute as $key => $val): ?>
                        <div class="divOrderGoods">
                            <img class="divOrderGoodsimg noscaleImg" src="/materials/responsive/transport_routes/<? echo $val['userid'] ?>/<? echo $val['img'] ?>">
                            <div class="btn-fifty btn-text"><? echo $val['route'] ?></div>
                            <a href="/transport_routes/all/30/desc/time" id="pushajax" data-type="pushajax" class="btn btn-black btn-100 btn-text">перейти</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="big_w big_h m_full_w">
        <div class="content_card">
            <div >Історія входів</div>
            <?php if (isset($historyIP)): ?>
                <? foreach ($historyIP as $key => $val): $val = explode(':', $val)?>
                    <div class="divOrderGoods">
                        <div class="btn-fifty btn-text">Дата: <? echo $val[1] ?></div>
                        <div class="btn-fifty btn-text">IP: <? echo $val[0] ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="big_w big_h m_full_w">
        <div class="content_card">
            <div >Мій кошик</div>
            <?php if (isset($datacleave)): ?>
                <? foreach ($datacleave as $key => $val): ?>
                    <div class="divOrderGoods">
                        <img class="divOrderGoodsimg noscaleImg" src="/materials/responsive/goods/<? echo $val['idgoods'] ?>/0.jpg">
                        <div class="btn-fifty btn-text">Ідентифікатор №<? echo $val['idgoods'] ?></div>
                        <a href="/goods/<? echo $val['idgoods'] ?>" id="pushajax" data-type="pushajax" class="btn btn-black btn-100 btn-text">перейти</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>


</div>