<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedsItems extends Model
{
    protected $table = 'feeds';

    public function source()
    {
        return $this->hasOne('App\FeedSources', 'id', 'source_id');
    }
}
