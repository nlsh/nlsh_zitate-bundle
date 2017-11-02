<?php
/**
 * Erweiterung des tl_nlsh_zitate_zitate DCA`s
 *
 * @package   nlsh/nlsh_zitate-bundle
 * @author    Nils Heinold
 * @copyright Nils Heinold (c) 2017
 * @link      https://github.com/nlsh/nlsh_zitate-bundle
 * @license   LGPL
 */

 /**
  * Table tl_nlsh_zitate_zitate
  */
$GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate'] = array(
    // Config.
    'config' => array(
                'dataContainer' => 'Table',
                'ptable'        => 'tl_nlsh_zitate_collections',
                'sql'           => array(
                                   'keys' => array(
                                             'id'                    => 'primary',
                                             'pid,published,sorting' => 'index'
                                             )
                                   )
                ),
    // List.
    'list' => array(
              'sorting' => array(
                           'mode'                   => 4,
                           'fields'                 => array('sorting'),
                           'flag'                   => 1,
                           'panelLayout'            => 'search,sort,filter',
                           'headerFields'           => array(
                                                        'collectionName',
                                                        'tstamp',
                                                       ),
                            'child_record_callback' => array(
                                                        'tl_nlsh_zitate_zitate',
                                                        'zitateAuflisten',
                                                       ),
                           ),
                'label' => array(
                           'fields' => array('title'),
                           'format' => '%s'
                           ),
                'global_operations' => array(
                                       'all' => array(
                                                'label'       => &$GLOBALS['TL_LANG']['MSC']['all'],
                                                'href'        => 'act=select',
                                                'class'       => 'header_edit_all',
                                                'attributes'  => 'onclick="Backend.getScrollOffset();" accesskey="e"'
                                                )
                                       ),
                'operations' => array(
                                'edit'   => array(
                                            'label'           => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['edit'],
                                            'href'            => 'act=edit',
                                            'icon'            => 'edit.svg'
                                            ),
                                'copy'   => array(
                                            'label'           => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['copy'],
                                            'href'            => 'act=copy',
                                            'icon'            => 'copy.svg'
                                            ),
                                'delete' => array(
                                            'label'           => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['delete'],
                                            'href'            => 'act=delete',
                                            'icon'            => 'delete.svg',
                                            'attributes'      => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                                            ),
                                'toggle' => array(
                                            'label'           => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['toggle'],
                                            'icon'            => 'visible.svg',
                                            'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                                            'button_callback' => array(
                                                                  'tl_nlsh_zitate_zitate',
                                                                  'toggleIcon',
                                                                 )
                                            ),
                                'show'   => array(
                                            'label'           => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['show'],
                                            'href'            => 'act=show',
                                            'icon'            => 'show.svg'
                                            )
                                )
              ),
    // Palettes.
    'palettes' => array(
                  '__selector__' => array(''),
                  'default' => '{nlsh_zitate_zitate_legend},zitat,zitateUrl;
                                {nlsh_zitate_zitea_teaser_legend:hide},teaser;
                                {nlsh_zitate_zitea_source_legend},source;
                                {nlsh_zitate_zitate_autor_legend:hide},autor,autorUrl;
                                {nlsh_zitate_zitate_category_legend:hide},categories;
                                {nlsh_zitate_zitate_invisible_legend:hide},published;'
                  ),
    // Subpalettes.
    'subpalettes' => array('' => ''),
    // Fields.
    'fields' => array(
                'id'         => array(
                                'sql'        => 'int(10) unsigned NOT NULL auto_increment'
                                ),
                'pid'        => array(
                                'sql'        => "int(10) unsigned NOT NULL default '0',
                                'relation'   => array('type'=>'belongsTo', 'load'=>'eager'"
                                ),
                'sorting'    => array(
                                'sql'        => "int(10) unsigned NOT NULL default '0'"
                                ),
                'tstamp'     => array(
                                'label'      => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['tstamp'],
                                'sql'        => "int(10) unsigned NOT NULL default '0'"
                                ),
                'published'  => array(
                                'label'      => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['published'],
                                'exclude'    => true,
                                'filter'     => true,
                                'inputType'  => 'checkbox',
                                'sql'        => "char(1) NOT NULL default ''"
                                ),
                'zitat'      => array(
                                'label'      => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['zitat'],
                                'exclude'    => true,
                                'inputType'  => 'textarea',
                                'eval'       => array(
                                                 'mandatory' => true,
                                                 'rte'       => 'tinyNews',
                                                 'cols'      => 3,
                                                 'rows'      => 10,
                                                ),
                                'sql'        => 'text NULL'
                                ),
                'teaser'     => array(
                                 'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['teaser'],
                                 'exclude'   => true,
                                 'inputType' => 'textarea',
                                 'eval'      => array(
                                                  'mandatory' => false,
                                                  'rte'       => 'tinyFlash',
                                                  'cols'      => 3,
                                                  'rows'      => 10,
                                                  'tl_class'  => 'clr'
                                                ),
                                 'sql'       => 'text NULL',
                                ),
                'source'     => array(
                                 'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['source'],
                                 'exclude'   => true,
                                 'inputType' => 'textarea',
                                 'eval'      => array(
                                                 'mandatory' => true,
                                                 'rte'       => 'tinyFlash',
                                                 'cols'      => 3,
                                                 'rows'      => 10,
                                                 'tl_class'  => 'clr',
                                                ),
                                 'sql'       => 'text NULL',
                                ),
                'zitateUrl'  => array(
                                 'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['zitateUrl'],
                                 'exclude'   => true,
                                 'search'    => true,
                                 'inputType' => 'text',
                                 'eval'      => array(
                                                 'mandatory'      => false,
                                                 'rgxp'           => 'url',
                                                 'decodeEntities' => true,
                                                 'maxlength'      => 255,
                                                 'tl_class'       => 'w50',
                                                ),
                                 'sql'       => "varchar(255) NOT NULL default ''",
                                ),
                'autor'      => array(
                                 'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['autor'],
                                 'exclude'   => true,
                                 'inputType' => 'text',
                                 'eval'      => array(
                                                 'mandatory' => true,
                                                 'maxlength' => 255,
                                                 'tl_class'  => 'w50',
                                                ),
                                 'sql'       => "varchar(255) NOT NULL default ''",
                                ),
                'autorUrl'   => array(
                                 'label'     => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['autorUrl'],
                                 'exclude'   => true,
                                 'search'    => true,
                                 'inputType' => 'text',
                                 'eval'      => array(
                                                        'mandatory' => false,
                                                        'rgxp'      => 'url',
                                                        'maxlength' => 255,
                                                        'tl_class'  => 'w50',
                                                ),
                                 'sql'       => "varchar(255) NOT NULL default ''",
                                ),
                'categories' => array(
                                 'label'            => &$GLOBALS['TL_LANG']['tl_nlsh_zitate_zitate']['categories'],
                                 'exclude'          => true,
                                 'inputType'        => 'checkboxWizard',
                                 'options_callback' => array(
                                                        'tl_nlsh_zitate_zitate',
                                                        'categoriesSelection',
                                                       ),
                                 'eval'             => array('multiple' => true),
                                 'reference'        => &$GLOBALS['TL_LANG']['tl_layout'],
                                 'sql'              => "varchar(255) NOT NULL default ''",
                                ),
                )
                                              );

