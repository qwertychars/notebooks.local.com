<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

if(isset($arResult['ITEMS']) && !empty($arResult['ITEMS']))
{
    echo '<ul>';
}

// TODO проверить arparams
foreach($arResult['ITEMS'] as $arItem)
{
    echo '<li><a href="/test_catalog/detail/'.$arItem['ID'].'/">'.$arItem['NAME'].'</a></li>';
}

if(isset($arResult['ITEMS']) && !empty($arResult['ITEMS']))
{
    echo '</ul>';
}
