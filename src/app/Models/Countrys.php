<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countrys extends Model
{
    use HasFactory;

    // モデルと関連するテーブル名
    protected $table = 'countrys';

    // テーブルの主キー
    protected $primaryKey = 'id';

    // 可変項目（Mass Assignment）の設定
    protected $fillable = [
        'countrys'
    ];

    public function shops()
    {
        return $this->hasMany(shops::class, 'countrys');
    }
}
