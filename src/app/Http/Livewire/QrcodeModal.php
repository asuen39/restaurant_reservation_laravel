<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservations;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeModal extends Component
{
    public $reservationId;
    public $qrcodeModalflag = false;

    public function mount($reservationId)
    {
        $this->reservationId = $reservationId;
    }

    public function qrcodeOpened()
    {
        $this->qrcodeModalflag = true;
        // デバッグ用にログ出力
        logger('QR Code modal opened. Flag is now true.');
    }

    public function closeModal()
    {
        $this->qrcodeModalflag = false;
    }

    public function render()
    {
        $reservation = Reservations::find($this->reservationId);
        $qrCodeUrl = route('reservations.readQrCode', ['id' => $this->reservationId]);

        // デバッグ用にプロパティを出力
        logger('Rendering QrcodeModal component', ['qrcodeModalflag' => $this->qrcodeModalflag]);

        // ローカル用QRコードのURL生成
        $localQrCodeUrl = "http://192.168.11.4/reservations/read-qr-code/{$this->reservationId}";

        return view('livewire.qrcode-modal', [
            'reservation' => $reservation,
            'qrCodeUrl' => $qrCodeUrl,
            'localQrCodeUrl' => $localQrCodeUrl,
        ]);
    }
}
