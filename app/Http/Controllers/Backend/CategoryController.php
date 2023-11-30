<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    public function AllCategory()
    {

        $category = Category::latest()->get();
        return view('admin.backend.category.all_category',compact('category'));
    }// End Method

    public function AddCategory(){
        return view('admin.backend.category.add_category');
    }// End Method

    public function StoreCategory(Request $request){

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(370,246)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        Category::insert([
        'category_name' => $request->category_name,
        'category_slug' =>strtolower(str_replace(' ', '-', $request->category_name)),
        'image' => $save_url,
        ]);

        $notification = array(
          'message' => 'Category Added Successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('all.category')->with($notification);

    }// End Method

    public function EditCategory($id){
        $category = Category::find($id);
        return view('admin.backend.category.edit_category',compact('category'));
    }// End Method

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;

        if ($request->file('image')){

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(370,246)->save('upload/category/'.$name_gen);
            $save_url = 'upload/category/'.$name_gen;

            Category::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' =>strtolower(str_replace(' ', '-', $request->category_name)),
            'image' => $save_url,
            ]);

            $notification = array(
              'message' => 'Category Updated with Image Successfully',
                'alert-type' =>'success'
            );

            return redirect()->route('all.category')->with($notification);
        }

        else{

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' =>strtolower(str_replace(' ', '-', $request->category_name)),

                ]);

                $notification = array(
                  'message' => 'Category Updated without Image Successfully',
                    'alert-type' =>'success'
                );

                return redirect()->route('all.category')->with($notification);

        } // end else

    }// End Method

}
