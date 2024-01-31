<?php

namespace App\Http\Controllers;

use App\Exports\CategoriesExport;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Http\Request;

// use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class CategoryController extends Controller
{
    public function index()
    {

        if (request('keyword')) {
            $categories = Category::latest()->where('title', 'LIKE','%'.request('keyword').'%')->paginate(10);
            // dd($categories );
        }else{
            $categories = Category::latest()->paginate(10);
        }
        
        // dd($categories);
        return view('backend.category.index', ['categories'=>$categories]);
    }
    public function create()
    {
        $this->authorize('create-category');
        return view('backend.category.create');
    }
    public function store(CategoryRequest $request)
    {
        try {
            // $request->validate([
            //     'title'=> ['required', 'min:5', 'max:10', Rule::unique('categories', 'title')],
            //     'description'=> ['required', 'min:5', 'max:100'],
            // ]);
           Category::create([
               'title'=>$request->title,
               'description'=>$request->description,
            //    'image'=>$request->image
           ]);
             return redirect()->route('categories.list')->withMessage("Category Successfully Created!");
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            // dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
        }
    }



    public function show(Category $category)
    {
    //    $category = Category::findOrFail($id);
    //    dd( $category );
        return view('backend.category.show', ['category'=>$category]);
    }



    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            // $request->validate([
            //     'title'=> ['required', 'min:5', 'max:10', Rule::unique('categories', 'title')->ignore($category->id)],
            //     'description'=> ['required', 'min:5', 'max:100'],
            // ]);
            $category->update([
               'title'=>$request->title,
               'description'=>$request->description,
            //    'image'=>$request->image
           ]);
             return redirect()->route('categories.list')->withMessage("Category Successfully Updated!");
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            // dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
        }

    }
public function destroy(Category $category)
{
    try {
        $category->delete();
         return redirect()->route('categories.list')->withMessage("Category Successfully Deleted!");
    } catch (QueryException $e) {
        \Log::error($e->getMessage());
        // dd($th->getMessage());
        return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
    }

}


// For PDF Method
public function categoryPdf()
{

  try {
    $categories = Category::all();
    $fileName = 'categories.pdf';
    $html = view('backend.category.pdf', compact('categories'))->render();
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output($fileName, 'I');
  } catch (\Throwable $th) {
      dd($th->getMessage());
  }
}

// For Export Method

public function export() 
{
    return Excel::download(new CategoriesExport, 'categories.xlsx');
}




}
