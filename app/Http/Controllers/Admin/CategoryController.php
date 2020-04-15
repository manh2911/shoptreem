<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();

        return view('Admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::select('id','name','parent_id')->get()->toArray();

        return view('Admin.category.add', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'parent_id' => 'required',
            'name' => 'required',
        ]);
        if($validation->passes()) {
            if ($request->parent_id == 0) {
                $validation = Validator::make($request->all(), [
                    'imageIcon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    'imageSlide' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                if (!$validation->passes()){

                    return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
                }
            }

            $category = new Category();
            $category->parent_id = $request->parent_id;
            $category->name = $request->name;
            $category->slug = changeTitle($request->name);

            if (isset($request->imageIcon) && isset($request->imageSlide) && $request->parent_id == 0) {
                $imageIconName = 'imageIcon' . time() . '.' . request()->imageIcon->getClientOriginalExtension();
                $imageSlideName = 'imageSlide' . time() . '.' . request()->imageSlide->getClientOriginalExtension();
                request()->imageIcon->move(public_path('upload/image_category'), $imageIconName);
                request()->imageSlide->move(public_path('upload/image_category'), $imageSlideName);
                $category->imageIcon = 'upload/image_category/' . $imageIconName;
                $category->imageSlide = 'upload/image_category/' . $imageSlideName;
            } else {
                $category->imageIcon = '';
                $category->imageSlide = '';
            }
            $category->save();

            return redirect()->route('admin.category.index')->with('flash_message', 'Success!');
        } else {
            return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::select('id','name','parent_id')->get()->toArray();

        return view('Admin.category.edit', compact('parents', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'parent_id' => 'required',
            'name' => 'required',
        ]);
        if($validation->passes()) {
            if ($request->parent_id == 0) {
                $validation = Validator::make($request->all(), [
                    'imageIcon' => 'image|mimes:jpeg,png,jpg,gif,svg',
                    'imageSlide' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                if (!$validation->passes()){
                    return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
                }
            }

            $category = Category::findOrFail($id);
            $imageIcon = $category->imageIcon;
            $imageSlide = $category->imageSlide;

            if (isset($request->imageIcon) && isset($request->imageSlide) && $request->parent_id == 0) {
                $imageIconName = 'imageIcon' . time() . '.' . request()->imageIcon->getClientOriginalExtension();
                $imageSlideName = 'imageSlide' . time() . '.' . request()->imageSlide->getClientOriginalExtension();
                request()->imageIcon->move(public_path('upload/image_category'), $imageIconName);
                request()->imageSlide->move(public_path('upload/image_category'), $imageSlideName);
                $imageIcon = 'upload/image_category/' . $imageIconName;
                $imageSlide = 'upload/image_category/' . $imageSlideName;
            }

            $category->update([
                'name' => $request->name,
                'slug' => changeTitle($request->name),
                'parent_id' => $request->parent_id,
                'imageIcon' => $imageIcon,
                'imageSlide' => $imageSlide,
            ]);

            return redirect()->route('admin.category.index')->with('flash_message', 'Success!');
        } else {
            return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $errors = [];
        $this->deleteItem($id, $errors);

        if (count($errors) > 0) {
            return redirect()->route('admin.category.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.category.index')->with('flash_message', 'Success!');
        }
    }

    public function action(Request $request)
    {
        $errors = [];
        $arr_chk = explode(",", $request->arr_chk);
        rsort($arr_chk);
        switch ($request->action) {
            case ServiceAction::ACTION_DELETE:
                $this->actionDelete($arr_chk, $errors);
                break;
            default:
                return redirect()->route('admin.category.index');
        }

        if (count($errors) > 0) {
            return redirect()->route('admin.category.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.category.index')->with('flash_message', 'Success!');
        }
    }

    public function actionDelete($arr_chks, &$errors)
    {
        DB::beginTransaction();
        try {

            foreach ($arr_chks as $id) {
                $this->deleteItem($id, $errors);
                if (count($errors) > 0) {
                    DB::rollBack();

                    return $errors;
                }
            }

            DB::commit();

            return $errors;
        } catch (\Exception $e) {
            DB::rollBack();
            $errors = $e->getMessage();

            return $errors;
        }
    }

    public function deleteItem($id, &$errors)
    {
        $categories = Category::where('parent_id', $id)->get()->toArray();
        if (count($categories) > 0) {
            $errors[] = 'This category has subcategories';
        } else {
            $category = Category::find($id);
            $category->delete();
        }
    }
}
