<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2017 Leo Feyer
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold 2017
 * @link      http://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

/**
 * Für das Backend eine .css- Datei hinzufügen,
 * um ein Symbol für die "Kleingartenverwaltung" zu erzeugen
 */
if (TL_MODE === 'BE') {
    $GLOBALS['TL_CSS'][] = 'bundles/nlshzitate/backend.css';
}

/*
    * BACK END MODULES
    * Backend- Module hinzufügen
*/

// In Inhalte ['content'] auflisten.
$GLOBALS['BE_MOD']['content']['nlsh_zitate-bundle'] = array(
                                                       'tables' => array(
                                                                    'tl_nlsh_zitate_collections',
                                                                    'tl_nlsh_zitate_zitate',
                                                                   ),
                                                      );

array_insert(
    $GLOBALS['BE_MOD'],
    50,
    array(
     'nlsh_zitate-BundleSettings' => array(
                                      'configCategory' => array(
                                                           'tables' => array('tl_nlsh_zitate_category'),
                                                          ),
                                     ),
    )
);

/*
    * Content elements
    * Inhaltselemente hinzufügen
    *
*/

$GLOBALS['TL_CTE']['nlsh_zitate-bundle'] = array('nlshZitateOutput' => 'Nlsh\ZitateBundle\ContentNlshZitateOutput');
