<div>
    <button wire:click="reviewsOpened( {{ $reservation->shop_id }} )" type="button" class="mypage__reservation-edit-button">
        レビュー
    </button>
    @if($isOpen)
    <div class="mypage__modal-edit">
        <div class="reviews__modal-body">
            <div class="modal-content">
                <span class="close" wire:click="closeModal">&times;</span>
                <h4>レビュー一覧</h4>
                <ul class="modal__review-list-area">
                    @foreach($reviews as $review)
                    <li class="modal__review-list">
                        <div class="modal__review-list-left">
                            <div>{{ $review->user->name }}さん</div>
                            <div>{{ $review->comment }}</div>
                        </div>
                        <div class="modal__review-list-right">
                            @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                                <label for="star{{ $i }}" data-label-num="{{ $i }}" class="star-list-label fill-list"></label>
                                @else
                                <label for="star{{ $i }}" data-label-num="{{ $i }}" class="star-list-label"></label>
                                @endif
                                @endfor
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="modal__newReview-content">
                    <div class="modal__newReview-inner">
                        <h4>レビュー入力</h4>
                        <form id="reviewForm" action="{{ route('submitReview') }}" method="post">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $shopId }}">
                            <div class="modal__star-content">
                                <h5 class="modal__star-shop">お店の評価</h5>
                                <div class="modal__star-rating">
                                    <input type="radio" name="rating" value="1" id="star1" class="modal__star-input">
                                    <label for="star1" data-label-num="1" class="modal__star-label"></label>
                                    <input type="radio" name="rating" value="2" id="star2" class="modal__star-input">
                                    <label for="star2" data-label-num="2" class="modal__star-label"></label>
                                    <input type="radio" name="rating" value="3" id="star3" class="modal__star-input">
                                    <label for="star3" data-label-num="3" class="modal__star-label"></label>
                                    <input type="radio" name="rating" value="4" id="star4" class="modal__star-input">
                                    <label for="star4" data-label-num="4" class="modal__star-label"></label>
                                    <input type="radio" name="rating" value="5" id="star5" class="modal__star-input">
                                    <label for="star5" data-label-num="5" class="modal__star-label"></label>
                                </div>
                                <input type="hidden" name="rating_star" id="rating_star" value="0">
                            </div>
                            <textarea id="comment" name="comment" class="modal__comment-input" placeholder="感想を入力してください"></textarea>
                            <div class="modal__review-fotter-button">
                                <button type="submit" class="modal__review-submit-text">レビューを書き込む</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script src="{{ asset('js/reviews.js') }}"></script>
</div>