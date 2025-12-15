<?php

namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, FileUploadTrait;
    protected $fillable = [
        'name',
        'category',
        'price',
        'rating',
        'image',
        'currency_id',
        'currency',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'currency' => 'array'
    ];

    public function getImageAttribute()
    {
        try {
            if (!isset($this->attributes['image'])) {
                return null;
            }
            // Make sure you have a signed route 'temporary.file'
            return $this->generateTemplink($this->attributes['image']);
        } catch (\Exception $e) {
            return null;
        }
    }

}
