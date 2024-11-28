<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name',
                            'description',
                        ];  // adaugă doar atributele care sunt permise pentru masiv assignment
  
    public function products()
{
    return $this->hasMany(Product::class);
}

}
