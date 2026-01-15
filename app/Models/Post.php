<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = ['id'];
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function getExcerptAttribute()
    {
        $text = strip_tags($this->content);
        $text = preg_replace('/[\w\s\-\(\)\.]+\.(jpg|jpeg|png|gif|pdf|doc|docx)\s+\d+(\.\d+)?\s+(KB|MB)/i', '', $text);
        return \Illuminate\Support\Str::limit(trim($text), 70);
    }
}
