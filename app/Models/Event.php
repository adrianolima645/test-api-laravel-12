<?php

namespace App\Models;

use App\Enums\EventType;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['user_id', 'book_id', 'type', 'event_date'];

    protected $casts = [
        'type' => EventType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
