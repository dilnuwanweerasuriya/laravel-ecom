<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttributes extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'variant_id',
        'attribute_value_id',
    ];

    public function variants()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
