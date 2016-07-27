<?php

$snippets['DatabaseChanges'] = [
    'ShortDescription' => 'This plugin creates a new table or adds a new column to an existing table.',
    'Help' => 'Look at the structure.php files that come with Vanilla for examples or see Gdn_DatabaseStructure->column() for more information on the options when creating columns.
',
    'RequiredSnippet' => [],
    'RequiredPluginInfo' => [],
    'Content' => [
        [
            'Method' => 'public function setup()',
            'Code' => '
// Change db structure.
$this->structure();
            '
        ],
        [
            'Method' => 'public function structure()',
            'Code' => '
// Add a new column to a table "ExistingTable".
Gdn::structure()->table(\'ExistingTable\')
    ->column(\'NewColumn\', \'varchar(32)\', false)
    ->set();

// Create a new table "NewTable".
Gdn::structure()->table(\'NewTable\')
    ->primaryKey(\'NewTableID\')
    ->column(\'NewColumn\', \'int(11)\', false)
    ->set();
            '
        ]
    ]
];
