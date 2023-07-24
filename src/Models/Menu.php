<?php

namespace CmXperts\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_menus');
    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')
            ->with('children')
            ->where('parent_id', 0)
            ->orderBy('ordering', 'ASC');
    }
    public function itemAndChilds()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')
            ->with('children')
            ->orderBy('ordering', 'ASC');
    }
}
