<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'isbn',
        'publish_year',
        'image',
        'is_approved',
        'total_view',
        'total_search',
        'total_borrowed',
        'description',
        'user_id',
        'category_id',
        'publisher_id',
        'translator_id',
    ];


    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the category that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the publisher that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    /**
     * Get the translator that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translator()
    {
        return $this->belongsTo(Translator::class, 'translator_id', 'id');
    }

     /**
      *  isAuthorSelected
      *
      *   return @type TRUE && FALSE
      *
      */
    public static function isAuthorSelected($book_id, $author_id)
    {
       $book_author = BookAuthor::where('book_id', $book_id)->where('author_id', $author_id)->first();
       if (!is_null($book_author)) {
           return true;
       }
        return false;

    }
}
