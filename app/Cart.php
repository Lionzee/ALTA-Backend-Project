<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = ['user_id'];
    protected $hidden = ["created_at", "updated_at",];

    public static function getCartId(){
        $cart_id = Cart::where('user_id',Auth::user()->id)->first();
        return $cart_id->id;
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }


}
