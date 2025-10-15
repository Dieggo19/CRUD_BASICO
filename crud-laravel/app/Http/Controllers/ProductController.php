<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // Listar todos
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    // Crear
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|integer',
        ]);

        $product = Product::create($validated);

        return new ProductResource($product);
    }

    // Ver uno
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    // Actualizar
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'price' => 'sometimes|integer',
        ]);

        $product->update($validated);

        return new ProductResource($product);
    }

    // Eliminar
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}

