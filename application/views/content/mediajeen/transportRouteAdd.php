<div class="container" id="container">
    <script src="/public/scripts/module/DataList.js"></script>

    <div class="big_w big_h">
        <div class="content_card">
            <form id="formTransportRoute" name="newTransportRoute" action="/transport_route/add" method="post"></form>
            <div class="btn-full">Новий маршут</div><br>

                <input type="text" form="formTransportRoute" class="form-control datalist-input" name="start_location_route" placeholder="Місто з якого стартує маршут">
                <input type="text" form="formTransportRoute" class="form-control datalist-input" name="end_location_route" placeholder="Кінцева точка маршуту">
            <button type="submit" form="formTransportRoute" class="btn btn-black btn-full">Додати</button>
        </div>
    </div>

    <script>
        const datalist = new DataList(
            ".datalist-input",
            ".datalist-ul"
        );
        datalist.addListeners(datalist);
    </script>

</div>
