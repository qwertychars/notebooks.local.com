<?php
namespace Yurasv\Notebooks;

use Bitrix\Main\Entity,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Type;

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

class NotebookTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'yurasv_notebook';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array('primary' => true, 'autocomplete' => true)),
            new Entity\StringField('NAME', array('required' => true)),
            new Entity\DatetimeField('DATE_CREATE', array('required' => true, 'default_value' => new Type\Date)),
            new Entity\IntegerField('MODEL_ID', array('required' => true)),
            new Entity\ReferenceField('MODEL',
                'Yurasv\Notebooks\ModelTable',
                array('=this.MODEL_ID' => 'ref.ID')
            ),
        );
    }
}