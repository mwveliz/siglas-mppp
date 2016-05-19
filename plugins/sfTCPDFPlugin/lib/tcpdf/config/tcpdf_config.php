<?php
//============================================================+
// File name   : tcpdf_config.php
// Begin       : 2004-06-11
// Last Update : 2009-09-30
//
// Description : Configuration file for TCPDF.
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Configuration file for TCPDF.
 * @author Nicola Asuni
 * @copyright 2004-2008 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @package com.tecnick.tcpdf
 * @version 4.0.014
 * @link http://tcpdf.sourceforge.net
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2004-10-27
 */

// If you define the constant K_TCPDF_EXTERNAL_CONFIG, the following settings will be ignored.

if (!defined('K_TCPDF_EXTERNAL_CONFIG')) {
	
	// DOCUMENT_ROOT fix for IIS Webserver
	if ((!isset($_SERVER['DOCUMENT_ROOT'])) OR (empty($_SERVER['DOCUMENT_ROOT']))) {
		if(isset($_SERVER['SCRIPT_FILENAME'])) {
			$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
		} elseif(isset($_SERVER['PATH_TRANSLATED'])) {
			$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
		}	else {
			// define here your DOCUMENT_ROOT path if the previous fails
			$_SERVER['DOCUMENT_ROOT'] = '/var/www';
		}
	}
	
	// Automatic calculation for the following K_PATH_MAIN constant
	$k_path_main = str_replace( '\\', '/', realpath(substr(dirname(__FILE__), 0, 0-strlen('config'))));
	if (substr($k_path_main, -1) != '/') {
		$k_path_main .= '/';
	}
	
	/**
	 * Installation path (/var/www/tcpdf/).
	 * By default it is automatically calculated but you can also set it as a fixed string to improve performances.
	 */
//	define ('K_PATH_MAIN', $k_path_main);
	define ('K_PATH_MAIN', sfConfig::get("sf_root_dir") .'/plugins/sfTCPDFPlugin/lib/tcpdf/');
	
	// Automatic calculation for the following K_PATH_URL constant
	if (isset($_SERVER['HTTP_HOST']) AND (!empty($_SERVER['HTTP_HOST']))) {
		if(isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') {
			$k_path_url = 'https://';
		} else {
			$k_path_url = 'http://';
		}
		$k_path_url .= $_SERVER['HTTP_HOST'];
		$k_path_url .= str_replace( '\\', '/', substr($_SERVER['PHP_SELF'], 0, -24));
	}
	
	/**
	 * URL path to tcpdf installation folder (http://localhost/tcpdf/).
	 * By default it is automatically calculated but you can also set it as a fixed string to improve performances.
	 */
//	define ('K_PATH_URL', $k_path_url);
	define ('K_PATH_URL', "http://".$_SERVER['SERVER_NAME']);
	
	/**
	 * path for PDF fonts
	 * use K_PATH_MAIN.'fonts/old/' for old non-UTF8 fonts
	 */
//	define ('K_PATH_FONTS', K_PATH_MAIN.'fonts/');
	define ('K_PATH_FONTS', sfConfig::get("sf_root_dir") .'/plugins/sfTCPDFPlugin/lib/tcpdf/fonts/');
	
	/**
	 * cache directory for temporary files (full path)
	 */
//	define ('K_PATH_CACHE', K_PATH_MAIN.'cache/');
	define ('K_PATH_CACHE', sfConfig::get("sf_root_dir") .'/plugins/sfTCPDFPlugin/tcpdf/lib/cache/');
	
	/**
	 * cache directory for temporary files (url path)
	 */
//	define ('K_PATH_URL_CACHE', K_PATH_URL.'cache/');
	define ('K_PATH_URL_CACHE', "http://".$_SERVER['SERVER_NAME'] .'/cache/');
	
	/**
	 *images directory
	 */
//	define ('K_PATH_IMAGES', K_PATH_MAIN.'images/');
	define ('K_PATH_IMAGES', sfConfig::get("sf_root_dir") .'/web/images/organismo/pdf/');
	
	/**
	 * blank image
	 */
//	define ('K_BLANK_IMAGE', K_PATH_IMAGES.'_blank.png');
	define ('K_BLANK_IMAGE', sfConfig::get("sf_root_dir") .'/plugins/sfTCPDFPlugin/tcpdf/images/_blank.png');
	
	/**
	 * page format
	 */
	define ('PDF_PAGE_FORMAT', 'A4');
	
	/**
	 * page orientation (P=portrait, L=landscape)
	 */
	define ('PDF_PAGE_ORIENTATION', 'P');
	
	/**
	 * document creator
	 */
	define ('PDF_CREATOR', 'ProSoft Solutions Venezuela C.A. siglas.ve@gmail.com. (058)426-511.42.50');
	
	/**
	 * document author
	 */
	define ('PDF_AUTHOR', 'TCPDF');
	
	/**
	 * header title
	 */
	define ('PDF_HEADER_TITLE', '');
	
	/**
	 * header description string
	 */
	define ('PDF_HEADER_STRING', "");
	
	/**
	 * image logo
	 */
	define ('PDF_HEADER_LOGO', 'gob_pdf.png');
	
	/**
	 * header logo image width [mm]
	 */
	define ('PDF_HEADER_LOGO_WIDTH', 450);
	
	/**
	 *  document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch]
	 */
	define ('PDF_UNIT', 'pt');
	
	/**
	 * header margin
	 */
	define ('PDF_MARGIN_HEADER', 0);
	
	/**
	 * footer margin
	 */
	define ('PDF_MARGIN_FOOTER', 0);
	
	/**
	 * top margin
	 */
	define ('PDF_MARGIN_TOP', 80);
	
	/**
	 * bottom margin
	 */
	define ('PDF_MARGIN_BOTTOM', 25);
	
	/**
	 * left margin
	 */
	define ('PDF_MARGIN_LEFT', 0);
	
	/**
	 * right margin
	 */
	define ('PDF_MARGIN_RIGHT', 20);
	
	/**
	 * default main font name
	 */
	define ('PDF_FONT_NAME_MAIN', 'helvetica');
	
	/**
	 * default main font size
	 */
	define ('PDF_FONT_SIZE_MAIN', 8);
	
	/**
	 * default data font name
	 */
	define ('PDF_FONT_NAME_DATA', 'courier');
	
	/**
	 * default data font size
	 */
	define ('PDF_FONT_SIZE_DATA', 4);
	
	/**
	 * default monospaced font name
	 */
	define ('PDF_FONT_MONOSPACED', 'courier');
	
	/**
	 * ratio used to adjust the conversion of pixels to user units
	 */
	define ('PDF_IMAGE_SCALE_RATIO', 4);
	
	/**
	 * magnification factor for titles
	 */
	define('HEAD_MAGNIFICATION', 1.1);
	
	/**
	 * height of cell repect font height
	 */
	define('K_CELL_HEIGHT_RATIO', 1.25);
	
	/**
	 * title magnification respect main font size
	 */
	define('K_TITLE_MAGNIFICATION', 1.1);
	
	/**
	 * reduction factor for small font
	 */
	define('K_SMALL_RATIO', 2/3);
}

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
