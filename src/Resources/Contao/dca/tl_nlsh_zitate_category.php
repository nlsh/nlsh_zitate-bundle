<?php
/**
 * Erweiterung des tl_nlsh_zitate_category DCA`s
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold 2017
 * @link      http://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

 /**
  * Table tl_nlsh_zitate_category
  */
$GLOBALS['TL_DCA']['tl_nlsh_zitate_category'] = array(
    // Config.
    'config' => array(
                'dataContainer' => 'Table',
                'sql'           => array(
                                   'keys' => array(
                                             'id'  => 'primary'
                                             ),
                                   )
                ),
    // List.
    'list' => array(
              'sorting'                   => array(
                                              'mode'        => 1,
                                              'fields'      => array('categoryName'),
                                              'flag'        => 1,
                                              'panelLayout' => 'search,limit',
                                             ),
              'label'                     => array(
                                              'fields' => array('categoryName'),
                                              'format' => '%s',
                                             ),
              'global_operations'         => array(
                                             'all'          => array(
                                                                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                                                                'href'       => 'act=select',
                                                                'class'      => 'header_edit_all',
                                                                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"',
                                                               )
                                             ),
              'operations'                => array(
                                             'edit'         => array(
                                                                'label'      => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_category']['edit'],
                                                                'href'       => 'act=edit',
                                                                'icon'       => 'edit.svg',
                                                                'attributes' => 'class="contextmenu"',
                                                               ),
                                             'show'         => array(
                                                                'label' => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_category']['show'],
                                                                'href'  => 'act=show',
                                                                'icon'  => 'show.svg',
                                                               )
                                             )
              ),
    // Palettes.
    'palettes' => array(
                  '__selector__' => array(''),
                  'default' => '{nlsh_zitate_category_legend},categoryName;'
                  ),
    // Subpalettes.
    'subpalettes' => array(
                     '' => ''
                     ),
    // Fields.
    'fields' => array(
                'id' => array(
                        'sql'       => 'int(10) unsigned NOT NULL auto_increment'
                        ),
                'sorting' => array(
                             'sql'  => "int(10) unsigned NOT NULL default '0'"
                             ),
                'tstamp' => array(
                            'sql'   => "int(10) unsigned NOT NULL default '0'"
                            ),
                'categoryName' => array(
                                       'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_category']['categoryName'],
                                       'inputType' => 'text',
                                       'search'    => true,
                                       'eval'      => array(
                                                      'mandatory' => true,
                                                      'maxlength' => 255,
                                                      'unique'    => true,
                                                      ),
                                       'sql'       => "varchar(128) NOT NULL default ''"
                                  )
                )
                                                );
