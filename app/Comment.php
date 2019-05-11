<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function createdAt()
    {
        return $this->created_at->diffForHumans();
    }
}
