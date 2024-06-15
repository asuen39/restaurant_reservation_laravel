<!-- resources/views/livewire/qrcode-modal.blade.php -->
<div>
    <button wire:click="qrcodeOpened()" type="button" class="mypage__reservation-edit-button">
        QRコード
    </button>

    @if($qrcodeModalflag)
    <div class="mypage__modal-edit">
        <div class="qrcode__modal-body">
            <div class="modal-content">
                @if ($reservation)
                <h2>QRコード:</h2>
                {!! QrCode::size(60)->generate(route('reservations.readQrCode', ['id' => $reservation->id])) !!}
                @else
                <p>QRコードが読み取れない</p>
                @endif
                <button wire:click="closeModal()" type="button" class="modal__reservation-close">閉じる</button>
            </div>
        </div>
    </div>
    @endif
</div>