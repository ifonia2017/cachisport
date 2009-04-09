<?php
/**
 * Kumbia PHP Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://XXXXXXXX
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Kumbia
 * @package    Destroyer
 * @copyright  Copyright (c) 2005-2009 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Destroyer para controllers
 *
 * @category  Kumbia
 * @package   Destroyer
 * @copyright  Copyright (c) 2005-2009 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version   SVN:$id
 */
class ControllerDestroyer implements DestroyerInterface
{
	/**
 	 * Ejecuta el destroyer
     *
	 * @param string $name elemento a destruir
 	 * @param array $params
 	 * @return boolean
     * @throw KumbiaException
 	 */
	public static function execute($name, $params)
    {
		$path = APP_PATH . 'controllers/';
		if(isset($params['module']) && $params['module']) {
			$path .= "{$params['module']}/";
		}
		
		$controller = Util::camelcase($name);
		$scontroller = Util::smallcase($name);
		/**
		 * Nombre de archivo
		 **/
		$file = $path . "{$scontroller}_controller.php";
		
		echo "\r\n-- Eliminando controller: $controller\r\n$file\r\n";
		
		if(!unlink($file)) {
			throw new KumbiaException("No se ha logrado eliminar el archivo $file");
		}

		$path = APP_PATH . 'views/';
		if(isset($params['module']) && $params['module']) {
			$path .= "{$params['module']}/";
		}
		$path .= Util::smallcase($name) . '/';

		echo "\r\n-- Eliminando directorio:\r\n$path\r\n";
		
		if(!Util::removeDir($path)) {
			throw new KumbiaException("No se ha logrado eliminar el directorio $path");
		}

		return true;
	}
}