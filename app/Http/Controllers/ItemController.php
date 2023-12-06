<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function itemList()
    {
        $items =Item::paginate(9);
        return view('Item.itemList' , compact('items'));
    }

    public function newItem()
    {
        $data = Category::all();
        return view('Item.newItem' , compact('data'));
    }

    public function editItem($id)
    {
        $items =Item::find($id);
        $data = Category::all();
        return view('Item.editItem' ,compact(['items' ,'data']));
    }
    //
    //
    public function addItem(Request $request)
    {
       $this->itemValidation($request,'create');
       $data = $this->itemData($request);
       $fileName = uniqid().$request->file('item_photo')->getClientOriginalName();
       $request->file('item_photo')->storeAs('public/img', $fileName);
       $data['item_photo'] = $fileName;
       Item::create($data);

       return redirect()->route('#itemList')->with('Add' , 'Successfully Added .. !');
    }

    // Update Item
    public function updateItem(Request $request)
    {
            // dd($request->all());

        $this->itemValidation($request,'update');

        $data =$this->itemData($request);

        if($request->hasFile('item_photo'))
        {
            $oldImage=Item::where('id',$request->item_id)->first();
            $oldImage =$oldImage->item_photo;
            if($oldImage != null)
            {
                Storage::delete('public/img',$oldImage);
            }
            $fileName = uniqid() . $request->file('item_photo')->getClientOriginalName();
            $request->file('item_photo')->storeAs('public/img',$fileName);
            $data['item_photo'] = $fileName;
            Item::where('id',$request->item_id)->update($data);
            return redirect()->route('#itemList')->with('Update' , 'Successfully Updated .. !');
        }
        else
        {
            Item::where('id',$request->item_id)->update($data);
            return redirect()->route('#itemList')->with('Update' , 'Successfully Updated .. !');
        }
    }

     //delete category
    public function deleteItem($id)
    {
        Item::where('id',$id)->delete();
        return back()->with(['delete' => 'Item Deleted !']);
    }
    private function itemData($request)
    {
        return [
            'item_name' => $request->item_name,
            'category' => $request->category_name,
            'price' => $request->item_price,
            'description' => $request->item_description,
            'status' => $request->item_status,
            'item_condition' => $request->item_condition,
            'item_type' => $request->item_type,
            'owner_name' => $request->owner_name,
            'contact_number' => $request->number,
            'address' => $request->address,
        ];
    }
    private function itemValidation($request,$action)
    {
        $validationRule =[
            'item_name' => 'required',
            'category_name' => 'required',
            'item_price' => 'required|integer',
            'item_description' => 'required',
            'item_status' => 'nullable',
            'item_condition' => 'nullable',
            'item_type' => 'nullable',
            'owner_name' => 'required',
            'number' => 'nullable',
            'address' => 'nullable',
        ];
        $validationRule ['item_photo'] =$action == 'create' ? 'required|mimes:png,jpg,jpeg.webp|file':'mimes:png,jpg,jpeg.webp|file';
        Validator::make($request->all(),$validationRule )->validate();
    }

}
