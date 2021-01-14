<div class="layout log_in-background" id="container">
    
    <div class="text-log_in-layout">
        <div class="reg-text reg-text-supplies">
            <h1>Коротко про нові функції та можливості сервісу!</h1>
            <ul>
                <li>Новий дизайн: спрямований на легкість у користуванні сервісом.</li>
                <li>Заповни всього 2 текстових поля, щоб додати товар за лічені секунди.</li>
                <li>Легкий пошук товару, адже ми знаєм про ваші потреби.</li>
                <li>Оптимальна ціна та якісний товар від підтвержених поставщиків ✔</li>
            </ul>
        </div> 
        <div class="reg-text reg-text-client">
            <?php
                if(isset($login)){
                    echo "<h1>$login, ви успішно зареєструвались!<br>Авторизуйтесь щоб почати роботу!</h1>";
                }
            ?>
            <h1>Коротко про нові функції та можливості сервісу!</h1>
            <ul>
                <li>Новий дизайн: спрямований на легкість у користуванні сервісом.</li>
                <li>Заповни всього 2 текстових поля, щоб додати товар за лічені секунди.</li>
                <li>Легкий пошук товару, адже ми знаєм про ваші потреби.</li>
                <li>Оптимальна ціна та якісний товар від підтвержених поставщиків ✔</li>
            </ul>
        </div> 


    </div>

    <div class="form-log_in-layout">
        <div class="container-card">
            <div class="flip-card-inner">

                <div class="flip-card-front this-card" >
                    <form id="recovery" action="/account/recovery" method="post" name="recovery"></form>
                    <a href="/account/register" class="btn btn-black btn-full" >створити обліковий запис</a>
                    <div >Заповніть форму для відновлення паролю:</div>
                    <div class="btn btn-primary btn-active btn-fifty btn-inline">Відновлення</div>
                        <div class="btn btn-black btn-fifty btn-inline" onclick="flip('#flipandslide')" id="flipandslide">Пароль</div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="text" form="recovery" class="form-control" name="login" placeholder="Унікальне Імя">
                        </div>
                    </div>
                    <button type="submit" form="recovery" class="btn btn-black btn-full">Відновиити пароль</button>

                </div>

                <div class="flip-card-back this-card" >
                    <form id="formLogin" action="/account/login" method="post" name="auth"></form>
                    <a href="/account/register" class="btn btn-black btn-full" >створити обліковий запис</a>
                        <div >Заповніть форму для відновлення паролю:</div> 
                        <div class="btn btn-black btn-fifty btn-inline" onclick="backflip('#backflipandslide')" id="backflipandslide">Відновлення</div>
                        <div class="btn btn-primary btn-active btn-fifty btn-inline">Вхід</div>

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
                    <button type="submit" form="formLogin" class="btn btn-black btn-full">Увійти</button>
                </div>

            </div>
        </div>
    </div>

</div>