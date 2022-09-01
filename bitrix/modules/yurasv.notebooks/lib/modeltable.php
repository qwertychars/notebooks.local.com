<?php
namespace Yurasv\Notebooks;

use Bitrix\Main\ORM\Fields,
    Bitrix\Main\Entity,
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

class ModelTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'yurasv_model';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array('primary' => true, 'autocomplete' => true)),
            new Entity\StringField('NAME', array('required' => true)),
            new Entity\DatetimeField('DATE_CREATE', array('required' => true, 'default_value' => new Type\Date)),
            new Entity\IntegerField('MANUFACTURER_ID', array('required' => true)),
            new Entity\ReferenceField(
                'MANUFACTURER',
                'Yurasv\Notebooks\ManufacturerTable',
                array('=this.MANUFACTURER_ID' => 'ref.ID')
            ),
        );
    }
}