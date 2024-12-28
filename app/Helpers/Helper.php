<?php
    namespace App\Helpers;
    use illuminate\Support\Str;
    class Helper{
        public static function menu($menus, $parent_id = 0, $char =''){
            $html = '';
            
            foreach($menus as $key => $menu){
                if($menu->parent_id == $parent_id){
                    $html .= '
                        <tr>
                                <td style="text-align: center">'.$menu->id.'  </td>
                                <td class="pname">
                                    <div class="name">
                                        <a href="#" class="body-title-2">'. $char .$menu->name.'</a>
                                    </div>
                                </td>
                                <td style="text-align:center;">'.self::active($menu->active).'</td>
                                <td>'.$menu->description.'</td>
                                <td>'.$menu->updated_at.'</td>
                                <td>
                                    <div class="list-icon-function">
                                        <a href="/admin/category/edit/'.$menu->id.'">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                        </a>
                                        <a href="#" 
                                        onclick="removeRow('.$menu->id.', \'/admin/category/destroy\')">
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    ';
                    unset($menus[$key]);
                    $html .= self::menu($menus, $menu->id, $char .'|---');
                }
            }
            return $html;
        } 


        public static function active($active = 0): string{
            return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>' : '<span class="btn btn-success btn-xs">YES</span>';
        }

        public static function price($price = 0,$priceSale = 0){
            if($priceSale != 0){
                return number_format($priceSale);
            }
            if($price != 0) return number_format($price);
            return '<a href="/lien-he.html">Liên hệ</a>';

        }
        
    }
    
