<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart_items(){
        $data = CartItem::orderBy('created_at','DESC')
            ->where('cart_id',Cart::getCartId())
            ->paginate(10);

        if($data){
            return response()->json([
                "error_code" => "00",
                "message" => "success get cart items",
                "data" => $data
            ]);
        }else{
            return response()->json([
                "error_code" => "00",
                "message" => "You currently have no item in cart",
            ]);
        }

    }

    public function store(Request $request){
        if(CartItem::isExist($request->product_id)){
            return response()->json([
                "error_code" => "04",
                "message" => "item add failed : duplicate entry"
            ]);
        }else{
            $data = CartItem::create([
                'cart_id' => Cart::getCartId(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'note' => $request->note,
                'total_price' => CartItem::getTotalPrice($request->product_id,$request->quantity),
            ]);


            return response()->json([
                "error_code" => "00",
                "message" => "item add success : item added to cart",
                "data" => $data,
            ]);
        }
    }
}
