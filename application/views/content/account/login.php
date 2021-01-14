<div class="layout log_in-background" id="container">

    <div class="text-log_in-layout">
        <div class="reg-text reg-text-supplies">
            <h1>Jeen запрошує вас до партнерства!</h1>
            <div style="width:70%;">Створіть свій магазин з Jeen та заробляйте, працюючи як незалежний підрядник. Використовуй наш сервіс щоб забезпечити товаром свій магазин. Ми знайдемо кращих поставщиків спеціально для вас. Працюйте на себе та визначайте власний графік.</div>
        </div>
        <div class="reg-text reg-text-client">
            <h1>Jeen запрошує вас до партнерства!</h1>
            <div style="width:70%;">Додайте товар у декілька кліків, та ми повідомимо коли у вашій панелі замовленнь зявиться пост. Отримуйте платню щоденно та розвивайте свій бізнес, допомагаючи користувачам сервісу розвивати та автоматизувати свій!</div>
        </div>


    </div>

    <div class="form-log_in-layout">
        <div class="container-card">
            <div class="flip-card-inner">

                <div class="flip-card-front this-card" >
                    <form id="formLogin" action="/account/login" method="post" name="auth"></form>
                    <a onclick="flip('#flipandslide')" class="btn btn-black btn-full">створити обліковий запис</a>
                    <div>Заповніть форму щоб авторизуватись:</div>

                    <div class="btn btn-black btn-fifty btn-inline" onclick="flip('#flipandslide')" id="backflipandslide">Створити</div>

                    <div class="btn btn-primary btn-active btn-fifty btn-inline">Увійти</div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="text" form="formLogin" class="form-control" name="login" <?php if(isset($login)){echo 'value="'.$login.'"';}  ?> placeholder="Імя користувача">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="password" form="formLogin" id="password" class="form-control" name="password" placeholder="Пароль">
                        </div>
                    </div>

                    <p class="text-register">
                        Продовжуючи, я погоджуюся з <a>Умовами використання</a> та підтверджую, що приймаю <a>Політику конфіденційності</a> Jeen.<br><br>
                        Я також надаю згоду на те, що Jeen або представники компанії можуть зв’язуватися зі мною електронною поштою, телефонувати мені або надсилати SMS, зокрема за допомогою автоматизованих систем, використовуючи надані мною електронну адресу та номер телефону, зокрема для рекламних цілей.
                    </p>
                    <button type="submit" form="formLogin" class="btn btn-black btn-full">Увійти</button>

                    </form>
                </div>

                <div class="flip-card-back this-card">
                    <form action="/account/register" method="post" name="register">
                        <a onclick="backflip('#backflipandslide')" class="btn btn-black btn-full">вже маєте обліковий запис?</a>
                        <div>Створити новий обліковий запис:</div>

                        <div class="btn btn-primary btn-active btn-fifty btn-inline">Створити</div>

                        <div class="btn btn-black btn-fifty btn-inline" onclick="backflip('#backflipandslide')" id="flipandslide">Увійти</div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" class="form-control" name="login" placeholder="Унікальне Імя">
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="ref">

                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" class="form-control" name="number" placeholder="Телефон">
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Пароль">
                            </div>
                        </div>

                        <p class="text-register">
                            Продовжуючи, я погоджуюся з <a>Умовами використання</a> та підтверджую, що приймаю <a>Політику конфіденційності</a> Jeen.<br><br>
                            Я також надаю згоду на те, що Jeen або представники компанії можуть зв’язуватися зі мною електронною поштою, телефонувати мені або надсилати SMS, зокрема за допомогою автоматизованих систем, використовуючи надані мною електронну адресу та номер телефону, зокрема для рекламних цілей.
                        </p>

                        <div><br>
                            <button type="submit" class="btn btn-black btn-full">Реєстрація</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

</div>