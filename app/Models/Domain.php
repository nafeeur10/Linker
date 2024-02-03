<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'domains';

    public function urls()
    {
        return $this->hasMany(Url::class);
    }
}
