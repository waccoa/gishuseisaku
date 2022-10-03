<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PublishStateType extends Enum
{
    const Zaikoari =   1;
    const Zaikonasi =   2;
    const Renntarutyuu = 3;

     /**
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value){
            case self::Zaikoari:
                return '在庫あり';
                break;
            case self::Zaikonasi:
                return '在庫なし';
                break;
            case self::Renntarutyuu:
                return 'レンタル中';
                break;
            default:
                return self::getKey($value);
        }
    }
}

