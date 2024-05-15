<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    // モデルと関連するテーブル名
    protected $table = 'shops';

    // テーブルの主キー
    protected $primaryKey = 'id';

    // 可変項目（Mass Assignment）の設定
    protected $fillable = [
        'shops_name', 'image_path', 'countory_id', 'genre_id', 'description',
    ];

    /*リレーションシップ - Countrysモデル 他のモデルとの関連付けがある場合、リレーションシップを定義することでデータベースの結合 */
    public function belongsToCountry()
    {
        return $this->belongsTo(Countrys::class, 'countory_id');
    }

    /*リレーションシップ - Genresモデル */
    public function belongsToGenres()
    {
        return $this->belongsTo(Genres::class, 'genre_id');
    }

    public function favorite()
    {
        return $this->hasMany(Favorites::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservations::class);
    }
}
