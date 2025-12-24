<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120|unique:categories,name',
        ]);

        Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('ok', 'Category created');
    }

    // 🔥 QUICK ADD FROM PRODUCT PAGE
    public function quickStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120|unique:categories,name',
        ]);

        Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);

        return back()->with('ok', 'Category added. Now select it.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('ok', 'Category updated');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('ok', 'Cannot delete category with products');
        }

        $category->delete();
        return back()->with('ok', 'Category deleted');
    }
}
