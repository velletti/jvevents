<?php
$returnArray = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,email,phone,sales_force_user_id,images,description,organizer_category,',
		'iconfile' =>  'EXT:jv_events/Resources/Public/Icons/tx_jvevents_domain_model_organizer.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, email, link, phone, sales_force_user_id, images, description, organizer_category, tags',
	),
	'types' => array(
		'1' => array('showitem' => '--palette--;;data, --div--;Relations, --palette--;;relations, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, '),
	),
	'palettes' => array(
		'data' => array('showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, --linebreak--,name, --linebreak--,email, --linebreak--,link, --linebreak--,phone, --linebreak--,sales_force_user_id, --linebreak--,description,'),
		'relations' => array('showitem' => 'teaser_image, --linebreak--,images, --linebreak--,organizer_category, --linebreak--, tags,'),
	    'access' => array('showitem' => ' starttime, endtime, --linebreak--,access_users,--linebreak--, access_groups,')
    ),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_jvevents_domain_model_organizer',
				'foreign_table_where' => 'AND tx_jvevents_domain_model_organizer.pid=###CURRENT_PID### AND tx_jvevents_domain_model_organizer.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		
		
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
                'renderType' => 'inputDateTime',
                'behaviour' => array(
                    'allowLanguageSynchronization' => true ,
                ) ,
				'size' => 13,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
                'renderType' => 'inputDateTime',
                'behaviour' => array(
                    'allowLanguageSynchronization' => true ,
                ) ,
				'size' => 13,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
        'crdate' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.crdate',
            'config' => array(
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'behaviour' => array(
                    'allowLanguageSynchronization' => true ,
                ) ,
                'size' => 13,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
            ),
        ),
        'tstamp' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.tstamp',
            'config' => array(
                'type' => 'passthrough',
            ),
        ),

		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
        'link' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.link',
            'config' => array(
                'type' => 'input',
                'eval' => 'trim',
                'size' => '30',
                'max' => '255',
                'softref' => 'typolink,url',
                'renderType' => 'inputLink' ,

                'fieldControl' => array(
                    'linkPopup' => array(
                        'options' => array(
                            'blindLinkOptions' => 'mail,file,spec,folder' ,
                            'title' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_location.link' ,
                            'windowOpenParameters' => 'height=300,width=500,status=0,menubar=0,scrollbars=1' ,
                        ),

                    ),
                ) ,
            ) ,

        ),
		'phone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'sales_force_user_id' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.sales_force_user_id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array(
					'appearance' => array(
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
					),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						)
					),
					'maxitems' => 1
				),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
            ],
		),
        'access_groups' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.accessGroups',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => array(
                    array(
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        -1
                    ),
                    array(
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        -2
                    ),
                    array(
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        '--div--'
                    )
                ),
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
                'foreign_table_where' => 'ORDER BY fe_groups.title',
                'enableMultiSelectFilterTextfield' => true
            )
        ),
        'access_users' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.accessUsers',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'size' => 8,
                'multiple' => 1,
                'minitems' => 0,
                'maxitems' => 20,
            ),
        ),
		'organizer_category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.organizer_category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_jvevents_domain_model_category',
				'foreign_table_where' => ' AND tx_jvevents_domain_model_category.type = 2 AND tx_jvevents_domain_model_category.sys_language_uid IN (-1,0) ORDER BY tx_jvevents_domain_model_category.title ',
				'MM' => 'tx_jvevents_organizer_category_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,

                'fieldControl' => array(
                    'addRecord' => array(
                        'disabled' => false ,
                        'options' => array(
                            'pid' => '###CURRENT_PID###' ,
                            'setValue' => 'prepend' ,
                            'icon' => 'actions-add',
                            'table' => 'tx_jvevents_domain_model_category' ,
                            'title' => 'Create new' ,
                        ),

                    ) ,
                    'editPopup' => array(
                        'disabled' => false ,
                        'options' => array(
                            'icon' => 'actions-open',
                            'windowOpenParameters' => 'height=350,width=580,status=0,menubar=0,scrollbars=1' ,
                            'title' => 'Edit' ,
                        ),
                    ) ,
                ) ,

			),
		),
        'teaser_image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_organizer.teaserImage',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'teaser_image',
                array(
                    'appearance' => array(
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ),
                    'foreign_types' => array(
                        '0' => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        )
                    ),
                    'maxitems' => 1
                ),
                "jpg,jpeg,gif,png"
            ),
        ),
        'tags' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_event.tags',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_jvevents_domain_model_tag',
                //'foreign_table_where' => ' AND tx_jvevents_domain_model_tag.sys_language_uid in (-1, ###REC_FIELD_sys_language_uid###)',
                'itemsProcFunc' => 'JVE\\JvEvents\\UserFunc\\Flexforms->TranslateMMvalues' ,
                'foreign_table_where' => ' AND tx_jvevents_domain_model_tag.type = 2 AND (tx_jvevents_domain_model_tag.sys_language_uid = 0 OR tx_jvevents_domain_model_tag.l10n_parent = 0) ORDER BY tx_jvevents_domain_model_tag.name',

                'MM' => 'tx_jvevents_organizer_tag_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => array(
                    'addRecord' => array(
                        'disabled' => false ,
                        'options' => array(
                            'pid' => '###CURRENT_PID###' ,
                            'setValue' => 'prepend' ,
                            'icon' => 'actions-add',
                            'table' => 'tx_jvevents_domain_model_tag' ,
                            'title' => 'Create new' ,
                        ),

                    ) ,
                    'editPopup' => array(
                        'disabled' => false ,
                        'options' => array(
                            'icon' => 'actions-open',
                            'windowOpenParameters' => 'height=350,width=580,status=0,menubar=0,scrollbars=1' ,
                            'title' => 'Edit' ,
                        ),
                    ) ,
                ) ,
            ),
        ),
		
	),
);



$configuration = \JVE\JvEvents\Utility\EmConfigurationUtility::getEmConf();

if ( ! $configuration['hasLoginUser'] == 1 ) {
    unset($returnArray['columns']['access'] ) ;
    unset($returnArray['columns']['registration_access'] ) ;
}
if ( ! $configuration['enableSalesForce'] == 1 ) {
    unset($returnArray['columns']['sales_force_user_id'] ) ;
}

return $returnArray ;
