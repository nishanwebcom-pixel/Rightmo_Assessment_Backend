<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function __construct()
    {
        //
    }

    public function create($data)
    {
        Product::create($data);
    }

    public function getAll($filter)
    {
        return Product::select(
            'id',
            'name',
            'category',
            'price',
            'rating',
            'image',
            'currency'
        )->when(isset($filter['search']) && !empty($filter['search']), function ($q) use ($filter) {
            $q->where('name', 'like', '%' . $filter['search'] . '%');
        })->when(isset($filter['category']) && !empty($filter['category']), function ($q) use ($filter) {
            $q->where('category', $filter['category']);
        })->when(isset($filter['sortby']) && !empty($filter['sortby']), function ($q) use ($filter) {
            $q->when($filter['sortby'] == 'price_desc', function ($q) {
                $q->orderBy('price', 'desc');
            });
            $q->when($filter['sortby'] == 'price_asc', function ($q) {
                $q->orderBy('price', 'asc');
            });
            $q->when($filter['sortby'] == 'rating_asc', function ($q) {
                $q->orderBy('rating', 'asc');
            });
            $q->when($filter['sortby'] == 'rating_desc', function ($q) {
                $q->orderBy('rating', 'desc');
            });

        })->when(!isset($filter['sortby']), function ($q) use ($filter) {
            $q->orderBy('id', 'DESC');
        })->paginate($filter['perPage']);
    }

    public function isActiveAndExists($id): bool
    {
        return Product::where('is_active', 1)->where('id', $id)->exists();
    }

    public function find($id)
    {
        return Product::select(
            'id',
            'name',
            'category',
            'price',
            'rating',
            'image',
            'currency_id',
            'currency'
        )->find($id);
    }
}
