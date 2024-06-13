document.addEventListener("livewire:load", function () {
    Livewire.on('reviewsOpenedjs', function () {
        // 星のラベルを取得
        const labels = document.querySelectorAll('.modal__star-label');
        const ratingInput = document.getElementById('rating_star');

        // 各ラベルにクリックイベントを追加
        labels.forEach(label => {
            label.addEventListener('click', function () {
                // クリックされたラベルの data-modal-id 属性の値を取得
                const modalId = this.getAttribute('data-modal-id');
                // クリックされたラベルの data-label-num 属性の値を取得
                const rating = this.getAttribute('data-label-num');

                // すべてのラベルに対して、クリックされたラベルまでの星に fill クラスを追加または削除
                labels.forEach(lbl => {
                    const lblRating = lbl.getAttribute('data-label-num');
                    if (lblRating <= rating) {
                        lbl.classList.add('fill');
                    } else {
                        lbl.classList.remove('fill');
                    }
                });

                // console.log(rating);

                // 選択した値を隠しフィールドに設定
                ratingInput.value = rating;

                // console.log('Selected rating for modal', modalId);
            });
        });
    });
});