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


if(isset($arResult) && !empty($arResult))
{
    echo '<h2>'.$arResult['NAME'].'</h2>';

    if(isset($arResult['OPTION_LIST']) && !empty($arResult['OPTION_LIST']))
    {
        echo '<ul>';
        foreach($arResult['OPTION_LIST'] as $arOption)
        {
            echo '<li>'.$arOption['NAME'].': '.$arOption['VALUE'].'</li>';
        }
        echo '</ul>';

    }
}