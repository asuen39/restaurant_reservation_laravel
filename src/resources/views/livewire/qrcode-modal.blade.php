<div>
    <button wire:click="qrcodeOpened()" type="button" class="mypage__reservation-edit-button">
        QRコード
    </button>

    @if($qrcodeModalflag)
    <div class="mypage__modal-edit">
        <div class="qrcode__modal-body">
            <div class="modal-content">
                <div>
                    @if ($reservation)
                    <h2 class="qrcode__modal-sp-h2">QRコード:</h2>
                    <p class="modal__qr-content">{!! QrCode::size(180)->generate($qrCodeUrl) !!}</p>
                    <h2 class="qrcode__modal-sp-h2">ローカル確認用QRコード:</h2>
                    <p class="modal__qr-content">{!! QrCode::size(180)->generate($localQrCodeUrl) !!}</p>
                    @else
                    <p>この予約には QR コードがありません</p>
                    @endif
                </div>
                <div class="modal__reservation-footer">
                    <button wire:click="closeModal()" type="button" class="modal__reservation-close">閉じる</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>