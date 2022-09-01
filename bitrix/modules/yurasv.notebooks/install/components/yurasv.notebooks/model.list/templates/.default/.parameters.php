<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 * @var array $arCurrentValues
 * @var array $arTemplateParameters
 */

use Bitrix\Main\Loader;

if (!Loader::includeModule('yurasv.notebooks'))
	return;

$boolCatalog = Loader::includeModule('catalog');
