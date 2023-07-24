<?php

namespace CmXperts\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes;

    protected $table = 'menu_items';

    protected $fillable = [
        'type',
        'menu_id',
        'parent_id',
        'label',
        'description',
        'link',
        'alias',
        'ordering',
        'conditions',
        'is_active',
        'class',
        'depth',
        'role_id',
        'icon',
        'target'
    ];

    protected $casts = [
        'active_class' => 'array'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_items');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function getsons($id)
    {
        return $this->where('parent_id', $id)->get();
    }
    public function getall($id)
    {
        return $this->where('menu_id', $id)->orderBy('ordering', 'asc')->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu_id', $menu)->max('ordering') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('ordering', 'ASC');
    }

    public function grand_children()
    {
        return $this->children()->with('children');
    }
}
