<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Providers\StockPolicy;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $product_id = $request->input('product_id');

        $stocks = Stock::where('product_id', $product_id)->get();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('stocks.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user_id = $data['user_id'];
        $product_id = $data['product_id'];
    
        $existingStock = Stock::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingStock) {
            $existingStock->update([
                'quantity' => $existingStock->quantity + $data['quantity'],
            ]);
        } else {
            $stock = new Stock();
            $stock->user_id = $data['user_id'];
            $stock->product_id = $data['product_id'];
            $stock->quantity = $data['quantity'];
            $stock->save();
        }
        return redirect()->route('admin.products.index');
    }

    public function show(Stock $stock)
    {
        //
    }

    public function edit(Stock $stock)
    {
        $this->authorize('update', $stock);
        $products = Product::all();
        return view('stocks.edit', compact('stock', 'products'));
    }

    public function update(Request $request, Stock $stock)
    {
        $this->authorize('update', $stock);
        $stock->update([
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('admin.products.index');
    }


    public function destroy(Stock $stock)
    {
        $this->authorize('delete', $stock); 
        $stock->delete();
        return redirect()->route('admin.stocks.index');
    }
}
