<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ToolType extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name'];

    protected $fillable = ['name'];


    // relation between ToolType && deliveryMan
    public function deliveryMan()
    {
        return $this->hasMany(DeliveryMan::class,'toolType_id');
    }


} //end of class
