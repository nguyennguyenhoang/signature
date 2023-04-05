<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\signtature_image;
use Auth;
use Storage;
use Session;
use URL;
use Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listImages = signtature_image::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        return view('welcome', compact('listImages'));
    }

    public function saveImage(Request $request)
    {

        $image = explode('base64,',$request->img_file);
        $image = end($image);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png';

        Storage::disk('public')->put("images/" . $imageName,base64_decode($image));
        $data['url'] = URL::to('/') . "/storage/images/" . $imageName;
        $data['user_id'] = Auth::id();
        $data['host'] = URL::to('/');
        $data['path'] = "/storage/images/";
        signtature_image::create($data);

        Session::flash('alert-success', 'create e-signature successfuly!');
        return redirect()->back();
    }

    public function getSignatureRegisted(Request $request)
    {
        $listImages = [];
        $validator = Validator::make($request->all(), [
        'user_id' => 'required|numeric|exists:users,id',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', $validator->errors()->first());
            return view('signature', compact('listImages'));
        }

        $listImages = signtature_image::where('user_id', $request->user_id)->get();

        return view('signature', compact('listImages'));
    }
}
