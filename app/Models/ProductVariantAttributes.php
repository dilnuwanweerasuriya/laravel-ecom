<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttributes extends Model
{
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'attribute_name',
        'attribute_value',
    ];

    public function variants()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_name', 'name');
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value', 'value');
    }
}
