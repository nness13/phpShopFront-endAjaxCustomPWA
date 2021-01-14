<div class="leftPanel">
    <? if( isset($_SESSION['account']['id']) ): ?>
        <div class="topBox">
                <a class="topBtn" href="/about/jeenkassa"><img src="/public/img/magic-lamp.svg"><div class="topBoxImgText"></div></a>
        </div>
        <div class="box registerBox">
            <div>
                <div class="idReversIcon" onclick="leftPanel.slideTwoLogic()"><i class="fas fa-reply centerItem"></i></div>
                <a href="/account/settings" id="pushpage" data-type="pushpage" class="btn-mini white btn-full centerItem">Мій кабінет</a>

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
        </div>
        <div class="box authBox">
            <div>
                <a data-href="/kassa/desktop" id="pushpage" data-type="pushpage"><i class="fas fa-home centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Робочий стіл</span></a>
                <a data-href="/kassa/retail" id="pushpage" data-type="pushpage"><i class="fas fa-kaaba centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Стіл кассира</span></a>
                <? if(isset($_SESSION['account']['status']) and $_SESSION['account']['status'] == 3): ?>
                    <div class="idReversIcon" onclick="leftPanel.slideRevers_and_logic()"><i class="fas fa-tools centerItem"></i></div>
                    <a data-href="/kassa/new/goods" id="pushpage" data-type="pushpage"><i class="fas fa-cart-plus centerItem"></i><span class="btn-text" onclick="leftPanel.slideRevers_and_logic()">Додати товар</span></a>
                <? endif; ?>
            </div>
            <div class="idReversIcon " onclick="leftPanel.slideRevers_and_logic()"><i class="fas fa-th centerItem"></i></div>
        </div>

    <? endif; ?>
</div>
