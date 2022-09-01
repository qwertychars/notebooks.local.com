<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$APPLICATION->IncludeComponent(
    "yurasv.notebooks:notebook.list",
    "",
    array(
        "MODEL_ID" => $arResult["VARIABLES"]["MODEL"],
        "SEF_FOLDER" => $arParams["SEF_FOLDER"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
    ),
    $component
);
?>