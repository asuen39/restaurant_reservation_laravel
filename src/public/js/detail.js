$(function () {
    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'yyyy/mm/dd',
            container: '.datepicker',
            autoclose: true,
            language: 'ja',
        });

        $('#datepicker').datepicker('setDate', 'today');

        // 日付が選択されたときの処理
        $('#datepicker').on('changeDate', function (e) {
            // 選択された日付を取得
            var selectedDate = $('#datepicker').datepicker('getFormattedDate');
            // 取得した日付をフォームに反映
            $('#selected_date_display').text(selectedDate);
            $('#selected_date_input').val(selectedDate); // input要素に値を設定
        });

        // 予約時間の変更時の処理
        $('#reservation_time').on('input', function () {
            var time = $(this).val();
            $('#selected_time_display').text(time);
            $('#selected_time_input').val(time); // input要素に値を設定
        });

        // 人数の変更時の処理
        $('#reservation_number').on('input', function () {
            var number = $(this).val();
            $('#selected_number_display').text(number);
            $('#selected_number_input').val(number); // input要素に値を設定
        });
    });
});