<?IncludeModuleLangFile(__FILE__);?>
<form action="<?echo $APPLICATION->GetCurPage()?>" name="form1">
<?=bitrix_sessid_post()?>
<input type="hidden" name="lang" value="<?echo LANG?>">
<input type="hidden" name="id" value="yurasv.notebooks">
<input type="hidden" name="install" value="Y">
<input type="hidden" name="step" value="2">
<p>
    <input type="checkbox" name="drop_tables" id="drop_tables" value="Y">
    <label for="drop_tables">Удалить старые данные модуля</label>
</p>
<input type="submit" name="inst" value="<?echo GetMessage("MOD_INSTALL")?>">
</form>