<?php
/**
* 2007-2017 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2017 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

require_once('vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

if (!defined('_PS_VERSION_')) {
    exit;
}

class SoapSapConnect extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'soapSapConnect';
        $this->tab = 'administration';
        $this->version = '0.0.1';
        $this->author = 'Cristian Gonzalez V';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Soap Sap Connect');
        $this->description = $this->l('Modulo de prueba para conectarse a sap');

        $this->confirmUninstall = $this->l('Esta seguro de desinstalar el modulo ?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.7');
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayNav') &&
            $this->registerHook('actionPaymentConfirmation') &&
            $this->registerHook('actionValidateOrder') &&
            $this->registerHook('actionOrderStatusUpdate');
    }

    public function uninstall()
    {
        //Configuration::deleteByName('SOAPSAPCONNECT_LIVE_MODE');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitSoapSapConnectModule')) == true) {

        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output;
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayNav()
    {
        //xdebug_break();
        // create a log channel
        $log = new Logger('SoapSapConnect');
        $log->pushHandler(new StreamHandler($this->local_path.'/logs/info.log', Logger::DEBUG));

        // add records to the log
        $log->warning('Foo');
        $log->error('Bar');
        $log->info('My logger is now ready');

        $this->context->smarty->assign([
            'testVar1' => 'variable de prueba'
        ]);

        $fileV = __FILE__;

        return $this->display(__FILE__, 'displayHeaderContent.tpl');

        //Configuration::get('myVariable'); // : retrieves a specific value from the database.
        //Configuration::getMultiple(array('myFirstVariable', 'mySecondVariable', 'myThirdVariable')); // : retrieves several values from the database, and returns a PHP array.
        //Configuration::updateValue('myVariable', $value); // : updates an existing database variable with a new value. If the variable does not yet exist, it creates it with that value.
        //Configuration::deleteByName('myVariable'); // : deletes the database variable.
    }

    public function hookActionPaymentConfirmation($params) {
        xdebug_break();
        return $params;
    }

    public function hookActionOrderStatusUpdate($params) {
        // Este brinco
        xdebug_break();
        return $params;
    }

     public function hookActionValidateOrder($params) {
        // Este brinco
        xdebug_break();
        return $params;
    }


}
