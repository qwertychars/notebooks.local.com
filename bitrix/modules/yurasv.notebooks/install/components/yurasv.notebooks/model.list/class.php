<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\Date;
use Yurasv\Notebooks\ManufacturerTable;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CNoteBookComponent extends CBitrixComponent
{
    protected $errors = array();

    public function onIncludeComponentLang()
    {
        Loc::loadMessages(__FILE__);
    }

    public function onPrepareComponentParams($arParams)
    {
        if(!isset($arParams["CACHE_TIME"]))
        {
            $arParams["CACHE_TIME"] = 36000000;
        }

        if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER"]))
        {
            $arParams["SORT_ORDER"]="DESC";
        }

        if(!$arParams["SORT_FIELD"])
        {
            $arParams["SORT_FIELD"] = "ID";
        }

        return $arParams;
    }

    public function executeComponent()
    {
        try
        {
            $this->checkModules();
            $this->getResult();
            $this->includeComponentTemplate();
        }
        catch (SystemException $e)
        {
            ShowError($e->getMessage());
        }
    }

    public function applyTemplateModifications()
    {

    }

    protected function checkModules()
    {
        if (!Loader::includeModule('yurasv.notebooks'))
            throw new SystemException(Loc::getMessage('CPS_MODULE_NOT_INSTALLED', array('#NAME#' => 'yurasv.notebooks')));
    }

    protected function getResult()
    {
        if ($this->errors)
            throw new SystemException(current($this->errors));

        $arParams = $this->arParams;

        $additionalCacheID = false;
        if ($this->startResultCache($arParams['CACHE_TIME'], $additionalCacheID)) {
            //WHERE
            $arFilter = array("MANUFACTURER_ID" => $arParams['BRAND_ID']);
            //ORDER BY
            $arSort = array($arParams["SORT_FIELD"] => $arParams["SORT_ORDER"]);

            $tmpElementList = \Yurasv\Notebooks\ModelTable::GetList([
                'filter' => $arFilter,
                'select' => [
                    '*',
                    'OPTION_NAME' => 'Yurasv\Notebooks\ModelOptionTable:MODEL.OPTION.NAME',
                    'OPTION_VALUE' => 'Yurasv\Notebooks\ModelOptionTable:MODEL.OPTION.VALUE'
                ],
                'order' => $arSort
            ]) -> FetchAll();

            $arResult = array();
            foreach($tmpElementList as $arElement)
            {
                $arElementProps = ['NAME' => $arElement['OPTION_NAME'], 'VALUE' => $arElement['OPTION_VALUE']];
                unset($arElement['OPTION_NAME']);
                unset($arElement['OPTION_VALUE']);
                if(!$arResult["ITEMS"][$arElement['ID']])
                {
                    $arResult["ITEMS"][$arElement['ID']] = $arElement;
                }

                $arResult["ITEMS"][$arElement['ID']]['OPTION_LIST'][] = $arElementProps;
            }

            if (!$arResult["ITEMS"])
            {
                $this->abortResultCache();
            }

            $this->arResult = $arResult;
        }
    }
}