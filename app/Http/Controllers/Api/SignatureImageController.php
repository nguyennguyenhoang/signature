<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\signtature_image;
use Auth;
use Validator;

class SignatureImageController extends Controller
{
    public function getSignatureRegisted(Request $request)
    {   
        $validator = Validator::make($request->all(), [
        'user_id' => 'required|numeric|exists:users,id',
        ]);

        if ($validator->fails()) {
           return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $listImages = signtature_image::where('user_id', $request->user_id)->get();

        return response()->json([
                'success' => true,
                'data' => $listImages,
            ], Response::HTTP_OK);
    }

    public function getAllSignature(Request $request)
    {   

        $listImages = signtature_image::all();
        return response()->json([
                'success' => true,
                'data' => $listImages,
            ], Response::HTTP_OK);
    }
}
