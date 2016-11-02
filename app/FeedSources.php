<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedSources extends Model
{
    protected $table = 'feed_sources';

    protected $fillable = ['title', 'description' , 'url' , 'provider_url' ,'category_id']; 

    public function category()
    {
        return $this->hasOne('App\Categories', 'id', 'category_id');
    }
}
