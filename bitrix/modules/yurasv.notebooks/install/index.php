<?
use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ModuleManager,
	Bitrix\Main\Loader,
	Bitrix\Main\Application,
	Bitrix\Main\Entity\Base;

IncludeModuleLangFile(__FILE__);
Class yurasv_notebooks extends CModule
{
	const MODULE_ID = 'yurasv.notebooks';
	var $MODULE_ID = 'yurasv.notebooks'; 
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("yurasv.notebooks_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("yurasv.notebooks_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("yurasv.notebooks_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("yurasv.notebooks_PARTNER_URI");
	}

	function InstallDB($dropTables)
	{
		Loader::IncludeModule(self::MODULE_ID);
		if($dropTables)
		{
			if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ManufacturerTable')->getDBTableName()))
			{
				Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\ManufacturerTable')->getDBTableName());
			}

			if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ModelTable')->getDBTableName()))
			{
				Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\ModelTable')->getDBTableName());
			}

			if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\NotebookTable')->getDBTableName()))
			{
				Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\NotebookTable')->getDBTableName());
			}

			if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\OptionTable')->getDBTableName()))
			{
				Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\OptionTable')->getDBTableName());
			}

			if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\NotebookOptionTable')->getDBTableName()))
			{
				Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\NotebookOptionTable')->getDBTableName());
			}

			if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ModelOptionTable')->getDBTableName()))
			{
				Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\ModelOptionTable')->getDBTableName());
			}
		}

		if(!Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ManufacturerTable')->getDBTableName()))
		{
			Base::getInstance('\Yurasv\Notebooks\ManufacturerTable')->createDBTable();
		}

		if(!Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ModelTable')->getDBTableName()))
		{
			Base::getInstance('\Yurasv\Notebooks\ModelTable')->createDBTable();
		}

		if(!Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\NotebookTable')->getDBTableName()))
		{
			Base::getInstance('\Yurasv\Notebooks\NotebookTable')->createDBTable();
		}

		if(!Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\OptionTable')->getDBTableName()))
		{
			Base::getInstance('\Yurasv\Notebooks\OptionTable')->createDBTable();
		}

		if(!Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\NotebookOptionTable')->getDBTableName()))
		{
			Base::getInstance('\Yurasv\Notebooks\NotebookOptionTable')->createDBTable();
		}

		if(!Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ModelOptionTable')->getDBTableName()))
		{
			Base::getInstance('\Yurasv\Notebooks\ModelOptionTable')->createDBTable();
		}

		$this -> InstallDemoData();
		return true;
	}

	function InstallDemoData()
	{
		$demoManufacturerElementList = array(
			array('NAME' => 'Тестовый производитель 1'),
			array('NAME' => 'Тестовый производитель 2'),
			array('NAME' => 'Тестовый производитель 3'),
		);

		$dbManufacturerElementIDList = [];
		foreach($demoManufacturerElementList as $arDemoElement)
		{
			$result = Yurasv\Notebooks\ManufacturerTable::add($arDemoElement);
			if($result->isSuccess())
			{
				$dbManufacturerElementIDList[] = $result -> getID();
			}
		}

		$demoModelElementList = array(
			array('NAME' => 'Тестовая модель 1', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[0]),
			array('NAME' => 'Тестовая модель 2', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[0]),
			array('NAME' => 'Тестовая модель 3', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[0]),
			array('NAME' => 'Тестовая модель 4', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[1]),
			array('NAME' => 'Тестовая модель 5', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[1]),
			array('NAME' => 'Тестовая модель 6', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[1]),
			array('NAME' => 'Тестовая модель 7', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[2]),
			array('NAME' => 'Тестовая модель 8', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[2]),
			array('NAME' => 'Тестовая модель 9', 'MANUFACTURER_ID' => $dbManufacturerElementIDList[2]),
		);

		$dbModelElementIDList = array();
		foreach($demoModelElementList as $arDemoElement)
		{
			$result = Yurasv\Notebooks\ModelTable::add($arDemoElement);
			if($result->isSuccess())
			{
				$dbModelElementIDList[] = $result -> getID();
			}
		}

		$demoNotebookElementList = array(
			array('NAME' => 'Тестовый ноутбук 1', 'MODEL_ID' => $dbModelElementIDList[0]),
			array('NAME' => 'Тестовая ноутбук 2', 'MODEL_ID' => $dbModelElementIDList[1]),
			array('NAME' => 'Тестовая ноутбук 3', 'MODEL_ID' => $dbModelElementIDList[2]),
			array('NAME' => 'Тестовая ноутбук 4', 'MODEL_ID' => $dbModelElementIDList[3]),
			array('NAME' => 'Тестовая ноутбук 5', 'MODEL_ID' => $dbModelElementIDList[4]),
			array('NAME' => 'Тестовая ноутбук 6', 'MODEL_ID' => $dbModelElementIDList[5]),
			array('NAME' => 'Тестовая ноутбук 7', 'MODEL_ID' => $dbModelElementIDList[6]),
			array('NAME' => 'Тестовая ноутбук 8', 'MODEL_ID' => $dbModelElementIDList[7]),
			array('NAME' => 'Тестовая ноутбук 9', 'MODEL_ID' => $dbModelElementIDList[8]),
		);

		$dbNotebookElementIDList = array();
		foreach($demoNotebookElementList as $arDemoElement)
		{
			$result = Yurasv\Notebooks\NotebookTable::add($arDemoElement);
			if($result->isSuccess())
			{
				$dbNotebookElementIDList[] = $result -> getID();
			}
		}

		$demoNotebookOptionElementList = array(
			array('NAME' => 'Оция 1', 'VALUE' => 'test1'),
			array('NAME' => 'Оция 2', 'VALUE' => 'test2'),
			array('NAME' => 'Оция 3', 'VALUE' => 'test3'),
			array('NAME' => 'Оция 4', 'VALUE' => 'test4'),
			array('NAME' => 'Оция 5', 'VALUE' => 'test5'),
			array('NAME' => 'Оция 6', 'VALUE' => 'test6'),
			array('NAME' => 'Оция 7', 'VALUE' => 'test7'),
			array('NAME' => 'Оция 8', 'VALUE' => 'test8'),
			array('NAME' => 'Оция 9', 'VALUE' => 'test9'),
			array('NAME' => 'Оция 10', 'VALUE' => 'test10'),
			array('NAME' => 'Оция 11', 'VALUE' => 'test11'),
			array('NAME' => 'Оция 12', 'VALUE' => 'test12'),
			array('NAME' => 'Оция 13', 'VALUE' => 'test14'),
			array('NAME' => 'Оция 14', 'VALUE' => 'test15'),
			array('NAME' => 'Оция 15', 'VALUE' => 'test16'),
			array('NAME' => 'Оция 16', 'VALUE' => 'test17'),
			array('NAME' => 'Оция 17', 'VALUE' => 'test18'),
			array('NAME' => 'Оция 18', 'VALUE' => 'test19'),
			array('NAME' => 'Оция 19', 'VALUE' => 'test20'),
			array('NAME' => 'Оция 20', 'VALUE' => 'test21'),
			array('NAME' => 'Оция 22', 'VALUE' => 'test23'),
			array('NAME' => 'Оция 23', 'VALUE' => 'test24'),
			array('NAME' => 'Оция 24', 'VALUE' => 'test23'),
			array('NAME' => 'Оция 25', 'VALUE' => 'test24'),
			array('NAME' => 'Оция 26', 'VALUE' => 'test25'),
			array('NAME' => 'Оция 27', 'VALUE' => 'test26'),
			array('NAME' => 'Оция 28', 'VALUE' => 'test27'),
			array('NAME' => 'Оция 29', 'VALUE' => 'test28'),
			array('NAME' => 'Оция 30', 'VALUE' => 'test29'),
			array('NAME' => 'Оция 31', 'VALUE' => 'test33'),
			array('NAME' => 'Оция 32', 'VALUE' => 'test34'),
			array('NAME' => 'Оция 33', 'VALUE' => 'test44'),
			array('NAME' => 'Оция 212', 'VALUE' => 'test54'),
			array('NAME' => 'Оция 211', 'VALUE' => 'test123'),
			array('NAME' => 'Оция 212', 'VALUE' => 'test22'),
			array('NAME' => 'Оция 213', 'VALUE' => 'test223'),
			array('NAME' => 'Оция 214', 'VALUE' => 'test224'),
			array('NAME' => 'Оция 215', 'VALUE' => 'test225'),
			array('NAME' => 'Оция 216', 'VALUE' => 'test226'),
			array('NAME' => 'Оция 217', 'VALUE' => 'test227'),
			array('NAME' => 'Оция 218', 'VALUE' => 'test228'),
			array('NAME' => 'Оция 219', 'VALUE' => 'test229'),
		);

		$dbOptionElementIDList = array();
		foreach($demoNotebookOptionElementList as $arDemoElement)
		{
			$result = Yurasv\Notebooks\OptionTable::add($arDemoElement);
			if($result->isSuccess())
			{
				$dbOptionElementIDList[] = $result -> getID();
			}
		}

		foreach($dbNotebookElementIDList as $arDBNotebookElementID)
		{
			Yurasv\Notebooks\NotebookOptionTable::add(array('NOTEBOOK_ID' => $arDBNotebookElementID, 'OPTION_ID' => array_shift($dbOptionElementIDList)));
			Yurasv\Notebooks\NotebookOptionTable::add(array('NOTEBOOK_ID' => $arDBNotebookElementID, 'OPTION_ID' => array_shift($dbOptionElementIDList)));
		}

		foreach($dbModelElementIDList as $arDBModelEementID)
		{
			Yurasv\Notebooks\ModelOptionTable::add(array('MODEL_ID' => $arDBModelEementID, 'OPTION_ID' => array_shift($dbOptionElementIDList)));
			Yurasv\Notebooks\ModelOptionTable::add(array('MODEL_ID' => $arDBModelEementID, 'OPTION_ID' => array_shift($dbOptionElementIDList)));
		}

		return true;
	}

	function UnInstallDB()
	{
		Loader::IncludeModule(self::MODULE_ID);
		if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ManufacturerTable')->getDBTableName()))
		{
			Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\ManufacturerTable')->getDBTableName());
		}

		if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ModelTable')->getDBTableName()))
		{
			Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\ModelTable')->getDBTableName());
		}

		if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\NotebookTable')->getDBTableName()))
		{
			Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\NotebookTable')->getDBTableName());
		}

		if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\OptionTable')->getDBTableName()))
		{
			Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\OptionTable')->getDBTableName());
		}

		if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\NotebookOptionTable')->getDBTableName()))
		{
			Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\NotebookOptionTable')->getDBTableName());
		}

		if(Application::getConnection()->isTableExists(Base::getInstance('\Yurasv\Notebooks\ModelOptionTable')->getDBTableName()))
		{
			Application::getConnection()->dropTable(Base::getInstance('\Yurasv\Notebooks\ModelOptionTable')->getDBTableName());
		}

		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles($arParams = array())
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item,
					'<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function UnInstallFiles()
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function DoInstall()
	{
		global $APPLICATION, $step, $drop_tables;
		$step = intval($step);
		$dropTables = !empty($drop_tables) && trim($drop_tables);
		if($step<2)
		{
			$APPLICATION->IncludeAdminFile(Loc::getMessage("yurasv.notebooks_STEP1_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/yurasv.notebooks/install/step1.php");
		}
		elseif($step==2)
		{
			ModuleManager::registerModule(self::MODULE_ID);
			if($this->InstallDB($dropTables))
			{
				$this->InstallFiles();
			}
			$APPLICATION->IncludeAdminFile(Loc::getMessage("yurasv.notebooks_STEP2_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/step2.php");
		}
	}

	function DoUninstall()
	{
		global $APPLICATION, $step;
		$step = intval($step);
		if($step<2)
		{
			$APPLICATION->IncludeAdminFile(GetMessage("BLOG_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/unstep1.php");
		}
		elseif($step==2)
		{
			$context = \Bitrix\Main\Application::getInstance()->getContext();
			$request = $context->getRequest();
			if(!$request->get('savedata'))
			{
				$this->UnInstallDB();
			}

			UnRegisterModule(self::MODULE_ID);

			$APPLICATION->IncludeAdminFile(GetMessage("BLOG_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/unstep2.php");
		}
	}
}
?>
