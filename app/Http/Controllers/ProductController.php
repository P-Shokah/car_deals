<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // POST /api/products/create
    public function store(Request $request){
        $data = $request->validate([
            'product_type' => 'required|in:car,car part',
            'brand' => 'required|string|max:225',
            'model' => 'required|string|max:225',
            'production_year' => 'required|integer|min:1000|'.'max:'.date('Y'),
            'status' => 'required|in:available,sold',
            'state' => 'required|in:brand new,fairly used',
            'price(FCFA)' => 'required|string|255',
            'vendor_id' => 'required|exists:vendors,id'
        ]);

        $user = Auth::user();

        if($user->role !== 'vendor' && $user->role !== 'admin'){
            return response()->json([
                'status' => 'error',
                'message' => 'You are not allowed to perform this action register as a Vendor first',
            ]);
        }
        else{
            $product = Product::create($data, );

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        }
    }

    // View a single product by id
    // GET /api/product/{id}
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

    // Update product details
    // PUT api/product/{id}/update
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

        $user = Auth::user();

        if($user->role !== 'vendor' && $user->role !== 'admin'){
            return response()->json([
                'status' => 'error',
                'message' => 'You are not allowed to perform this action register as a Vendor first',
            ]);
        }
        else{
            $product->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'data' => $product
            ], 201);
        }
    }

    // Delete a product
    // DELETE /api/product/{id}/delete
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
        else{
            $user = Auth::user();

            if($user->role !== 'vendor' && $user->role !== 'admin'){
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not allowed to perform this action register as a Vendor first',
                ]);
            }
            else{
                $product->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Product deleted successfully'
                ]);
            }
        }
    }   
    //GET /api/products
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ],200);
    }
}