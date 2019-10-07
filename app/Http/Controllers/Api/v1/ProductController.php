<?php

namespace App\Http\Controllers\Api\v1;

use App\Category;
use App\Http\Requests\StoreProduct;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::with('categories')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $validated = $request->validated();

        $product = (new Product())->createWithRelations($validated, $validated['category_id']);

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduct  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {
        $validated = $request->validated();

        $product->updateWithRelations($validated, $validated['category_id']);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return ['status' => 1];
    }

    /**
     * Получение всех товаров из заданной категории.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function categoryProducts(Category $category)
    {
        return ProductResource::collection(
            Product::whereHas('categories', function ($query) use ($category) {
                $query->where('category_id', '=', $category->id);
            })->get()
        );
    }
}
