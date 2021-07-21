<?php

namespace App\Modules\Groups\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_group';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'group_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
