<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }



   public function index()
   {
       $data =DB::table('categories')->get();
       return view('admin.category.category.index',compact('data'));
    }

    // store category
    
   public function store(Request $request)
   {    
    $validated = $request->validate([
    'category_name' => 'required|unique:categories|max:55',
   
       ]);

       //quiery builder
    //    $data=array();
    //    $data['category_name']=$request->category_name;
    //    $data['category_slug']=Str::slug($request->category_name, '-');
    //   DB::table('categories')->insert($data);
     Category::insert([
        'category_name'=> $request->category_name,
        'category_slug'=> Str::slug($request->category_name,'-'),
     ]);


      $notification=array('messege' => 'Category Inserted!','alert-type' => 'success');
      return redirect()->back()->with($notification);

    }
  public function destroy($id)
  {
//   DB::table('categories')->where('id', $id)->delete();
$category = Category::find($id);
$category->delete();
  $notification=array('messege' => 'Category Deleted!','alert-type' => 'error');
      return redirect()->back()->with($notification);
  }


  public function edit($id)
  {
      // method 1
      // $data = DB::table('categories')->where('id', $id)->first();
      // method 2
      $data = Category::FindOrFail($id);
      return response()->json($data);
  }

  public function update(Request $request)
  {
       // method 1 Query builder update
      //  $id = $request->id;
      // $data=array();
      // $data['category_name']=$request->category_name;
      // $data['category_slug'] =Str::slug($request->category_name,'-');
      // DB::table('categories')->where('id', $id)->update($data);
      // method 2 Eloquent orm 
      $category = Category::where('id',$request->id)->first();
      $category->update([
         'category_name'=> $request->category_name,
         'category_slug'=> Str::slug($request->category_name, '-')
        
      ]);
      $notification=array('messege' => 'Category Updated!','alert-type' => 'success');
      return redirect()->back()->with($notification);
  }




//  endline   
}
