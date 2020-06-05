<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin()
 * @method static static Warehouse() 
 */
final class UserType extends Enum
{
    const Superadmin =   1;
    const Admin =   2;    
    const Warehouse =   3;    
    const Carrior =   4;

    public static function toOptions($selected = ""): string
    {
        $html = '';
        $data = static::toArray();

		$option_txt = array(   
					'Superadmin' => '上段管理者', 
				    'Admin' => '管理者', 
				    'Warehouse' => '倉庫', 
				    'Carrior' => '配達会社'
				);        

        foreach($data as $key => $value) {
            $html .= '<option value="';
            $html .= $value;
            $html .= '"';
            if ($value == $selected) {
                $html .= ' selected="selected"';
            }
            $html .= '>';
            $html .= $option_txt[$key];
            $html .= '</option>';
        }

        return $html;
    }
}
