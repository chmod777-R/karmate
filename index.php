<?php
/**
 * Karmate Flexiable PHP Framework
 *
 *
 * @category   KARMATE
 * @package    Framework
 * @author     Berkay Karataş <berkaykarats@icloud.com>
 * @copyright  2017
 * @license    http://www.php.net/license/3_01.txt  The MIT License
 * @version    Release: @1.0.0@
 * For the current version and documentation of the package:
 * @link       https://karmate.org
 */

define('_INDEX_', basename($_SERVER['SCRIPT_FILENAME']));
//----------------------------------------------------------------------------------------------------
// Include KARMATE kernel
//----------------------------------------------------------------------------------------------------
require_once __DIR__.DIRECTORY_SEPARATOR.'kernel'.'.php';
//----------------------------------------------------------------------------------------------------
// Run kernel                                                       |*| for stop =>     Kernel(0); |*|
//----------------------------------------------------------------------------------------------------
#Will be include apps and inner kernel
new Karmate\Kernel('1');
