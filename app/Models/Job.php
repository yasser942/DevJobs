<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'company',
        'title',
        'location',
        'email',
        'website',
        'tags',
        'description',
        'user_id',
        'photo_path'
    ];

    // Mutator for 'tags' attribute
    public function setTagsAttribute($value)
    {
        // Ensure the tags value is an array
        $tags = is_array($value) ? $value : explode(',', $value);

        // Trim and remove any empty tags
        $tags = array_map('trim', $tags);
        $tags = array_filter($tags);

        // Store the tags as a JSON-encoded array
        $this->attributes['tags'] = json_encode($tags);
    }

    // Accessor for 'tags' attribute
    public function getTagsAttribute($value)
    {
        // Retrieve the tags as a decoded array
        return json_decode($value, true) ?: [];
    }

    public function scopeFilter($query ,array $filters ){

        if($filters['tag']??false){
            $query -> where('tags','like', '%' . $filters['tag'] . '%');
        }

        if($filters['search']??false){
            $query -> where('title','like', '%' . $filters['search'] . '%')
            ->orWhere('description','like', '%' . $filters['search'] . '%')
            ->orWhere('tags','like', '%' . $filters['search'] . '%');
        }
    }

    public function scopeSearch($query ,array $filters ){

        if($filters['title']??false){
            $query -> where('title','like', '%' . $filters['title'] . '%');
        }
    }

    public function user (){
        $this-> hasOne(User::class, 'user_id');
    }
}
