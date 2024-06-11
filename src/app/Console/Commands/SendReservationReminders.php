<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservations;
use App\Mail\ShopMail;
use Carbon\Carbon;
use App\Notifications\ReservationReminder;

class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'send:test-mail';
    protected $signature = 'send:reservation-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminders to customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 今日の日付を取得
        $today = Carbon::today();

        // 当日の予約を取得
        $reservations = Reservations::whereDate('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            $email = $reservation->user->email;
            $userName = $reservation->user->name;
            $shopName = $reservation->shop->shops_name;

            // メール送信
            Mail::to($email)->send(new ShopMail($userName, $shopName));
        }
    }
}
