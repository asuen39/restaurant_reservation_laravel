$(document).ready(function () {
    $("#datepicker").datepicker({
        startDate: new Date(),
        format: 'yyyy/mm/dd',
        autoclose: true,
        language: 'ja',
        clearBtn: true,     // クリアボタンを表示
        container: '.datepicker__calender-positon' // カレンダーを表示する場所
    });

    var today = new Date();
    $('#datepicker').datepicker('setDate', today); // 今日の日付をセット

    // 日付が選択されたときの処理
    $('#datepicker').on('changeDate', function (e) {
        // 選択された日付を取得
        var selectedDate = $('#datepicker').datepicker('getFormattedDate');
        // 取得した日付をフォームに反映
        $('#selected_date_display').text(selectedDate); // 表示用のspan要素に値を設定
        $('#selected_date_input').val(selectedDate); // form送信用input要素に値を設定
    });

    // 24時間分のオプションを生成する処理
    for (let hour = 0; hour < 24; hour++) {
        for (let minute = 0; minute < 60; minute += 30) {
            // 時刻をフォーマットしてオプションを生成
            let time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            let option = document.createElement("option");
            option.text = time;
            option.value = time;
            document.getElementById("reservation_time").add(option);
        }
    }

    // 予約時間の変更時の処理
    $('#reservation_time').on('input', function () {
        var time = $(this).val();
        $('#selected_time_display').text(time);
        $('#selected_time_input').val(time); // input要素に値を設定
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