<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Repositories\ProductRepository;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function index(Request $request)
    {
        if ($request->has('formdata')) {
            return $this->formdata();
        } else {
            $input = $request->only([
                'search',
                'perPage',
                'page',
                'sortby',
                'category'
            ]);
            $validator = Validator::make($input, [
                'search' => 'max:50',
                'perPage' => 'required|integer',
                'page' => 'required|integer',
                'sortby' => ['nullable', 'string', Rule::in(['price_desc', 'price_asc', 'rating_asc', 'rating_desc'])],
                'category' => [
                    'nullable',
                    'string',
                    Rule::in(config('constants.CATEGORIES')),
                ]
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag(),
                ], 400);
            }
            return $this->productRepository->getAll($input);
        }
    }

    private function formdata()
    {
        try {
            $currencyList = Currency::select('id', 'name', 'code', 'symbol')->where('is_active', true)->get();
            return response()->json([
                'success' => true,
                'data' => [
                    'currency' => $currencyList,
                    'categories' => config('constants.CATEGORIES')
                ],
                'message' => 'Operation successful'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $input = $request->only('name', 'category', 'price', 'rating', 'image', 'currency_id');
            $validator = Validator::make($input, [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products')->whereNull('deleted_at'),
                ],
                'category' => [
                    'required',
                    'string',
                    Rule::in(config('constants.CATEGORIES')),
                ],
                'price' => 'required|numeric|min:0',
                'rating' => 'required|numeric|min:0|max:5',
                'image' => 'required|string',
                'currency_id' => 'required|exists:currencies,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag(),
                ], 400);
            }
            $file = null;
            if ($input['image']) {
                $file = $this->fileUpload($input['image'], false);
            }
            $currency = Currency::select(
                'name',
                'code',
                'symbol',
            )->where('is_active', true)->find($input['currency_id']);
            $input['currency'] = $currency;
            $input['image'] = $file['path'];
            $input['created_by'] = Auth::user()->id;
            $this->productRepository->create($input);
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = $this->productRepository->find($id);
            if (empty($product)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], status: 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Product retrieve successfully',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->only('name', 'category', 'price', 'rating', 'image', 'currency_id');
            $product = $this->productRepository->find($id);
            if (empty($product)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], status: 404);
            }
            $validator = Validator::make($input, [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'name')->whereNull('deleted_at')->ignore($id),
                ],
                'category' => [
                    'required',
                    'string',
                    Rule::in(config('constants.CATEGORIES')),
                ],
                'price' => 'required|numeric|min:0',
                'rating' => 'required|numeric|min:0|max:5',
                'image' => 'nullable|string',
                'currency_id' => 'required|exists:currencies,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag(),
                ], 400);
            }
            $file = null;
            $needToDelete = null;
            if ($input['image']) {
                $file = $this->fileUpload($input['image'], false);
                $input['image'] = $file['path'];
                $needToDelete = $product->image;
            } else {
                unset($input['image']);
            }
            $currency = Currency::select(
                'name',
                'code',
                'symbol',
            )->where('is_active', true)->find($input['currency_id']);
            $input['currency'] = $currency;
            $input['updated_by'] = Auth::user()->id;
            $product->update($input);
            if ($needToDelete) {
                $this->deleteFile($needToDelete);
            }
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = $this->productRepository->find($id);
            if (empty($product)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], status: 404);
            }
            $product->deleted_by = Auth::user()->id;
            $product->update();
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
