<div>
    <button wire:click="openModal()" type="button" class="mypage__reservation-edit-button">
        編集
    </button>

    @if($showModal && isset($reservation))
    <div class="mypage__modal-edit">
        <div class="modal-body">
            <div class="modal-content">
                <form action="{{ route('updateProfile') }}" method="post">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                    <h4>予約編集</h4>
                    <div class="datepicker">
                        <input type="text" class="datepicker-input form-control" name="mypage_datepicker" id="mypage_datepicker">
                        <span class="datepicker-icon"><i class="fa-regular fa-calendar fa-fw"></i></span>
                    </div>
                    <div class="modal__reservation-input">
                        <label class="modal__reservation-label">
                            <select class="form-control modal__reservation-select" id="mypage_reservation_time" name="mypage_reservation_time">
                                <option value="" selected>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal__reservation-input">
                        <label class="modal__reservation-label">
                            <select class="form-control modal__reservation-select" id="mypage_reservation_number" name="mypage_reservation_number">
                                <option value="" selected>{{ $reservation->party_size }}</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal__reservation-footer">
                        <button wire:click="closeModal()" type="button" class="modal__reservation-close">閉じる</button>
                        <div>
                            <button type="submit" class="modal__reservation-submit">予約を変更する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <script src="{{ asset('js/mypage.js') }}"></script>
</div>