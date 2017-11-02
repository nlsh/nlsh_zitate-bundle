<?php
/**
 * Erweiterung des tl_content DCA`s
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold 2017
 * @link      http://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

 /**
  * Table tl_content
  */

/*
    * Palettes.
*/

// Palettes '__Selector__' für Subpalettes erweitern.
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'nlshLimitedByCategory';

// Palettes erweitern.
$GLOBALS['TL_DCA']['tl_content']['palettes']['nlshZitateOutput'] = '{type_legend},
                                                                        type,
                                                                        headline;
                                                                    {collectionSelection_legend},
                                                                        nlshCollectionSelection;
                                                                    {categorySelection_legend},
                                                                        nlshShowCategory;
                                                                    {template_legend:hide},
                                                                        customTpl;
                                                                    {protected_legend:hide},
                                                                        protected;
                                                                    {expert_legend:hide},
                                                                        guests,
                                                                        cssID;
                                                                    {invisible_legend:hide},
                                                                        invisible,
                                                                        start,
                                                                        stop';

/*
    * Subpalettes.
*/

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['nlshShowCategory'] = 'nlshShowCategory';

/*
    * Fields.
*/

$GLOBALS['TL_DCA']['tl_content']['fields']['nlshCollectionSelection'] = array(
                                                                        'label'            => &$GLOBALS['TL_LANG']['tl_content']['nlshCollectionSelection'],
                                                                        'exclude'          => true,
                                                                        'inputType'        => 'checkboxWizard',
                                                                        'options_callback' => array(
                                                                                               'tl_content_nlshZitate',
                                                                                               'collectionSelection',
                                                                                              ),
                                                                        'eval'             => array('multiple' => true),
                                                                        'reference'        => &$GLOBALS['TL_LANG']['tl_layout'],
                                                                        'sql'              => "varchar(255) NOT NULL default ''",
                                                                        );

$GLOBALS['TL_DCA']['tl_content']['fields']['nlshLimitedByCategory'] = array(
                                                                          'label'          => &$GLOBALS['TL_LANG']['tl_content']['nlshLimitedByCategory'],
                                                                          'exclude'        => true,
                                                                          'inputType'      => 'checkbox',
                                                                          'eval'           => array('submitOnChange' => true),
                                                                          'sql'            => "char(1) NOT NULL default ''",
                                                                      );

$GLOBALS['TL_DCA']['tl_content']['fields']['nlshShowCategory'] = array(
                                                                       'label'            => &$GLOBALS['TL_LANG']['tl_content']['nlshShowCategory'],
                                                                       'exclude'          => true,
                                                                       'inputType'        => 'checkboxWizard',
                                                                       'options_callback' => array(
                                                                                              'tl_content_nlshZitate',
                                                                                              'categorySelection',
                                                                                             ),
                                                                       'eval'             => array('multiple' => true),
                                                                       'reference'        => &$GLOBALS['TL_LANG']['tl_layout'],
                                                                       'sql'              => "varchar(255) NOT NULL default ''",
                                                                 );
/**
 * DCA- Klasse der Tabelle tl_content
 *
 * @package nlsh/nlsh_zitate-bundle
 */

/**
 * Class tl_content
 *
 * Enthält Funktionen einzelner Felder der selbsthinzugefügten Felder in der tl_content- Tabelle
 */
class tl_content_nlshZitate extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');

    }//end __construct()

    /**
     * Funktion zur Auswahl der Zitatensammlungen
     *
     * Options_callback des collectionSelection- Feldes
     *
     * @param \DataContainer $dc Contao DataContainer- Objekt.
     *
     * @return array         Array mit den vorhandenen Zitatensammlungen
     */
    public function collectionSelection(\DataContainer $dc)
    {
        $opjOptions = $this->Database->execute(
            'SELECT * FROM `tl_nlsh_zitate_collections`'
        );
        while ($opjOptions->next()) {
            $return[$opjOptions->id] = $opjOptions->collectionName;
        }

        return $return;

    }//end collectionSelection()

    /**
     * Funktion zur Auswahl der Kategorien
     *
     * Options_callback des categorySelection- Feldes
     *
     * @param \DataContainer $dc Contao DataContainer- Objekt.
     *
     * @return array         Array mit den vorhandenen Kategorien
     */
    public function categorySelection(\DataContainer $dc)
    {
        $opjOptions = $this->Database->execute(
            'SELECT * FROM `tl_nlsh_zitate_category`'
        );
        while ($opjOptions->next()) {
            $return[$opjOptions->id] = $opjOptions->categoryName;
        }

        return $return;

    }//end categorySelection()

}//end class
