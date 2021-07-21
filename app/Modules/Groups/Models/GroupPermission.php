<?php

namespace App\Modules\Groups\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'group_id', 'permission', 'value', 'module'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'value' => 'boolean'
    ];
}
