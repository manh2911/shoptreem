<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();

        return view('Admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.brand.add');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required',
        ]);
        if($validation->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;

            if (isset($request->image)) {
                $imageName = 'image' . time() . '.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/image_brand'), $imageName);
                $brand->image = 'upload/image_brand/' . $imageName;
            } else {
                $brand->image = '';
            }
            $brand->save();

            return redirect()->route('admin.brand.index')->with('flash_message', 'Success!');
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
        $brand = Brand::findOrFail($id);

        return view('Admin.brand.edit', compact('brand'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required',
        ]);
        if($validation->passes()) {
            $brand = Brand::findOrFail($id);
            $image = $brand->image;

            if (isset($request->image)) {
                $imageName = 'image' . time() . '.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/image_brand'), $imageName);
                $image = 'upload/image_brand/' . $imageName;
                $brand->update(['image' => $image]);
            }

            $brand->update([
                'name' => $request->name,
                'image' => $image,
            ]);

            return redirect()->route('admin.brand.index')->with('flash_message', 'Success!');
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
            return redirect()->route('admin.brand.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.brand.index')->with('flash_message', 'Success!');
        }
    }

    public function action(Request $request)
    {
        $errors = [];
        $arr_chk = explode(",", $request->arr_chk);
        switch ($request->action) {
            case ServiceAction::ACTION_DELETE:
                $this->actionDelete($arr_chk, $errors);
                break;
            default:
                return redirect()->route('admin.brand.index');
        }

        if (count($errors) > 0) {
            return redirect()->route('admin.brand.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.brand.index')->with('flash_message', 'Success!');
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
        $brand = Brand::find($id);
        $brand->delete();
    }
}
