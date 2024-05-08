<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    use HasFactory;

    // モデルと関連するテーブル名
    protected $table = 'genres';

    // テーブルの主キー
    protected $primaryKey = 'id';

    // 可変項目（Mass Assignment）の設定
    protected $fillable = [
        'genres'
    ];

    public function shops()
    {
        return $this->hasMany(shops::class, 'genres');
    }
}
