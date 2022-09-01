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

class NotebookOptionTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'yurasv_notebook_option';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array('primary' => true, 'autocomplete' => true)),
            new Entity\StringField('NOTEBOOK_ID', array('required' => true)),
            new Entity\StringField('OPTION_ID', array('required' => true)),
            new Entity\ReferenceField('NOTEBOOK',
                'Yurasv\Notebooks\NotebookTable',
                array('=this.NOTEBOOK_ID' => 'ref.ID')
            ),
            new Entity\ReferenceField('OPTION',
                'Yurasv\Notebooks\OptionTable',
                array('=this.OPTION_ID' => 'ref.ID')
            ),
        );
    }
}