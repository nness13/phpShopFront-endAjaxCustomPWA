<div class="leftPanel">
    <? if( isset($_SESSION['account']['id']) ): ?>
        <div class="topBox">
                <a class="topBtn" href="/"><img src="/public/img/favico.png"><div class="topBoxImgText">inn</div></a>
        </div>
        <div class="box registerBox">
            <div class="idReversIcon" onclick="leftPanel.slideTwoLogic()"><i class="fas fa-reply centerItem"></i></div>
            <a href="/account/settings" id="pushajax" data-type="pushajax" class="btn-mini white btn-full centerItem">Мій кабінет</a>

            <div class="inputBox">
                <label class="placeholder"></label>
                <input type="text" id="login" class="form-control" name="login" maxlength="9" value="<? if(isset($_SESSION['account']['login'])) echo $_SESSION['account']['login']; ?>" required>
            </div>
            <div class="inputBox">
                <label class="placeholder"></label>
                <input type="text" id="number" class="form-control" name="number" value="<? if(isset($_SESSION['account']['login'])) echo $_SESSION['account']['email']; ?>" required>
            </div>
            <div class="inputBox">
                <label class="placeholder">Пароль</label>
                <input type="password" class="form-control" name="password" inputChange="inputChange" onfocus="this.removeAttribute('readonly');" readonly required>
            </div>
            <div class="inputBox">
                <a href="/account/logout" class="btn btn-primary btn-full centerItem">Вийти</a>
            </div>
        </div>
        <div class="box authBox">
            <div class="idReversIcon" onclick="leftPanel.slideRevers_and_logic()"><i class="fas fa-bars centerItem"></i></div>
            <a href="/" id="pushajax" data-type="pushajax" ><i class="fas fa-home centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Головна</span></a>
            <a href="/catalog/all/30/desc/time" id="pushajax" data-type="pushajax" ><i class="fas fa-shopping-cart centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Магазин</span></a>
            <? if(isset($_SESSION['account']['status']) and $_SESSION['account']['status'] == 3): ?>
                <div class="idReversIcon" onclick="leftPanel.slideRevers_and_logic()"></div>
                <div class="idReversIcon" onclick="leftPanel.slideRevers_and_logic()"><i class="fas fa-tools centerItem"></i></div>
                <a href="/account/settings" id="pushajax" data-type="pushajax" ><i class="fas fa-user-cog centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Мій кабінет</span></a>
                <a href="/catalog/my_<? echo $_SESSION['account']['id'] ?>/30/desc/time" id="pushajax" data-type="pushajax" ><i class="fas fa-layer-group centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Мої товари</span></a>
                <a href="/new/goods" id="pushajax" data-type="pushajax"><i class="fas fa-cart-plus centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Додати товар</span></a>
                <a href="/media/view" id="pushajax" data-type="pushajax"><i class="fas fa-play-circle centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Перегляд реклами</span></a>
            <? endif; ?>
        </div>
    <? else: ?>
        <div class="topBox">
            <a class="topBtn" href="/"><img src="/public/img/favico.png"><div class="topBoxImgText">inn</div></a>
        </div>
        <div class="box registerBox">
            <div class="idReversIcon" onclick="leftPanel.slideTwoLogic()"><i class="fas fa-reply centerItem"></i></div>
            <form id="formLogin" action="/account/login" method="post" name="auth"></form>
            <div class="inputBox">
                <label class="placeholder">Унікальне Імя</label>
                <input type="text" form="formLogin" class="form-control" inputChange="inputChange" name="login" maxlength="9" required>
            </div>
            <input type="hidden" form="formLogin" name="default">
            <div class="inputBox">
                <label class="placeholder">Пароль</label>
                <input type="password" form="formLogin" class="form-control" inputChange="inputChange" name="password" required>
            </div>
            <a href="/account/recovery" class="white">Забули пароль?</a>
            <button type="submit" form="formLogin" class="btn btn-primary btn-full">Готово</button>
            <a href="/account/register" class="textBox">
                Вперше у нас? Зареєструйтесь
            </a>
        </div>
        <div class="box authBox">
            <div class="idReversIcon" onclick="leftPanel.slideRevers_and_logic()"><i class="fas fa-bars centerItem"></i></div>
            <a href="/" id="pushajax" data-type="pushajax" ><i class="fas fa-home centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Головна</span></a>
            <a href="/catalog/all/30/desc/time" id="pushajax" data-type="pushajax" ><i class="fas fa-shopping-cart centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Магазин</span></a>
        </div>
    <? endif; ?>
</div>
