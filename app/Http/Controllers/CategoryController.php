<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function categoryList()
    {
        $categoryData = Category::all();
        return view('categoryList' , compact('categoryData'));
    }

    //
    public function newCategory()
    {
        return view('newCategory');
    }

    // Add new category
    public function addCategory(Request $request)
    {
       $this->categoryValidation($request,'create');
       $data = $this->categoryData($request);
       $fileName = uniqid().$request->file('category_photo')->getClientOriginalName();
       $request->file('category_photo')->storeAs('public/img', $fileName);
       $data['category_photo'] = $fileName;
       Category::create($data);

       return redirect()->route('#categoryList')->with('Add' , 'Successfully Updated .. !');
    }

    // Edit category Page
    public function categoryEdit($id)
    {
        $categoryData =Category::find($id);
        return view('editCategory' , compact('categoryData'));
    }

    // Update category
    public function updateCategory(Request $request)
    {
        $this->categoryValidation($request,'update');
        $data =$this->categoryData($request);
        if($request->hasFile('category_photo'))
        {
            $oldImage=Category::where('id',$request->category_id)->first();
            $oldImage =$oldImage->category_photo;

            if($oldImage != null)
            {
                Storage::delete('public/img',$oldImage);
            }
            $fileName = uniqid() . $request->file('category_photo')->getClientOriginalName();
            $request->file('category_photo')->storeAs('public/img',$fileName);
            $data['category_photo'] = $fileName;
            Category::where('id',$request->category_id)->update($data);
            return redirect()->route('#categoryList')->with('Update' , 'Successfully Updated .. !');
        }
        else
        {
            Category::where('id',$request->category_id)->update($data);
            return redirect()->route('#categoryList')->with('Update' , 'Successfully Updated .. !');
        }
    }

    //delete category
    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();
        return back()->with(['delete' => 'Category Deleted !']);
    }

    private function categoryData($request)
    {
        return [
            'category_name' => $request->category_name,
            'status' => $request->category_status,
        ];
    }
    private function categoryValidation($request,$action)
    {
        $validationRule =[
            'category_name' => 'required',
            'status' => 'nullable',
        ];
        $validationRule ['category_photo'] =$action == 'create' ? 'required|mimes:png,jpg,jpeg.webp|file':'mimes:png,jpg,jpeg.webp|file';
        Validator::make($request->all(),$validationRule )->validate();
    }
}
