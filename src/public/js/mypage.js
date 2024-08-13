// Livewireのコンポーネントがロードされた後に実行される関数を定義
document.addEventListener("livewire:load", function () {
    //Model.phpで設置したmodalOpenedで処理する。closeModal時にエラーを発生させない為。
    Livewire.on('modalOpened', function () {
        // モーダルが開かれたときの処理
        // 予約時間を取得
        var reservationTime = document.getElementById('mypage_reservation_time').value;

        // 日本語に設定
        jQuery.datetimepicker.setLocale('ja');

        // 日付ピッカーの設定
        $('#mypage_datepicker').datetimepicker({
            minDate: 0, // 今日の日付以降のみ選択可能
            timepicker: false,  // Timepickerを無効化
            format: 'Y-m-d',     // 日付フォーマットの指定

            onChangeDateTime: function (dp, $input) {
                // 選択された日付が今日の日付と同じかチェック
                var selectedDate = $input.val();
                var today = new Date();
                var todayStr = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');

                if (selectedDate === todayStr) {
                    // 今日の日付が選択された場合、現在の時刻以降を制限
                    $('#mypage_reservation_time').datetimepicker({
                        format: 'H:i',
                        minDate: 0, // 今日の日付
                        minTime: today.getHours() + ':' + today.getMinutes(), // 現在の時間以降
                        datepicker: false,
                    });
                } else {
                    // 他の日付が選択された場合、時間制限をリセット
                    $('#mypage_reservation_time').datetimepicker({
                        format: 'H:i',
                        minTime: '00:00', // 0:00から選択可能
                        datepicker: false,
                    });
                }
            }
        });

        // 初期化時に時間の設定
        $('#mypage_reservation_time').datetimepicker({
            format: 'H:i',
            step: 30, // 30分ごとの選択肢を提供
            datepicker: false,
            minTime: reservationTime, // 当日の予約時間以降
            value: $('#mypage_reservation_time').val(),
        });

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