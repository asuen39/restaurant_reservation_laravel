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
    }

    public function closeModal()
    {
        $this->qrcodeModalflag = false;
    }

    public function render()
    {
        $reservation = Reservations::find($this->reservationId);

        return view('livewire.qrcode-modal', [
            'reservation' => $reservation
        ]);
    }
}
