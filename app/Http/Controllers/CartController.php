<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = $subtotal * 0.11; // PPN 11%
        $total = $subtotal + $tax;

        return view('cart', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $productId = $request->input('id');
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) $quantity = 1;

        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        $price = $product->sale_price && $product->sale_price > 0 ? (float) $product->sale_price : (float) $product->regular_price;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $product->image,
                'category' => $product->category?->name ?? 'General',
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request): RedirectResponse
    {
        $productId = $request->input('id');
        $action = $request->input('action'); // 'increase', 'decrease' or direct qty
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($action === 'increase') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrease') {
                $cart[$productId]['quantity']--;
                if ($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]);
                }
            } elseif ($request->filled('quantity')) {
                $qty = (int) $request->input('quantity');
                if ($qty > 0) {
                    $cart[$productId]['quantity'] = $qty;
                } else {
                    unset($cart[$productId]);
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Keranjang belanja berhasil diperbarui.');
    }

    public function remove(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function checkout(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Keranjang Anda masih kosong. Silakan belanja terlebih dahulu.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.11;
        $total = $subtotal + $tax;

        return view('checkout', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.11;
        $total = $subtotal + $tax;

        $order = DB::transaction(function () use ($request, $cart, $subtotal, $tax, $total) {
            $order = Order::create([
                'user_id' => auth()->id() ?? null,
                'subtotal' => $subtotal,
                'discount' => 0,
                'tax' => $tax,
                'total' => $total,
                'name' => $request->name,
                'phone' => $request->phone,
                'locality' => $request->locality ?? '',
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => 'Indonesia',
                'zip' => $request->zip,
                'status' => 'ordered',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('order.confirmation', ['order' => $order->id])
            ->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    public function confirmation(int $id): View
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('order-confirmation', compact('order'));
    }
}
