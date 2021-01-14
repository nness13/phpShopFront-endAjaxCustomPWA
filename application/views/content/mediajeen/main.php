<div class="container" id="container">
    <div class="big_w h4 m_full_w" id="hoverDataGoods">
        <img class="containerdivimg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/default_img/tvjeen.jpg" alt="2">
        <div class="dataGoods white">
            <a class="white" href="/kassa">Jeen Kassa</a>
            <br><br>Друзі<br>
            Готові запропонувати вам спробувати нашу систему обліку товарів для всіх платформ що дає багато переваг :
            <ul>
                <li>

                </li>
            </ul>
        </div>
    </div>
    <? if(isset($_SESSION['account']['status']) and $_SESSION['account']['status'] == 3): ?>
        <div class="triple_w big_h m_full_w m_4_h" id="hoverDataGoods">
            <img class="containerdivimg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/default_img/llumar_hi_tech.jpg" alt="2">
            <div class="dataGoods white">
                <a class="white" href="/home" id="pushajax" data-type="pushajax">Build Smart Home</a>
                <br><br>
            </div>
        </div>
        <div class="triple_w big_h m_full_w m_4_h hover_stop" id="hoverDataGoods">
            <img class="containerdivimg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/default_img/managed-wordpress-hosting-2.png" alt="2">
            <div class="dataGoods white">
                <a class="white" href="/home" id="pushajax" data-type="pushajax">Команда розробників
                <br><br>

                    Розробимо сайт та додаток з подальшою підтримкою
                </a>
            </div>
        </div>
        <div class="big_w small_h m_full_w" id="hoverDataGoods">
            <img class="containerdivimg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/default_img/tvjeen.jpg" alt="2">
            <div class="dataGoods white">
                <a class="white" href="/home" id="pushajax" data-type="pushajax">OkJeen</a>
                <br><br>Справжній джинн у твоєму домі!
            </div>
        </div>
        <div class="small_w big_h m_fifty_w" id="hoverDataGoods">
            <img class="containerdivimg noscaleImg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/default_img/photo-1536273176101-b3810e5cb3c0_800.jpg" alt="4">
            <div class="dataGoods white">
                <a class="white" href="/home" id="pushajax" data-type="pushajax">JeenExpress</a>
                <br><br>Купляй не задумуючись про доставку!
            </div>
        </div>
        <div class="big_w small_h m_full_w m_4_h" id="hoverDataGoods">
            <img class="containerdivimg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/default_img/smarthome.jpg" alt="2">
            <div class="dataGoods white">
                <a class="white" href="/home" id="pushajax" data-type="pushajax">SmartHome</a>
                <br><br>
            </div>
        </div>
    <? endif; ?>
    <script>
        app.hover_stop();
        app.JeenLazyLoad();
    </script>
</div>