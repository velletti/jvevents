<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_tag',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => FALSE ,
        'default_sortby' => 'name ASC',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,',
		'iconfile' => '/typo3conf/ext/jv_events/Resources/Public/Icons/tx_jvevents_domain_model_tag.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, tag_category',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid, l10n_parent, name,tag_category,--div--;access, hidden, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_jvevents_domain_model_tag',
				'foreign_table_where' => 'AND tx_jvevents_domain_model_tag.pid=###CURRENT_PID### AND tx_jvevents_domain_model_tag.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		
		
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'size' => 13,
                'behaviour' => array(
                    'allowLanguageSynchronization' => true ,
                ) ,
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
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
                'renderType' => 'inputDateTime',
				'size' => 13,
                'behaviour' => array(
                    'allowLanguageSynchronization' => true ,
                ) ,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_tag.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
        'tag_category' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_tag.tag_category',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'items' => [
                    ['LLL:EXT:jv_events/Resources/Private/Language/locallang_db.xlf:tx_jvevents_domain_model_tag.all_categories', -1],
                    ['-------', '--div--'],
                ],
                'foreign_table' => 'tx_jvevents_domain_model_category',

                // 'foreign_table_where' => ' AND tx_jvevents_domain_model_category.type = 0 AND tx_jvevents_domain_model_category.sys_language_uid in (-1, 0)',
                'foreign_table_where' => ' AND tx_jvevents_domain_model_category.type = 0 AND (tx_jvevents_domain_model_category.sys_language_uid = 0 OR tx_jvevents_domain_model_category.l10n_parent = 0) ORDER BY tx_jvevents_domain_model_category.title',
                'itemsProcFunc' => 'JVE\\JvEvents\\UserFunc\\Flexforms->TranslateMMvalues' ,

                'MM' => 'tx_jvevents_tag_category_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'exclusiveKeys' => '-1,-2',
                'enableMultiSelectFilterTextfield' => true ,

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
		
	),
);
