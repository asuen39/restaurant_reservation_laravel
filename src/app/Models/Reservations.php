<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    /*モデルのデフォルトのテーブル名 */
    protected $table = 'reservations';

    // テーブルの主キー
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'shop_id', 'reservation_date', 'reservation_time', 'party_size'];

    /*モデルの日付フィールドの保存形式 */
    protected $dateFormat = 'Y-m-d H:i:s';

    /*モデルのキャスト属性 */
    protected $casts = [
        'reservation_time' => 'datetime:H:i:s',
    ];

    /*リレーションシップ - Userモデル 他のモデルとの関連付けがある場合、リレーションシップを定義することでデータベースの結合 */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*リレーションシップ - Shopモデル */
    public function shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id');
    }

    public function review()
    {
        return $this->hasMany(Reviews::class);
    }
}
