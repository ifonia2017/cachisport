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
 * @package    Builder
 * @copyright  Copyright (c) 2005-2009 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Builder para helpers
 *
 * @category  Kumbia
 * @package   Builder
 * @copyright  Copyright (c) 2005-2009 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version   SVN:$id
 */
class HelperBuilder implements BuilderInterface 
{
	/**
 	 * Ejecuta el builder
     *
	 * @param string $name elemento a construir
 	 * @param array $params
 	 * @return boolean
     * @throw BuilderException
 	 */
	public static function execute($name, $params)
    {
		/**
		 * Nombre de archivo para modelo
		 **/
		$__file__ = APP_PATH . 'plugins/helpers/' . "$name.php";
			
		/**
		 * Generando archivo
		 **/
		if(!file_exists($__file__)) {
			extract($params);
			
			echo "\r\n-- Generando helper: $name\r\n$__file__\r\n";

			if(!file_put_contents($__file__, "<?php\n")) {
				throw new KumbiaException("No se ha logrado generar el archivo de helper $__file__");
			}
		} else {
			echo "\r\n-- El helper ya existe en $__file__\r\n";
		}
		return true;
	}
}