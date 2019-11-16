<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 *
 * @property integer $id
 * @property string $text
 * @property string $img
 * @property integer $user_id
 * @property integer $parent_id
 *
 * @property User $user
 * @property Message $messages
 *
 *
 * @author Ibra Aushev <aushevibra@yandex.ru>
 */
class Message extends Model
{
    use SoftDeletes;

    const ATTR_ID        = 'id';
    const ATTR_TEXT      = 'text';
    const ATTR_IMG       = 'img';
    const ATTR_USER_ID   = 'user_id';
    const ATTR_PARENT_ID = 'parent_id';

    const WITH_USER     = 'user';
    const WITH_MESSAGES = 'messages';

    protected $fillable = [
        self::ATTR_TEXT,
        self::ATTR_IMG,
        self::ATTR_USER_ID,
        self::ATTR_PARENT_ID,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(static::class, static::ATTR_PARENT_ID);
    }
}
