<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function cart_items(){
        $data = Cart::with('users','cart_items')
            ->where('user_id',Auth::user()->id)
            ->get();

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

    public function update_item(Request $request,$item_id){
        $check = CartItem::isMine($item_id);
        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric|gt:0'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if($check){
            $data = CartItem::where('id',$item_id)->first();
            $data->quantity = $request->qty;
            $data->total_price = CartItem::getTotalPrice($data->product_id,$request->qty);
            $data->save();

            return response()->json([
                "errorCode" => "00",
                "message" => "update success : item updated",
                "data" => $data,
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed update : can't find any item"
            ]);
        }
    }

    public function delete_item($item_id){
        $check = CartItem::isMine($item_id);
        if($check){
            $item = CartItem::find($item_id);
            $item->delete();

            return response()->json([
                "errorCode" => "00",
                "message" => "item deleted"
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "cant find item"
            ]);
        }
    }
}
