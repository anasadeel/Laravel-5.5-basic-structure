<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Validator,
    Input;
use Auth;
use App\Categories;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class CategoriesController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * All Cafe's For Admin.
     */
    public function index() {


        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
        $model = Categories::orderBy('sortOrder', 'asc')->get();

        //$categories = Functions::getCategories($allCategories);
        return view('admin.categories.index', compact('model'));
    }

    public function show() {

        $id = $_GET['node'];
        $model = Categories::where('parent_id', '=', $id)->get();
        // d($model,1);
        return view('admin.categories.children', compact('model', 'id'));
    }

    public function create() {
        $categories = Categories::lists('name', 'id');
        $categories[0] = 'Root Category';
        return view('admin.categories.create', compact('categories'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:categories',
                    'image' => 'mimes:jpeg,bmp,png,gif',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $model = new Categories;

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/categories/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';

            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999) . time() . '.' . $extension;
            $image = $destinationPath . '/' . $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            $upload = Image::make($image)->resize(150, 150)->save($destinationPathThumb . $fileName);
            $model->image = $fileName;
        }

        $model->name = $request->name;
        $model->teaser = $request->teaser;
        $model->description = $request->description;
        $model->url = $request->url;
        $model->parent_id = $request->parent_id;
        $model->sortOrder = $request->sortOrder;
        $model->class = $request->class;
        $model->save();
        \Session::flash('success', 'Category Added Successfully!');
        return redirect('admin/categories?id=' . $request->parent_id);
    }

    public function edit($id) {
        //$model = Categories::where('id', '=', $id);
        $category = Categories::findOrFail($id);
        $categories = Categories::lists('name', 'id');
        $categories[0] = 'Root Category';
        return view('admin.categories.edit', compact('category', 'categories'))->with('id', $id);
    }

    public function update($id, Request $request) {
        $id = $request->id;
        $category = Categories::findOrFail($id);
        $input = $request->all();
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/categories/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';

            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999) . time() . '.' . $extension;
            $image = $destinationPath . '/' . $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            $upload = Image::make($image)->resize(150, 150)->save($destinationPathThumb . $fileName);
            $input['image'] = $fileName;
        }
        unset($input['_token']);
        $affectedRows = Categories::where('id', '=', $id)->update($input);
        \Session::flash('message', 'Updated Successfully!');
        return redirect('admin/categories?id=' . $request->parent_id);
    }

    public function delete($id) {
        $row = Categories::where('id', '=', $id)->delete();
        return redirect('admin/categories');
    }

    public function create_sub_cat() {
        if (Auth::user()->role->role == 'admin') {
            $categories = Categories::lists('name', 'id');
            return view('admin.categories.create_sub_cat', compact('categories'));
        } else {
            return redirect('home');
        }
    }

    public function store_sub_cat(Request $request) {
        $validator = Validator::make($request->all(), [
                    'parent_id' => 'required',
                    'name' => 'required|max:255',
                    //'url' => 'required',
                    /// 'description' => 'required', |unique:categories
                    'image' => 'mimes:jpeg,bmp,png,gif',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $model = new Categories;

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/categories/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';

            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999) . time() . '.' . $extension;
            $image = $destinationPath . '/' . $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            $upload = Image::make($image)->resize(150, 150)->save($destinationPathThumb . $fileName);
            $model->image = $fileName;
        }

        $model->parent_id = $request->parent_id;
        $model->name = $request->name;
        $model->teaser = $request->teaser;
        $model->description = $request->description;
        $model->url = $request->url;

        $model->save();
        \Session::flash('success', 'Category Added Successfully!');
        return redirect('admin/categories');
    }

}