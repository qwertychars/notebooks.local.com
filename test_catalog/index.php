<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовый каталог");
CModule::IncludeModule('yurasv.notebooks');
?><?$APPLICATION->IncludeComponent(
	"yurasv.notebooks:notebook", 
	".default", 
	array(
		"ELEMENT_COUNT" => "18",
		"SEF_FOLDER" => "/test_catalog/",
		"SORT_FIELD" => "ID",
		"SORT_ORDER" => "ASC",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array(
            "brands" => "",
            "brand" => "#BRAND#/",
            "notebooks" => "#BRAND#/#MODEL#/",
            "notebook" => "detail/#NOTEBOOK#/",
        ),
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>