<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;

class VendorController extends Controller
{
        
    public function update(Request $request, $id = null){
        // Validate file
        $data = $request->validate([
            'full_name'=>'required|string|max:255',
            'about'=>'required|string|max:500',
            'phone'=>'required|string|max:255|unique:vendors,phone',
            'doc_url' => 'required|file|mimes:jpg,png,pdf,docx|max:2048|unique:vendors,doc_url',
            'experience' => 'required|integer',
            'pic_url' => 'required|file|mimes:jpg,png,pdf,docx|max:2048|unique:vendors,pic_url',
        ]);
        $data['doc_url'] = $request->file('doc_url')->store('uploads');
        $data['pic_url'] = $request->file('pic_url')->store('uploads');
        $completed = !empty($data['full_name']) && !empty($data['phone']);

        $user = Auth::user();
        if ($user->role === 'vendor') {
            $profile = Vendor::updateOrCreate(
                ['user_id' => $user->id],  array_merge($data, ['is_completed' => $completed])
            );
        } elseif ($user->role === 'admin' && $id) {
            $profile = Vendor::updateOrCreate(
                ['user_id' => $user->id],  array_merge($data, ['is_completed' => $completed])
            );
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to update this profile',
            ], 403);
        }

        $profile->refresh();

        return response()->json([
            'status' => 'success',
            'message' => 'Vendor created updated successfully',
        ]);
    }
    public function destroy($id)
    {
        $profile = Vendor::where('user_id', $id)->first();

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vendor profile not found',
            ], 404);
        }

        $profile->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vendor profile deleted successfully',
        ]);
    }
}

