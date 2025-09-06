<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'product_type' => 'required|in:car,car part',
            'brand' => 'required|string|max:225',
            'model' => 'required|string|max:225',
            'production_year' => 'required|integer|min:1000|'.'max:'.date('Y'),
            'status' => 'required|in:available,sold',
            'state' => 'required|in:brand new,fairly used',
            'price(FCFA)' => 'required|string|255',
        ]);
        $product = Product::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    // View a single course
    public function show($id)
    {
        $product = Product::with('vendor')->find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    // Update course details
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        $data = $request->validate([
            'product_type' => 'sometimes|in:car,car part',
            'brand' => 'sometimes|string|max:225',
            'model' => 'sometimes|string|max:225',
            'production_year' => 'sometimes|integer|min:1000|'.'max:'.date('Y'),
            'status' => 'sometimes|in:available,sold',
            'state' => 'sometimes|in:brand new,fairly used',
            'price(FCFA)' => 'sometimes|string|255'
        ]);

        $product->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    // Delete a course
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ]);
    }   
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ],200);
    }
}