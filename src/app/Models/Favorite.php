<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /*モデルのデフォルトのテーブル名 */
    protected $table = 'favorite';

    // テーブルの主キー
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'shop_id'];

    /*リレーションシップ - Userモデル 他のモデルとの関連付けがある場合、リレーションシップを定義することでデータベースの結合 */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*リレーションシップ - Shopsモデル */
    public function shops()
    {
        return $this->belongsTo(Shops::class);
    }
}
