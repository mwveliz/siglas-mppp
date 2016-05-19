<?php

/**
 * io_disponible module configuration.
 *
 * @package    siglas
 * @subpackage io_disponible
 * @author     Livio Lopez
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class io_disponibleGeneratorConfiguration extends BaseIo_disponibleGeneratorConfiguration
{
    public function getFilterDefaults()
    {
        return array('status' => 'A');
    }
}
