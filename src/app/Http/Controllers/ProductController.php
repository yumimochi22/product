<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);

        return view('products.index', compact('products'));
    }   

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = Product::query();
        
        if ($request->filled('keyword')) {
            $query->where(
                'name',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        if ($request->price === 'asc') {
            $query->orderBy('price', 'asc');
        }

        if ($request->price === 'desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('products.search', compact('products'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $image = $request->file('image');
        
        $imageName = $image->getClientOriginalName();

        $image->move(public_path('images'), $imageName);

        $data['image'] = $imageName;

        $seasons = $data['season'];
        unset($data['season']);

        $product = Product::create($data);

        $product->seasons()->attach($seasons);
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $seasons = Season::all();
        $product->load('seasons');
        return view('products.edit', compact('product', 'seasons'));
    }


}
