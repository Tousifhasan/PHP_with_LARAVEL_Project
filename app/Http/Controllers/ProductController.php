<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // dd( $categories);
        return view('backend.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
     //validation


        try{

            // $request->validate([
            //     'name'=> ['required'],
            //     'description'=> ['required'],
            //     'category'=> ['required'],
            //     'price'=> ['required'],
            //     'image'=> ['required','mimes:jpg,png,jpeg','max:1000'],
            // ]);
           
            // $ext = $request->file('image')->getClientOriginalExtension();
            // $fileName = time().'.'.$ext;
            // $request->file('image')->storeAs('public/products', $fileName);
        
        Product::create([

            'name'=>$request->name,
            'category_id'=>$request->category,
            'description'=>$request->description,
            'price'=>$request->price,
            // 'image'=>$fileName,
            'image'=>$this->uploadImage(request()->file('image'))
        ]);
        return redirect()->route('products.list')->withMessage("Product Successfully Created!");
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            // dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
        
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        // dd($categories);
        return view('backend.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {

        // $request->validate([
        //     'name'=> ['required'],
        //     'description'=> ['required'],
        //     'category'=> ['required'],
        //     'price'=> ['required'],
        //     'image'=> ['mimes:jpg,png,jpeg','max:1000'],
        // ]);
       
        try{

            $requestData = [
                'name'=>$request->name,
                'category_id'=>$request->category,
                'description'=>$request->description,
                'price'=>$request->price,
            ];
            if ($request->hasFile('image')) {
                $requestData['image'] =$this->uploadImage(request()->file('image'));
            }

            $product->update($requestData);
        return redirect()->route('products.list')->withMessage("Product Successfully Updated!");
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            // dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
        
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
             return redirect()->route('products.list')->withMessage("Product Successfully Deleted!");
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            // dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
        }
    }



    public function uploadImage($file)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();

        Image::make($file)->resize(300, 200)->save(storage_path().'/app/public/products/'.$fileName);

        return $fileName;
    }


    public function trash()
    {
       $trashData = Product::onlyTrashed()->get();
        return view('backend.product.trash', compact('trashData'));
    }

    public function restore($id)
    {
       $restore = Product::onlyTrashed()->findOrFail($id);
       $restore->restore();
       return redirect()->route('products.trashed')->withMessage("Product Successfully Restored!");

    }
    public function delete($id)
    {
        try {
            $delete = Product::onlyTrashed()->findOrFail($id);
            $delete->forceDelete();
             return redirect()->route('products.trashed')->withMessage("Product Successfully Permanently Deleted!");
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            // dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went Wrong contact with Developer!');
        }
    }
}
