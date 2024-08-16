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
        'shops_name',
        'image_path',
        'country_id',
        'genre_id',
        'description',
    ];

    /*リレーションシップ - Countriesモデル 他のモデルとの関連付けがある場合、リレーションシップを定義することでデータベースの結合 */
    public function belongsToCountry()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    /*リレーションシップ - Genresモデル */
    public function belongsToGenre()
    {
        return $this->belongsTo(Genres::class, 'genre_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorites::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }
}
