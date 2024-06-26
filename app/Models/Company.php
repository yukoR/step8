<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Company extends Model
{
    use Sortable;
    protected $table = "companies";
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name'
    ];
    use HasFactory;

    public function products() {
        return $this->hasMany(Product::class);
    }
}
