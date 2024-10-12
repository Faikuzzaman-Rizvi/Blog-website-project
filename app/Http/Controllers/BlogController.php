<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(2);
        return view('dashboard.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
       return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $request->validated([
            "category_id" => 'required',
            "title" => 'required',
            "thumnail" => 'required',
            "short_description" => 'required|max:400',
            "description" => 'required',


        ]);

        if($request->hasFile('thumbnail')){
            $manager = new ImageManager(new Driver());
            $newname = Auth::user()->id.'-'.Str::random(4) .".".$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/'.$newname));

            if($request->slug){
                Blog::create([
                    'user_id' => Auth::user()->id,
                    "category_id" => $request->category_id,
                    "title" => $request->title,
                    "slug" => Str::slug($request->slug,'-'),
                    "thumnail" => $newname,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "created_at" => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Insart Successfull');
            }else{
                Blog::create([
                    'user_id' => Auth::user()->id,
                    "category_id" => $request->category_id,
                    "title" => $request->title,
                    "slug" => Str::slug($request->slug,'-'),
                    "thumnail" => $newname,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "created_at" => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Insart Successfull');
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $request->validated([
            "category_id" => 'required',
            "title" => 'required',
            "thumnail" => 'required',
            "short_description" => 'required|max:400',
            "description" => 'required',


        ]);

        if($request->hasFile('thumbnail')){
            $manager = new ImageManager(new Driver());
            $newname = Auth::user()->id.'-'.Str::random(4) .".".$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/'.$newname));
          // Old thumbnail path
        $oldpath = base_path('public/uploads/blog/' . $blog->thumbnail);

        // Check if the old file exists before trying to delete it
        if (file_exists($oldpath) && !empty($blog->thumbnail)) {
            unlink($oldpath);
        }

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    "category_id" => $request->category_id,
                    "title" => $request->title,
                    "slug" => Str::slug($request->slug,'-'),
                    "thumnail" => $newname,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "update_at" => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Update Successfull');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    "category_id" => $request->category_id,
                    "title" => $request->title,
                    "slug" => Str::slug($request->slug,'-'),
                    "thumnail" => $newname,
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "update_at" => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Update Successfull');
            }

        }else{
            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    "category_id" => $request->category_id,
                    "title" => $request->title,
                    "slug" => Str::slug($request->slug,'-'),
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "update_at" => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Update Successfull');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    "category_id" => $request->category_id,
                    "title" => $request->title,
                    "slug" => Str::slug($request->slug,'-'),
                    "short_description" => $request->short_description,
                    "description" => $request->description,
                    "update_at" => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Update Successfull');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->firstOrFail();

        if ($blog->thumbnail) {
            $oldpath = base_path('public/uploads/blog/' . $blog->thumbnail);

            if (file_exists($oldpath)) {
                unlink($oldpath);
            }
        }
        // Delete the blog
        $blog->delete();

        // Redirect back with a success message
        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    }

    // active and deactive
    public function updateStatus(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = $blog->status == 'active' ? 'inactive' : 'active';
        $blog->save();

        return redirect()->back()->with('success', 'Blog status updated successfully!');
    }
}
