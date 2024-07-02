<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservations;
use App\Models\Reviews;

class ReviewsModal extends Component
{
    public $isOpen = false;
    public $userId;
    public $reservation; // 予約情報を格納するプロパティ
    public $shopId;
    public $reviews;
    public $comment;
    public $selectedRating;

    // $reservation変数をコンポーネントに渡すためのmountメソッド
    public function mount(Reservations $reservation)
    {
        $this->reservation = $reservation; // $reservation をプロパティにセット
        $this->shopId = $reservation->shop_id; // reservation から shop_id を取得

        // shopIdを元にReviewsを取得
        $this->reviews = Reviews::where('reservation_id', $this->shopId)->with('user')->get();
    }

    public function reviewsOpened()
    {
        $this->isOpen = true;
        $this->emit('reviewsOpenedjs'); // モーダルが開かれたことをJavaScriptに通知する
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.reviews-modal', [
            'reviews' => $this->reviews, // 取得したレビュー情報をビューに渡す
        ]);
    }
}
