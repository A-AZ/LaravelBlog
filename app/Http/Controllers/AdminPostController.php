<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['posts' => $post]);
    }

    public function update(Post $post)
    {
        $attribute = $this->validatePost($post);

        if ($attribute['thumbnail'] ?? false) {
            $attribute['thumbnail'] = request()->file('thumbnail')->store('thumbnail');
        }

        $post->update($attribute);
        return back()->with('success', 'The Post Has Been Updated!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }

    public function store()
    {
        $attribute = $this->validatePost(new Post());
        $attribute['user_id'] = auth()->id();
        $attribute['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attribute);

        return redirect('/');
    }

    public function create(Post $post)
    {
        return view('admin.posts.create');
    }

    public function destory(Post $post)
    {
        $post->delete();

        return back()->with('success', 'The Post Has Been Deleted!');

    }
}
