<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    // public function index()
    // {
    //     $query = Image::query();

    //     if (Auth::user()->role == 0) {
    //         $images = $query->latest()->get();
    //     } else {
    //         $images = $query->where('user_id', Auth::id())->latest()->get();
    //     }

    //     return view('home', compact('images'));
    // }



    public function index(Request $request)
    {
        $query = Image::with('user');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // if (Auth::user()->role == 0) {
            $images = $query->latest()->get();

        // } else {
        //     $images = $query->where('user_id', Auth::id())->latest()->get();
        // }

        return view('home', compact('images'));
    }


    public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_type' => 'required'
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        Image::create([
            'user_id' => Auth::id(),
            'image_path' => $imagePath,
            'button_type' => $request->button_type,
        ]);

        return redirect()->route('home')->with('success', 'Image uploaded successfully.');
    }
}

