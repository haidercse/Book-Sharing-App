<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'owner_id',
        'user_message',
        'owner_message',
        'is_seen',
        'status',
        'owner_confirm_time',
        'owner_reject_time',
        'user_confirm_time',
        'return_time',
        'return_confirm_time',
    ];
    /**
     * Get the owner1 that owns the BookRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner_name()
    {
        return $this->belongsTo(BookRequest::class);
    }
    /**
     * Get the user that owns the BookRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
     /**
     * Get the user that owns the BookRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

     /**
     * Get the user that owns the BookRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
