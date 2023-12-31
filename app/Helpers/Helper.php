<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Chitietdonhang;
use App\Models\Donhang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id){
                $html .= '
                    <tr>
                        <td>'. $menu->id . '</td>
                        <td>'. $char. $menu->name . '</td>
                        <td>'. self::active($menu->active) . '</td>
                        <td>'. $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" 
                                onclick="removeRow(' . $menu->id .',\'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char .'--');
            }
        }
        return $html;
    }

    public static function active($active = 0) : string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>' 
            : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function ncc_trangthai($ncc_trangthai = 0) : string
    {
        return $ncc_trangthai == 0 ? '<span class="btn btn-danger btn-xs">NO</span>' 
            : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function menus($menus, $parent_id = 0) :string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            ' . $menu->name . ' 
                        </a>';
                    
                unset($menus[$key]); //Xoa nhung cai lay ra roi -> nhe mang

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as  $menu){
            if($menu->parent_id == $id ){
                return true;
            }
        }
        return false;
    }


    //BRAND
    public static function brands($brands) :string
    {
        $html = '';
        foreach ($brands as $key => $brand) {
           
                $html .= '
                    <li>
                        <a href="/thuong-hieu/' . $brand->id . '-' . Str::slug($brand->ten, '-') . '.html">
                            ' . $brand->ten . ' 
                        </a>';
                    
                unset($brands[$key]); //Xoa nhung cai lay ra roi -> nhe mang

              
                    $html .= '<ul class="sub-menu">';
                    $html .= self::brands($brands, $brand->id);
                    $html .= '</ul>';
               

                $html .= '</li>';
           
        }

        return $html;
    }

  


    public static function gia($gia = 0)
    {
        // $chitietdonhang = Chitietdonhang::where('donhang_id', $donhang->id)->get();
        if ($gia != 0)  return number_format($gia);
        return '<a href="/lien-he.html">Liên Hệ</a>';
    }

   
}