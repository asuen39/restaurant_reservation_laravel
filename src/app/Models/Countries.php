<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    // モデルと関連するテーブル名
    protected $table = 'countries';

    // テーブルの主キー
    protected $primaryKey = 'id';

    // 可変項目（Mass Assignment）の設定
    protected $fillable = [
        'countries'
    ];

    public function shops()
    {
        return $this->hasMany(shops::class, 'countries');
    }
}
