<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    /*モデルのデフォルトのテーブル名 */
    protected $table = 'favorites';

    // テーブルの主キー
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'shop_id'];

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
}
