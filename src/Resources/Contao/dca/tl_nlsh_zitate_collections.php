<?php
/**
 * Erweiterung des tl_nlsh_zitate_collections DCA`s
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold 2017
 * @link      http://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

 /**
  * Table tl_nlsh_zitate_collections
  */
$GLOBALS['TL_DCA']['tl_nlsh_zitate_collections'] = array(
    // Config.
    'config' => array(
                'dataContainer' => 'Table',
                'ctable'        => array('tl_nlsh_zitate_zitate'),
                'sql'           => array(
                                   'keys' => array('id' => 'primary'),
                                   )
                ),
    // List.
    'list' => array(
              'sorting' => array(
                           'mode'         => 1,
                           'fields'       => array('collectionName'),
                           'flag'         => 1,
                           'panelLayout'  => 'search,limit'
                           ),
              'label' => array(
                         'fields' => array('collectionName'),
                         'format' => '%s'
                         ),
              'global_operations'         => array(
                                             'configCategory' => array(
                                                      'label'          => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_collections']['configCategory'],
                                                      'href'           => 'do=configCategory',
                                                      'icon'           => 'settings.svg',
                                                      'class'          => 'header_edit_all',
                                                      'attributes'     => 'onclick="Backend.getScrollOffset();" accesskey="e"',
                                                                 ),
                                             'all' => array(
                                                      'label'          => &$GLOBALS['TL_LANG']['MSC']['all'],
                                                      'href'           => 'act=select',
                                                      'class'          => 'header_edit_all',
                                                      'attributes'     => 'onclick="Backend.getScrollOffset();" accesskey="e"',
                                                      )
                                             ),
              'operations'                => array(
                                             'edit'   => array(
                                                         'label'       => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_collections']['edit'],
                                                         'href'        => 'table=tl_nlsh_zitate_zitate',
                                                         'icon'        => 'edit.svg',
                                                         'attributes'  => 'class="contextmenu"'
                                                         ),
                                             'copy'   => array(
                                                         'label'       => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_collections']['copy'],
                                                         'href'        => 'act=copy',
                                                         'icon'        => 'copy.svg'
                                                         ),
                                             'delete' => array(
                                                         'label'       => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_collections']['delete'],
                                                         'href'        => 'act=delete',
                                                         'icon'        => 'delete.svg',
                                                         'attributes'  => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                                                         ),
                                             'show'   => array(
                                                         'label'       => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_collections']['show'],
                                                         'href'        => 'act=show',
                                                         'icon'        => 'show.svg'
                                                         )
                                             )
              ),
    // Palettes.
    'palettes' => array(
                  '__selector__' => array(''),
                  'default' => '{nlsh_zitate_legend},collectionName;'
                  ),
    // Subpalettes.
    'subpalettes' => array(
                     '' => ''
                     ),
    // Fields.
    'fields' => array(
                'id' => array(
                        'sql'        => 'int(10) unsigned NOT NULL auto_increment'
                        ),
                'sorting' => array(
                             'sql'   => "int(10) unsigned NOT NULL default '0'"
                             ),
                'tstamp' => array(
                            'sql'    => "int(10) unsigned NOT NULL default '0'"
                            ),
                'collectionName' => array(
                                        'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_collections']['collectionName'],
                                        'inputType' => 'text',
                                        'search'    => true,
                                        'eval'      => array(
                                                       'mandatory' => true,
                                                       'maxlength' => 255,
                                                       'unique'    => true
                                                       ),
                                        'sql'       => "varchar(128) NOT NULL default ''"
                                    )
                )
                                                   );
