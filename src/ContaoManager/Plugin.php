<?php
/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold 2017
 * @link      http://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

namespace Nlsh\ZitateBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Plugin for the Contao Manager.
 *
 * @author Andreas Schempp <https://github.com/aschempp>
 */
class Plugin implements BundlePluginInterface
{

    /**
     * {@inheritdoc}
     *
     * @param ParserInterface $parser Parser.
     *
     * @return Bundle Konfiguration
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
                BundleConfig::create('Nlsh\ZitateBundle\NlshZitateBundle')
                    ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
                    ->setReplace(['zitate']),
               ];

    }//end getBundles()

}//end class
