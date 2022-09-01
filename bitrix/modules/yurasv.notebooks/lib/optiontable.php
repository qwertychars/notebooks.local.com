<?php
namespace Yurasv\Notebooks;

use Bitrix\Main\Entity,
    Bitrix\Main\Type,
    Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class StatTable
 *
 * Fields:
 * <ul>
 * <li> COUNT int mandatory
 * <li> TIME datetime optional
 * </ul>
 *
 * @package Bitrix\Data
 **/

class OptionTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'yurasv_option';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array('primary' => true, 'autocomplete' => true)),
            new Entity\StringField('NAME', array('required' => true)),
            new Entity\StringField('VALUE', array('required' => true)),
            new Entity\DatetimeField('DATE_CREATE', array('required' => true, 'default_value' => new Type\Date)),
        );
    }
}