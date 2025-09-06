<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class ClientController extends Controller
{
    public function update(Request $request, $id = null){
        $data = $request->validate([
            'full_name' => 'required|string|max:225',
            'phone' => 'required|string|max:15',
            'pic_url' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048|unique:vendors,pic_url',
        ]);

        $data['pic_url'] = $request->file('pic_url')->store('uploads'); 
        $completed = !empty($data['full_name']) && !empty($data['phone']);
        $user = Auth::user();

        if ($user->role === 'client') {
            $profile = Client::updateOrCreate(
                ['user_id' => $user->id],
                array_merge($data, ['is_completed' => $completed])
            );
        } elseif ($user->role === 'admin' && $id) {
            $profile = Client::updateOrCreate(
                ['user_id' => $id],
                array_merge($data, ['is_completed' => $completed])
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
            'message' => 'Client profile created successfully',
        ]);
    }
}
