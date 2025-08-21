<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'route',
        'icon',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItems::class, 'menu_id', 'id');
    }

}
