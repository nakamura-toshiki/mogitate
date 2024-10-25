<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSeason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::Paginate(6);
        return view('index', compact('products'));
    }

    public function search(Request $request)
    {
        $sort = $request->input('sort', 'asc');

        $products = Product::orderBy('price', $sort)->where(function ($query) {
            if ($keyword = request('keyword')) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            }
        })->paginate(6);

        $keyword = $request->keyword;
        if (empty($keyword)) {
            return redirect('/products');
        }

        return view('search', compact('products', 'keyword', 'sort'));

    }

    public function show($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return view('register');
        }
        return view('show', compact('product'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($request->hasFile('image')) {
            \Storage::disk('public')->delete('fruits-img/' . $product->image);
            $imagePath = $request->file('image')->store('fruits-img', 'public');
            $product->image = basename($imagePath);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image,
        ]);

        ProductSeason::where('product_id', $product->id)->delete();
        if (!empty($request->season_id)) {
            foreach ($request->season_id as $seasonId) {
                ProductSeason::create([
                    'product_id' => $product->id,
                    'season_id' => $seasonId,
                ]);
            }
        }

        return redirect('/products');
    }

    public function store(ProductRequest $request)
    {

        $imagePath = $request->file('image')->store('fruits-img', 'public');
        $path = basename($imagePath);

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->textarea('description'),
            'image' => $path,
        ]);

        ProductSeason::insert(
            collect($request->season_id)->map(function ($seasonId) use ($product) {
                return [
                    'product_id' => $product->id,
                    'season_id' => $seasonId,
                ];
            })->toArray()
        );


        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('/products');
    }
}
