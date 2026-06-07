<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $items  = Cart::with(['variant.product', 'variant.images'])
                      ->where('id_user', $userId)->get();
        return view('page.cart', compact('items'));
    }

    public function add(Request $request)
    {
        $userId    = session('user_id');
        $variantId = $request->id_variant;
        $qty       = max(1, (int) $request->quantity);

        $variant = ProductVariant::find($variantId);
        if (!$variant || $variant->stock < $qty) {
            return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi'], 400);
        }

        $cart = Cart::where('id_user', $userId)->where('id_variant', $variantId)->first();
        if ($cart) {
            $newQty = $cart->quantity + $qty;
            if ($newQty > $variant->stock) {
                return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi'], 400);
            }
            $cart->update(['quantity' => $newQty]);
        } else {
            Cart::create(['id_user' => $userId, 'id_variant' => $variantId, 'quantity' => $qty]);
        }

        $count = Cart::where('id_user', $userId)->count();
        return response()->json(['success' => true, 'cart_count' => $count]);
    }

    public function update(Request $request)
    {
        $userId = session('user_id');
        $cart   = Cart::where('id_cart', $request->id_cart)->where('id_user', $userId)->first();
        if (!$cart) return response()->json(['success' => false], 404);
        $qty = (int) $request->quantity;
        if ($qty <= 0) $cart->delete();
        else $cart->update(['quantity' => $qty]);
        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        Cart::where('id_cart', $request->id_cart)->where('id_user', session('user_id'))->delete();
        return response()->json(['success' => true]);
    }

    public function getId(Request $request)
    {
        $userId    = session('user_id');
        $variantId = $request->id_variant;
        $cart      = Cart::where('id_user', $userId)->where('id_variant', $variantId)->first();
        if (!$cart) {
            return response()->json(['id_cart' => null], 404);
        }
        return response()->json(['id_cart' => $cart->id_cart]);
    }

    public function select(Request $request)
    {
        $userId  = session('user_id');
        $cartIds = $request->cart_ids ?? [];
        $valid   = Cart::whereIn('id_cart', $cartIds)->where('id_user', $userId)->pluck('id_cart')->toArray();
        if (empty($valid)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada item valid'], 400);
        }
        session(['checkout_cart_ids' => $valid]);
        return response()->json(['success' => true]);
    }
}