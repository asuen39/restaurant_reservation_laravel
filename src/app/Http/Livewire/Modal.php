<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $showModal = false;
    public $reservation; // 予約情報を格納するプロパティ

    // $reservation変数をコンポーネントに渡すためのmountメソッド
    public function mount($reservation)
    {
        $this->reservation = $reservation; // $reservation をプロパティにセット
    }

    public function render()
    {
        return view('livewire.modal');
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->emit('modalOpened'); // モーダルが開かれたことをJavaScriptに通知する
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
