<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public static function getCartId(){
        $cart_id = Cart::where('user_id',Auth::user()->id)->first();
        return $cart_id->id;
    }
}
