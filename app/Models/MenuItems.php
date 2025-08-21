<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menu_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'menu_id',
        'name',
        'route',
    ];

    public function menu():BelongsTo
    {
        return $this->belongsTo(Menus::class, 'menu_id', 'id');
    }

    public function itemSubItems():HasMany
    {
        return $this->hasMany(ItemSubItems::class, 'menu_item_id', 'id');
    }

}
