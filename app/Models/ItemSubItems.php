<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSubItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item_sub_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'menu_item_id',
        'name',
        'route',
    ];

    public function menuItem():BelongsTo
    {
        return $this->belongsTo(MenuItems::class, 'menu_item_id', 'id');
    }

}
