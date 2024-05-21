<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    /*モデルのデフォルトのテーブル名 */
    protected $table = 'reviews';

    // テーブルの主キー
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'reservation_id', 'rating', 'comment'];

    /*リレーションシップ - Userモデル 他のモデルとの関連付けがある場合、リレーションシップを定義することでデータベースの結合 */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*リレーションシップ - Reservationsモデル */
    public function reservation()
    {
        return $this->belongsTo(Reservations::class, 'reservation_id');
    }
}
