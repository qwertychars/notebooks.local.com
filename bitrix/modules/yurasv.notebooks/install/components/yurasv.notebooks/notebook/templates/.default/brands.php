<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$APPLICATION->IncludeComponent(
    "yurasv.notebooks:brand.list",
    "",
    array(
        "BRAND_ID" => $arResult["VARIABLES"]["BRAND"],
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
    ),
    $component
);
?>