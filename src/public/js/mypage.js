// Livewireのコンポーネントがロードされた後に実行される関数を定義
document.addEventListener("livewire:load", function () {
    //Model.phpで設置したmodalOpenedで処理する。closeModal時にエラーを発生させない為。
    Livewire.on('modalOpened', function () {
        // モーダルが開かれたときの処理
        // datepickerの初期化
        $('#mypage_datepicker').datepicker({
            format: 'yyyy/mm/dd',
            container: '.datepicker',
            autoclose: true,
            language: 'ja',
        });

        // 今日の日付を設定
        $('#mypage_datepicker').datepicker('setDate', 'today');

        // 24時間分のオプションを生成する処理
        for (let hour = 0; hour < 24; hour++) {
            for (let minute = 0; minute < 60; minute += 30) {
                // 時刻をフォーマットしてオプションを生成
                let time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                let option = document.createElement("option");
                option.text = time;
                option.value = time;
                document.getElementById("mypage_reservation_time").appendChild(option);
            }
        }

        // 人数分のオプションを生成する処理
        for (let i = 1; i <= 50; i++) {
            let option = document.createElement("option");
            option.text = i;
            option.value = i;
            document.getElementById("mypage_reservation_number").appendChild(option);
        }
    });
});