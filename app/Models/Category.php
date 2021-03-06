<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $table = 'categories';

    public function jobs() {
        $this->hasMany(Job::class,'category_id','id');
    }
}
