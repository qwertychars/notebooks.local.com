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

class ModelOptionTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'yurasv_model_option';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array('primary' => true, 'autocomplete' => true)),
            new Entity\StringField('MODEL_ID', array('required' => true)),
            new Entity\StringField('OPTION_ID', array('required' => true)),
            new Entity\ReferenceField('MODEL',
                'Yurasv\Notebooks\ModelTable',
                array('=this.MODEL_ID' => 'ref.ID')
            ),
            new Entity\ReferenceField('OPTION',
                'Yurasv\Notebooks\OptionTable',
                array('=this.OPTION_ID' => 'ref.ID')
            ),
        );
    }
}