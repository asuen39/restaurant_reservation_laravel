$(document).ready(function () {
    var now = new Date();

    // 現在の時刻から2時間後の時刻を計算
    var futureTime = new Date(now.getTime() + 1 * 60 * 60 * 1000); // 1時間後
    var futureHours = futureTime.getHours().toString().padStart(2, '0');
    var futureMinutes = Math.ceil(futureTime.getMinutes() / 30) * 30; // 30分単位で切り上げ
    futureMinutes = futureMinutes === 60 ? '00' : futureMinutes.toString().padStart(2, '0');
    var defaultTime = futureHours + ':' + futureMinutes;

    // 日本語に設定
    jQuery.datetimepicker.setLocale('ja');

    // 日付ピッカーの設定
    $('#datepicker').datetimepicker({
        minDate: 0, // 今日の日付以降のみ選択可能
        timepicker: false,  // Timepickerを無効化
        format: 'Y-m-d',     // 日付フォーマットの指定
        value: new Date(),   // デフォルトで今日の日付を表示
        onChangeDateTime: function (dp, $input) {
            // 選択された日付が今日の日付と同じかチェック
            var selectedDate = $input.val();
            var today = new Date();
            var todayStr = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');

            // 選択された日付を別のinputとspanに設定
            $('#selected_date_display').text(selectedDate); // 表示用のspan要素に値を設定
            $('#selected_date_input').val(selectedDate); // form送信用input要素に値を設定

            if (selectedDate === todayStr) {
                // 今日の日付が選択された場合、現在の時刻以降を制限
                $('#reservation_time').datetimepicker({
                    format: 'H:i',
                    minDate: 0, // 今日の日付
                    minTime: today.getHours() + ':' + today.getMinutes(), // 現在の時間以降
                    datepicker: false,
                });
            } else {
                // 他の日付が選択された場合、時間制限をリセット
                $('#reservation_time').datetimepicker({
                    format: 'H:i',
                    minTime: '00:00', // 0:00から選択可能
                    datepicker: false,
                });
            }
        }
    });

    // 初期化時に時間の設定
    $('#reservation_time').datetimepicker({
        format: 'H:i',
        step: 30, // 30分ごとの選択肢を提供
        minTime: defaultTime, // 現在の時間以降
        value: defaultTime, // デフォルトで14:00を設定
        datepicker: false,
        onChangeDateTime: function (dp, $input) {
            var selectedTime = $input.val();
            $('#selected_time_display').text(selectedTime); // 表示用のspan要素に値を設定
            $('#selected_time_input').val(selectedTime); // form送信用input要素に値を設定
        }
    });

    // 人数分のオプションを生成する処理
    for (let i = 1; i <= 50; i++) {
        let option = document.createElement("option");
        option.text = i;
        option.value = i;
        document.getElementById("reservation_number").add(option);
    }

    // 人数の変更時の処理
    $('#reservation_number').on('input', function () {
        var number = $(this).val();
        $('#selected_number_display').text(number);
        $('#selected_number_input').val(number); // input要素に値を設定
    });
});