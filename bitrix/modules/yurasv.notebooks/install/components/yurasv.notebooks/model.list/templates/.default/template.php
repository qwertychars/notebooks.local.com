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

foreach($arResult['ITEMS'] as $arItem)
{
    echo '<li>';
    echo '<a href="'.$arItem['ID'].'/">'.$arItem['NAME'].'</a>';
    if(isset($arItem['OPTION_LIST']) && !empty($arItem['OPTION_LIST']))
    {
        echo '<ul>';
        foreach($arItem['OPTION_LIST'] as $arOption)
        {
            echo '<li>'.$arOption['NAME'].': '.$arOption['VALUE'].'</li>';
        }
        echo '</ul>';
    }
    echo '</li>';

}

if(isset($arResult['ITEMS']) && !empty($arResult['ITEMS']))
{
    echo '</ul>';
}
