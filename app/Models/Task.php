<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'subject_id', 'title', 'description', 'due_date', 'priority', 'status'];

    protected function casts(): array
    {
        return ['due_date' => 'date'];
    }

    public function user(): BelongsTo    { return $this->belongsTo(User::class); }
    public function subject(): BelongsTo { return $this->belongsTo(Subject::class); }
    public function tags(): BelongsToMany { return $this->belongsToMany(Tag::class)->withTimestamps(); }
    public function attachments(): MorphMany { return $this->morphMany(Attachment::class, 'attachable'); }
}
