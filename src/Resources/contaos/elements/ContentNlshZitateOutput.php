<?php
/**
 * Front end content element "ContentNlshZitateOutput".
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold (c) 2017
 * @link      https://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

namespace Nlsh\ZitateBundle;

use Contao\StringUtil;
use Contao;
use Contao\NlshZitateCollectionsModel;
use Contao\NlshZitateZitateModel;
use Doctrine\DBAL\Cache\ArrayStatement;

/**
 * Front end content element "ContentNlshZitateOutput".
 */
class ContentNlshZitateOutput extends \ContentElement
{

    /**
     * Template
     *
     * @var string Name des Templates
     */
    protected $strTemplate = 'ce_NlshZitateOutput';

    /**
     * Ausgewählte Sammlungen
     *
     * @var null|array null, wenn keine Zitatensammlung ausgewählt wurde
     *                 |
     *                 ein Array mit den Namen der ausgewählten Sammlungen,
     *                 jeweils indiziert mit dessen 'id' in der 'tl_nlsh_zitate_collections'- Tabelle
     */
    public $arrCollectionSelection = null;

    /**
     * Ausgewählte Zitate, indiziert mit dem Namen der Zitatensammlung
     *
     * @var null|array null, wenn keine Zitate in ausgewählte Sammlungen enthalten
     *                 |
     *                 ein Array mit den ausgewählten Zitaten,
     *                 jeweils indiziert mit dem 'Namen' der Sammlung
     */
    public $arrZitateIndexCollectionName = null;

    /**
     * Ausgewählte Zitate
     *
     * @var null|array null, wenn keine Zitate vorhanden
     *                 |
     *                 ein Array mit allen auszugebenen Zitaten, ohne Indizierung,
     *                 ein Key ['collectionName'] mit dem 'Namen' der Sammlung wird hinzugefügt
     */
    public $arrZitate = null;

    /**
     * Fehlermeldungen
     *
     * @var null|array null, wenn keine Fehlermeldungen vorhanden
     *                 |
     *                 ein Array mit den einzelnen Fehlermeldungen
     */
    public $arrError = array();

    /**
     * Das Content- Element auswerten
     * am Besten nur Aufgaben für das Back- End, diese stehen aber auch im Front- End zur Verfügung.
     * https://community.contao.org/de/showthread.php?635-compile()-vs-generate()
     *
     * @return string
     */
    public function generate()
    {
         // Ausgewählte Sammlungen zur Verfügung stellen, wenn vorhanden.
        if ($this->nlshCollectionSelection !== '') {
            $collectionSelection = StringUtil::deserialize($this->nlshCollectionSelection);

            $objModel = NlshZitateCollectionsModel::findMultipleByIds(
                $collectionSelection,
                array('order' => ' `id` ASC')
            );
            if ($objModel !== null) {
                while ($objModel->next() !== false) {
                    $this->arrCollectionSelection[$objModel->id] = $objModel->collectionName;
                }
            }
        }//end if

         // Anzeige im Backend.
        if (TL_MODE === 'BE') {
             // Überschrift einfügen, wenn vorhanden.
            if ($this->headline !== '') {
                $return = '<' . $this->hl . '>' . $this->headline . '</' . $this->hl . '>';
            }

             // Namen der ausgewählten Zitatensammlungen anzeigen.
            if ($this->arrCollectionSelection !== null) {
                $return .= '</br><div>';
                $return .= $GLOBALS['TL_LANG']['CTE']['ContentNlshZitateOutput']['outPutZitate'];
                $return .= '<ul>';

                foreach ($this->arrCollectionSelection as $key => $value) {
                    $return .= '<li> - ' . $value . '</li>';
                }

                $return .= '</ul>';
                $return .= '</br></div>';
            } else {
                 // Keine Zitatensammlungen ausgewählt/ vorhanden.
                $return .= $GLOBALS['TL_LANG']['CTE']['NlshZitateOutput']['noSelection'];
            }

            return $return;
        }//end if

        return parent::generate();

    }//end generate()

    /**
     * Das Content- Element erzeugen
     * https://community.contao.org/de/showthread.php?635-compile()-vs-generate()
     *
     * @return void
     */
    protected function compile()
    {
         // Zitate der ausgewählten Sammlungen auslesen.
        if ($this->arrCollectionSelection !== null) {
            foreach ($this->arrCollectionSelection as $key => $name) {
                $objModel = NlshZitateZitateModel::findBy(
                    array(
                     'pid = ?',
                     'published = ?',
                    ),
                    array(
                     $key,
                     '1',
                    ),
                    array('order' => ' `sorting` ASC')
                );
                 // Wenn Zitate vorhanden, einlesen, indiziert mit dem Namen der Sammlung.
                if ($objModel !== null) {
                    while ($objModel->next() !== false) {
                        $boolShow = true;
                         // Jetzt Kontrolle, ob Einschränkung durch Kategorie- Auswahl.
                        if (($this->nlshLimitedByCategory === '1') && ($this->nlshShowCategory !== '')) {
                            $boolShow        = false;
                            $arrShowCategory = StringUtil::deserialize($this->nlshShowCategory);
                            $arrCategories   = StringUtil::deserialize($objModel->categories);

                            foreach ($arrShowCategory as $value) {
                                if (in_array($value, $arrCategories) === true) {
                                    $boolShow = true;
                                }
                            }
                        }

                        if ($boolShow === true) {
                            // Lt. Contao Code sollte der tiny- Code gesäubert werden.
                            $objModel->teaser = \StringUtil::toHtml5($objModel->teaser);
                            $objModel->zitat  = \StringUtil::toHtml5($objModel->zitat);
                            $objModel->source = \StringUtil::toHtml5($objModel->source);

                            $objModel->teaser = \StringUtil::encodeEmail($objModel->teaser);
                            $objModel->zitat  = \StringUtil::encodeEmail($objModel->zitat);
                            $objModel->source = \StringUtil::encodeEmail($objModel->source);

                            $this->arrZitateIndexCollectionName[$name] = $objModel->fetchAll($objModel);
                        }
                    }//end while
                }//end if
            }//end foreach
        } else {
             // Keine Zitatensammlung ausgewählt, Fehlermeldung!
            $this->arrError[] = $GLOBALS['TL_LANG']['CTE']['NlshZitateOutput']['noSelection'];
        }//end if

         // Alle Zitate der einzelnen Sammlungen in ein Array.
        if ($this->arrZitateIndexCollectionName !== null) {
            foreach ($this->arrZitateIndexCollectionName as $key => $value) {
                foreach ($value as $zitat) {
                    $zitat['collectionName'] = $key;
                    $this->arrZitate[]       = $zitat;
                }
            }//end foreach
        }

         // Wenn keine Zitate vorhanden, dann Übergabe Fehlermeldung.
        if ($this->arrZitate === null) {
            $this->arrError[] = $GLOBALS['TL_LANG']['CTE']['NlshZitateOutput']['noZitate'];
        }

         // Übergabe in das Template.
        $this->Template->arrZitateIndexCollectionName = $this->arrZitateIndexCollectionName;

        $this->Template->arrError  = $this->arrError;
        $this->Template->arrZitate = $this->arrZitate;
        $this->Template->addImage  = false;

    }//end compile()

}//end class
