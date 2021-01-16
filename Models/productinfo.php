<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productinfo extends Model
{
    use HasFactory;
    protected $table="productinfo";
    protected $fillable=
                        ['productCode',
                        'productName',
                        'productPrice',
                        'productSideEfects',
                        'productdescription',
                        'productNoOfSearch',
                        'manufacturer',
                        'category_name'];
    public $timestamps=false;
   
  
}
