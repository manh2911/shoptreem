<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::orderBy('id', 'desc')->get();

        return view('Admin.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.color.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'color_code' => 'required',
            'name' => 'required|unique:colors',
        ]);
        if ($validation->passes()) {
            $color = new Color();
            $color->name = $request->name;
            $color->color_code = $request->color_code;
            $color->save();

            return redirect()->route('admin.color.index')->with('flash_message', 'Success!');
        } else {
            return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::findOrFail($id);

        return view('Admin.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'color_code' => 'required',
            'name' => 'required|unique:colors',
        ]);
        if ($validation->passes()) {
            $color = Color::findOrFail($id);
            $color->update([
                'name' => $request->name,
                'color_code' => $request->color_code,
            ]);

            return redirect()->route('admin.color.index')->with('flash_message', 'Success!');
        } else {
            return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $errors = [];
        $this->deleteItem($id, $errors);

        if (count($errors) > 0) {
            return redirect()->route('admin.color.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.color.index')->with('flash_message', 'Success!');
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
                return redirect()->route('admin.color.index');
        }

        if (count($errors) > 0) {
            return redirect()->route('admin.color.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.color.index')->with('flash_message', 'Success!');
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
        $color = Color::find($id);
        $color->delete();
    }
}
