// Livewireのコンポーネントがロードされた後に実行される関数を定義
document.addEventListener("livewire:load", function () {
    //Model.phpで設置したmodalOpenedで処理する。closeModal時にエラーを発生させない為。
    Livewire.on('modalOpened', function () {
        // モーダルが開かれたときの処理
        // datepickerの初期化
        $('#mypage_datepicker').datepicker({
            startDate: new Date(),
            format: 'yyyy/mm/dd',
            autoclose: true,
            language: 'ja',
            container: '.datepicker__calender-positon',
        });

        // 24時間分のオプションを生成する処理
        let selectElement = document.getElementById("mypage_reservation_time");
        for (let hour = 0; hour < 24; hour++) {
            for (let minute = 0; minute < 60; minute += 30) {
                // 時刻をフォーマットしてオプションを生成
                let time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                // 既に同じ値のオプションが存在するか確認
                let exists = Array.from(selectElement.options).some(option => option.value === time);
                if (!exists) {
                    let option = document.createElement("option");
                    option.text = time;
                    option.value = time;
                    selectElement.appendChild(option);
                }
            }
        }

        // 人数分のオプションを生成する処理
        let selectNumber = document.getElementById("mypage_reservation_number");
        for (let i = 1; i <= 50; i++) {
            // 既に同じ値のオプションが存在するか確認
            let exists = Array.from(selectNumber.options).some(option => option.value == i);
            if (!exists) {
                let option = document.createElement("option");
                option.text = i;
                option.value = i;
                selectNumber.appendChild(option);
            }
        }
    });
});