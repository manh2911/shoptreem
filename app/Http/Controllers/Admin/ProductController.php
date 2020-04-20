<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use App\ImageDetailProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return view('Admin.product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::where('parent_id', '=', 0)->orderBy('parent_id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();

        return view('Admin.product.add',compact('parents','brands'));
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
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'brand_id' => 'required',
            'origin_price' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        if($validation->passes()) {
            $user = Auth::user();
            $product = new Product();
            $product->name = $request->name;
            $product->slug = changeTitle($request->name);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->status = $request->status;
            $product->user_id = $user->id;
            $product->origin_price = $request->origin_price;
            $product->quantity = isset($request->quantity) ? $request->quantity : 0;
            $product->discount = isset($request->discount) ? $request->discount : 0;
            $product->description = isset($request->description) ? $request->description : '';
            $product->code = '';

            $product->save();
            $product->update(['code' => 'STE-' . $product->id]);
            if (isset($request->image)) {
                foreach ($request->image as $key => $image) {
                    $imageDetailProduct = new ImageDetailProduct();
                    $imageName = 'imageProduct'. $key . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('upload/image_product'), $imageName);
                    $imageDetailProduct->image = 'upload/image_product/' . $imageName;
                    $imageDetailProduct->product_id = $product->id;
                    $imageDetailProduct->save();
                }
            }

            return redirect()->route('admin.product.index')->with('flash_message', 'Success!');
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
        $product = Product::findOrFail($id);
        $parents = Category::where('parent_id', '=', 0)->orderBy('parent_id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();

        return view('Admin.product.edit', compact('parents','brands', 'product'));
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
            'name' => 'required|unique:products,name,'.$id,
            'category_id' => 'required',
            'brand_id' => 'required',
            'origin_price' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        if($validation->passes()) {
            $user = Auth::user();
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'slug' => changeTitle($request->name),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'status' => $request->status,
                'user_id' => $user->id,
                'origin_price' => $request->origin_price,
                'quantity' => isset($request->quantity) ? $request->quantity : 0,
                'discount' => isset($request->discount) ? $request->discount : 0,
                'description' => isset($request->description) ? $request->description : '',
            ]);

            if (isset($request->image)) {
                $srcNewImages = explode(',', $request->srcImages);
                $listOldImages = ImageDetailProduct::select('id', 'image')->where('product_id', $id)->get()->toArray();
                $srcOldImages = [];
                foreach ($listOldImages as $listOldImage) {
                    $srcOldImages[$listOldImage['id']] = $listOldImage['image'];
                }
                $idImagesNotEdit = [];
                foreach ($srcOldImages as $key => $srcOldImage) {
                    foreach ($srcNewImages as $srcNewImage) {
                        if ($srcOldImage == $srcNewImage) {
                            $idImagesNotEdit[] = $key;
                        }
                    }
                }

                $listIdImages = ImageDetailProduct::select('id')->where('product_id', $id)->get()->toArray();
                DB::table('image_detail_products')->whereIn('id', $listIdImages)->whereNotIn('id', $idImagesNotEdit)->delete();

                foreach ($request->image as $key => $image) {
                    $imageDetailProduct = new ImageDetailProduct();
                    $imageName = 'imageProduct' . $key . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('upload/image_product'), $imageName);
                    $imageDetailProduct->image = 'upload/image_product/' . $imageName;
                    $imageDetailProduct->product_id = $product->id;
                    $imageDetailProduct->save();
                }
            }

            return redirect()->route('admin.product.index')->with('flash_message', 'Success!');
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
            return redirect()->route('admin.product.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.product.index')->with('flash_message', 'Success!');
        }
    }

    public function active($id)
    {
        $errors = [];
        $this->activeItem($id, $errors);

        if (count($errors) > 0) {
            return redirect()->route('admin.product.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.product.index')->with('flash_message', 'Success!');
        }
    }

    public function inactive($id)
    {
        $errors = [];
        $this->inactiveItem($id, $errors);

        if (count($errors) > 0) {
            return redirect()->route('admin.product.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.product.index')->with('flash_message', 'Success!');
        }
    }

    public function action(Request $request)
    {
        $errors = [];
        $arr_chk = explode(",", $request->arr_chk);
        rsort($arr_chk);
        switch ($request->action) {
            case ServiceAction::ACTION_DELETE:
                $this->executeAction($arr_chk, $errors, ServiceAction::ACTION_DELETE);
                break;
            case ServiceAction::ACTION_ACTIVE:
                $this->executeAction($arr_chk, $errors, ServiceAction::ACTION_ACTIVE);
                break;
            case ServiceAction::ACTION_INACTIVE:
                $this->executeAction($arr_chk, $errors, ServiceAction::ACTION_INACTIVE);
                break;
            default:
                return redirect()->route('admin.product.index');
        }

        if (count($errors) > 0) {
            return redirect()->route('admin.product.index')->withErrors($errors);
        } else {
            return redirect()->route('admin.product.index')->with('flash_message', 'Success!');
        }
    }

    public function executeAction($arr_chks, &$errors, $action)
    {
        DB::beginTransaction();
        try {
            foreach ($arr_chks as $id) {
                switch ($action) {
                    case ServiceAction::ACTION_DELETE:
                        $this->deleteItem($id, $errors);
                        break;
                    case ServiceAction::ACTION_ACTIVE:
                        $this->activeItem($id, $errors);
                        break;
                    case ServiceAction::ACTION_INACTIVE:
                        $this->inactiveItem($id, $errors);
                        break;
                    default:
                        return redirect()->route('admin.product.index');
                }

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
        $product = Product::find($id);
        $product->delete();
    }

    public function activeItem($id, &$errors)
    {
        $product = Product::find($id);
        if (!$product) {
            $errors[] = 'Can not find product STE-' . $id;
        } else {
            $product->update(['status' => ServiceAction::STATUS_ACTIVE]);
        }
    }

    public function inactiveItem($id, &$errors)
    {
        $product = Product::find($id);
        if (!$product) {
            $errors[] = 'Can not find product STE-' . $id;
        } else {
            $product->update(['status' => ServiceAction::STATUS_INACTIVE]);
        }
    }
}
