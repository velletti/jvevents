<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "jv_events"
 *
 * Auto generated by Extension Builder 2016-09-20
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Eventmanagement',
	'description' => 'List and show Events with filters. Including registration',
	'category' => 'plugin',
	'author' => 'Jörg Velletti',
	'author_email' => 'typo3@velletti.de',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '',
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'version' => '9.5.1',
	'constraints' => array(
		'depends' => array(
			'typo3' => '9.5.0-10.4.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
            'static_info_tables' => '6.4.0-6.99.99',
		),
	),
);