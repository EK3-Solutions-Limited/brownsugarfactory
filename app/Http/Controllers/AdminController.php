<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\Products as ProductsResource;
use App\Http\Resources\Order as OrderResource;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->except(['login', 'showlogin']);
    }
    //
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password]
        )) {
            return redirect()->intended(route('admin.home'));
        } else {
            return back()->withErrors(['invalid' => 'Credentials Invalid']);
        }
    }

    public function showlogin()
    {
        return view('admin.login');
    }


    public function index()
    {
        $ordersCount = Order::all()->count();
        $newOrders = Order::where('status', '=', 'new')->get()->count();
        return view('admin.home', compact('ordersCount', 'newOrders'));
    }

    public function viewOrder($order)
    {
        # code...
        $order = Order::find($order);
        return view('admin.orders.view', compact('order'));
    }

    public function apiViewOrder(Order $order)
    {
        return new OrderResource($order);
    }
    function allOrders()
    {
        $orders = Order::all();
        return view('admin.orders.all', compact('orders'));
    }

    public function apiAllOrders()
    {
        return OrderResource::collection(Order::all());
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $order->updateStatus($request->status);
        return redirect()->back()->with('success', 'Order has been updated, and the customer has been notified');
    }

    public function allProducts(Request $request)
    {
        $products = Product::all();
        return view('admin.products.all', compact('products'));
    }



    public function getProduct(Product $product)
    {
        return view('admin.products.view', compact('product'));
    }

    public function apiViewProduct(Product $product)
    {
        return new ProductsResource($product);
    }

    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $product->update($request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|min:10',
            'thumbnail' => 'image'
        ]));
        # code...
        return redirect(route('admin.viewProduct', $product->id))->with('success', 'Product Updated');
    }

    public function unavailable(Product $product)
    {
        $product->update(['status' => 'unavailable']);

        return redirect()->back()->with('success', 'Product Unavailable');
    }


    public function available(Product $product)
    {
        $product->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Product Available');
    }
}
