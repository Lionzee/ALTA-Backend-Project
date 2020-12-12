<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name','description','price','stock'];
    protected $hidden = ["created_at", "updated_at"];
}
