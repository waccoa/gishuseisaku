<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'detail',
        'release',
        'status',
        'rental_date',
        
    ];
    // const TYPE_NAME = [
    //     '1' => 'ノンフィクション',
    //     '2' => 'ミステリー',
    //     '3' => 'ファンタジー',
    //     '4' => '歴史小説',
    //     '5' => '短編小説',
    //     '6' => '図鑑',
    //     '7' => 'エッセイ',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
