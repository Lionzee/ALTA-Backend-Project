<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    protected $fillable = ['cart_id','product_id','quantity','note','total_price'];
    protected $hidden = ["created_at", "updated_at",'cart_id'];

    public static function isExist($product_id){
        $data = CartItem::where('product_id',$product_id)->where('cart_id',Cart::getCartId())->first();
        if($data){
            return true;
        }else{
            return false;
        }
    }

    public static function isMine($item_id){
        $user_id = Auth::user()->id;
        $item = CartItem::where('id',$item_id)->first();
        if($item){
            $cart = Cart::where('id',$item->cart_id)->first();
            if($cart->user_id == $user_id){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    public static function getTotalPrice($product_id,$quantity){
        $product = Product::where('id',$product_id)->first();
        return $product->price * $quantity;
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }



}
