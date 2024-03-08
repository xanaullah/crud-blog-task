<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');
        $perPage = $request->input('perPage', 10);
    
        $query = Blog::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    
        if ($status !== 'all') {
            // dd($status);
            $query->where('status', $status);
        }
    
        $blogs = $query->paginate($perPage);
    
        return view('welcome', compact('blogs', 'status'));
    }
    

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'status' => 'required|in:1,0',
        ];

        $messages = [
            'status.in' => 'The status must be either 1 or 0.',
        ];

        $request->validate($rules, $messages);

        $blog = Blog::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        return Redirect::back()->with('success', 'Blog entry created successfully');
    }

    public function updateStatus($id, $status)
    {
        $blog = Blog::findOrFail($id);
        $blog->update(['status' => $status]);

        return redirect('/')->with('success', 'Blog status updated successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('update-blog', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->update([
            'name' => $request->input('name'),
            'status' => ($request->input('status') == 'active') ? 1 : 0,
        ]);

        return redirect()->route('home')->with('success', 'Blog updated successfully.');
    }
}

