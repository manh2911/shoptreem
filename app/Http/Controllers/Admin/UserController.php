<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all();
        $currentUserLogged = Auth::user();

        return view('Admin.user.index', compact('users', 'currentUserLogged'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.user.add');
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
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:re_password',
            're_password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if($validation->passes()) {
            $user_logged = Auth::user();
            if ($user_logged->role == \App\User::ROLE_MANAGEMENT && $request->role == \App\User::ROLE_ADMIN) {
                return redirect()->back()->withInput($request->input())->with('error_message', 'Permission denied!');
            }
            $user = new \App\User();
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if (isset($request->image)) {
                $imageName = time() . '.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/image_user'), $imageName);
                $user->image = 'upload/image_user' . $imageName;
            } else {
                $user->image = \App\User::DEFAULT_AVATAR;
            }
            $user->save();

            return redirect()->route('admin.user.index')->with('flash_message', 'Success!');
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
        $user = \App\User::findOrFail($id);
        $user_logged = Auth::user();
        if ($user_logged->role == \App\User::ROLE_ADMIN || ($user_logged->role == \App\User::ROLE_MANAGEMENT && ($user_logged->id == $id || $user->role == \App\User::ROLE_CLIENT))) {
            return view('Admin.user.show',compact('user'));
        } else {
            return redirect()->route('admin.user.index')->with('error_message', 'Permission denied!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrFail($id);
        $user_logged = Auth::user();
        if ($user_logged->role == \App\User::ROLE_ADMIN || ($user_logged->role == \App\User::ROLE_MANAGEMENT && ($user_logged->id == $id || $user->role == \App\User::ROLE_CLIENT))) {
            return view('Admin.user.edit',compact('user'));
        } else {
            return redirect()->route('admin.user.index')->with('error_message', 'Permission denied!');
        }
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
            'role' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if($validation->passes()) {
            $user_logged = Auth::user();
            if ($user_logged->role == \App\User::ROLE_MANAGEMENT && $request->role == \App\User::ROLE_ADMIN) {
                return redirect()->back()->withInput($request->input())->with('error_message', 'Permission denied!');
            }
            $user = \App\User::findOrFail($id);
            $image = $user->image;

            if (isset($request->image)) {
                $imageName = time() . '.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/image_user'), $imageName);
                $image = 'upload/image_user/' . $imageName;
            }

            $user->update([
                'name' => $request->name,
                'role' => $request->role,
                'image' => $image,
            ]);

            return redirect()->route('admin.user.index')->with('flash_message', 'Success!');
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
        $user_logged = Auth::user();
        $this->deleteItem($id, $errors, $user_logged);

        if (count($errors) > 0) {
            return redirect()->route('admin.user.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.user.index')->with('flash_message', 'Success!');
        }
    }

    public function changePassword(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'new_password' => 'required|same:re_new_password',
            're_new_password' => 'required',
        ]);
        if($validation->passes()) {
            $user = \App\User::findOrFail($id);
            $password = Hash::make($request->new_password);
            $user->update([
                'password' => $password
            ]);

            return redirect()->route('admin.user.show', $id)->with('flash_message', 'Success!');
        } else {
            return redirect()->back()->withInput($request->input())->withErrors($validation->errors());
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
                return redirect()->route('admin.category.index');
        }

        if (count($errors) > 0) {
            return redirect()->route('admin.user.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.user.index')->with('flash_message', 'Success!');
        }
    }

    public function deleteItem($id, &$errors, $user_logged)
    {
        $user = \App\User::find($id);
        if ($user) {
            $role = $user->role;
            switch ($user_logged->role) {
                case \App\User::ROLE_MANAGEMENT:
                    if ($role == \App\User::ROLE_CLIENT) {
                        $user->delete();
                    } else {
                        $errors[] = 'Permission denied';
                    }
                    break;
                default:
                    if ($user_logged->role == $user->role) {
                        $errors[] = 'Permission denied';
                    } else {
                        $user->delete();
                    }
            }
        } else {
            $errors[] = 'Not Found';
        }
    }

    public function actionDelete($arr_chks, &$errors)
    {
        DB::beginTransaction();
        try {
            $user_logged = Auth::user();

            foreach ($arr_chks as $id) {
                $this->deleteItem($id, $errors, $user_logged);
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
}
