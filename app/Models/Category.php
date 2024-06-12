<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;

    protected $fillable = ['name', 'parent_id'];

    protected $table = 'categories';

    /**
     * Get the parent category of the current category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories of the current category.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
