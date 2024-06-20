<?php

namespace CmXperts\Menu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CmXperts\Menu\Events\CreatedMenuEvent;
use CmXperts\Menu\Events\DestroyMenuEvent;
use CmXperts\Menu\Events\UpdatedMenuEvent;
use CmXperts\Menu\Models\Menu;
use CmXperts\Menu\Models\MenuItem;

class MenuController extends Controller
{
    public function create(Request $request)
    {
        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->class = $request->input('class', null);
        $menu->save();

        event(new CreatedMenuEvent($menu));

        return response()->json([
            'resp' => $menu->id
        ], 200);
    }

    public function destroy(Request $request)
    {
        $menudelete = Menu::findOrFail($request->input('id'));
        $menudelete->delete();

        event(new DestroyMenuEvent($menudelete));

        return response()->json([
            'resp' => 'You delete this item'
        ], 200);
    }

    public function generateMenuControl(Request $request)
    {
        $menu = Menu::findOrFail($request->input('idMenu'));
        $menu->name = $request->input('menuName');
        $menu->class = $request->input('class', null);
        $menu->save();
        if (is_array($request->input('data'))) {
            foreach ($request->input('data') as $key => $value) {
                $menuitem = MenuItem::findOrFail($value['id']);
                $menuitem->parent_id = $value['parent_id'] ?? 0;
                $menuitem->ordering = $key;
                $menuitem->depth = $value['depth'] ?? 1;
                if (config('menu.use_roles')) {
                    $menuitem->role_id = $request->input('role_id');
                }
                $menuitem->save();
            }
        }
        return response()->json([
            'resp' => 1
        ], 200);
    }

    public function createItem(Request $request)
    {
        if ($request->has('data')) {
            foreach ($request->post('data') as $key => $value) {
                $menuitem = new MenuItem();
                $menuitem->type = $value['type'];
                $menuitem->label = $value['label'];
                if (isset($value['url']))
                    $menuitem->link = $value['url'];
                if (isset($value['icon']))
                    $menuitem->icon = $value['icon'];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = $value['role'] ?? 0;
                }
                $menuitem->menu_id = $value['id'];
                $menuitem->ordering = MenuItem::getNextSortRoot($value['id']);
                $menuitem->save();
            }
        }

        return response()->json([
            'resp' => 1
        ], 200);
    }

    public function updateItem(Request $request)
    {
        $dataItem = $request->input('dataItem');
        if (is_array($dataItem)) {
            foreach ($dataItem as $value) {
                $menuitem = MenuItem::findOrFail($value['id']);
                $menuitem->label = $value['label'];
                if (isset($value['url']))
                    $menuitem->link = $value['url'];
                $menuitem->class = $value['class'];
                if (isset($value['icon']))
                    $menuitem->icon = $value['icon'];
                $menuitem->target = $value['target'];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = $value['role_id'] ? $value['role_id'] : 0;
                }
                $menuitem->save();
            }
        } else {
            $menuitem = MenuItem::findOrFail($request->input('id'));
            $menuitem->label = $request->input('label');
            $menuitem->link = $request->input('url');
            $menuitem->class = $request->input('clases');
            $menuitem->icon = $request->input('icon');
            $menuitem->target = $request->input('target');
            if (config('menu.use_roles')) {
                $menuitem->role_id = $request->input('role_id') ? $request->input('role_id') : 0;
            }
            $menuitem->save();
        }

        event(new UpdatedMenuEvent($dataItem));

        return response()->json([
            'resp' => 1
        ], 200);
    }

    public function destroyItem(Request $request)
    {
        $menuitem = MenuItem::findOrFail($request->input('id'));
        $menuitem->delete();

        return response()->json([
            'resp' => 1
        ], 200);
    }
}