/**
 * DCA- Klasse der Tabelle tl_nlsh_zitate_zitate
 *
 * @package nlsh/nlsh_zitate-bundle
 */

/**
 * Class tl_nlsh_zitate_zitate
 *
 * Enthält Funktionen einzelner Felder der Konfiguration
 */
class tl_nlsh_zitate_zitate extends Backend
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
     * Funktion zum Auflisten der Zitateinträge
     * aus DCA -> tl_faq.php Version 4.4.1 kopiert und angepasst!
     *
     * @param array $arrRow Array mit kompletter Zeile eines Eintrages.
     *
     * @return string
     */
    public function zitateAuflisten(array $arrRow)
    {
        $key  = $arrRow['published'] ? 'published' : 'unpublished';
        $date = Date::parse(Config::get('datimFormat'), $arrRow['tstamp']);

        return '
        <div class="cte_type ' . $key . '"><strong>' . $arrRow['autor'] . '</strong> - ' . $date . '</div>
        <div class="limit_height' . (!Config::get('doNotCollapse') ? ' h40' : '') . '">
        ' . StringUtil::insertTagToSrc($arrRow['teaser']) . '
        </div>' . "\n";

    }//end zitateAuflisten()

    /**
     * Funktion zur Auswahl der Kategorien
     *
     * Options_callback des categories- Feldes
     *
     * @param \DataContainer $dc Contao DataContainer- Objekt.
     *
     * @return array         Array mit den vorhandenen Kategorien
     */
    public function categoriesSelection(\DataContainer $dc)
    {
        $opjOptions = $this->Database->execute(
            'SELECT * FROM `tl_nlsh_zitate_category`'
        );
        while ($opjOptions->next()) {
            $return[$opjOptions->id] = $opjOptions->categoryName;
        }

        return $return;

    }//end categoriesSelection()

    /**
     * Return the "toggle visibility" button
     * aus Contao- DCA Version 4.4.1 kopiert und angepasst!
     *
     * @param array  $row        Zeile.
     * @param mixed  $href       Adresse.
     * @param string $label      Label.
     * @param string $title      Titel.
     * @param string $icon       Icon.
     * @param string $attributes Attribute.
     *
     * @return string
     */
    public function toggleIcon(array $row, $href, string $label, string $title, string $icon, string $attributes)
    {
        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);
        if (!$row['published']) {
            $icon = 'invisible.svg';
        }

        $objPage = $this->Database->prepare('SELECT * FROM tl_page WHERE id=?')
        ->limit(1)
        ->execute($row['pid']);
        return '<a href="' . $this->addToUrl($href) . '" title="' . StringUtil::specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"') . '</a> ';

    }//end toggleIcon()

    /**
     * Disable/enable a user group
     * aus Contao- DCA Version 4.4.1 kopiert und angepasst!
     *
     * @param integer       $intId
     * @param boolean       $blnVisible
     * @param DataContainer $dc
     *
     * @throws Contao\CoreBundle\Exception\AccessDeniedException
     */
    public function toggleVisibility(int $intId, $blnVisible, DataContainer $dc=null)
    {
        // Set the ID and action.
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');
        if ($dc) {
            $dc->id = $intId;
            // See #8043.
        }

        // Trigger the onload_callback.
        if (is_array($GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate']['config']['onload_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate']['config']['onload_callback'] as $callback) {
                if (is_array($callback)) {
                    $this->import($callback[0]);
                    $this->{$callback[0]}->{$callback[1]}($dc);
                } else if (is_callable($callback)) {
                    $callback($dc);
                }
            }
        }

        // Set the current record.
        if ($dc) {
            $objRow = $this->Database->prepare('SELECT * FROM tl_nlsh_zitate_zitate WHERE id=?')
            ->limit(1)
            ->execute($intId);
            if ($objRow->numRows) {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Versions('tl_nlsh_zitate_zitate', $intId);
        $objVersions->initialize();
        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate']['fields']['published']['save_callback'] as $callback) {
                if (is_array($callback)) {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                } else if (is_callable($callback)) {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();
        // Update the database
        $this->Database->prepare("UPDATE tl_nlsh_zitate_zitate SET tstamp=$time, published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
        ->execute($intId);
        if ($dc) {
            $dc->activeRecord->tstamp    = $time;
            $dc->activeRecord->published = ($blnVisible ? '1' : '');
        }

        // Trigger the onsubmit_callback.
        if (is_array($GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate']['config']['onsubmit_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_nlsh_zitate_zitate']['config']['onsubmit_callback'] as $callback) {
                if (is_array($callback)) {
                    $this->import($callback[0]);
                    $this->{$callback[0]}->{$callback[1]}($dc);
                } else if (is_callable($callback)) {
                    $callback($dc);
                }
            }
        }

        $objVersions->create();

    }//end toggleVisibility()

}//end class
