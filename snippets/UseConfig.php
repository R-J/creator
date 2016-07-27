<?php

$snippets['UseConfig'] = [
    'ShortDescription' => 'This plugin can be configured.',
    'Help' => 'Code will be inserted that initializes config settings and also build a simple setting screen.
',
    'RequiredSnippet' => [],
    'RequiredPluginInfo' => [
        // When PluginInfo key exists more than 1 time and value is no array,
        // the last value will be used.
        'SettingsUrl' => '/settings/'.strtolower($pluginTitle),
        // If value is an array, the plugin will contain all value arrays merged.
        'SettingsPermission' => ['Garden.Settings.Manage']
    ],
    'Content' => [
        [
            'Method' => 'public function setup()',
            'Code' => '
// Prefill config settings with sane values.
touchConfig(\''.$pluginTitle.'.SettingName\', \'value\');
            '
        ],
        [
            'Method' => 'public function onDisable()',
            'Code' => '
// Remove config values to clean up when plugin is disabled.
removeFromConfig(\''.$pluginTitle.'.SettingName\');
            '
        ],
        [
            'Method' => 'public function settingsController_'.$pluginTitle.'_create($sender, $args)',
            'Code' => '
// Ensure there is a permission checked! Usually it would be "Garden.Settings.Manage".
$sender->permission(\''.$pluginInfo['SettingsPermission'].'\');

$sender->addSideMenu(\'dashboard/settings/plugins\');
$sender->setData(\'Title\', t(\''.$pluginInfo['Name'].' Settings\'));


$configurationModule = new ConfigurationModule($sender);
$configurationModule->initialize(
    [
        // Simple input box.
        \''.$pluginTitle.'.SettingName\',

        // Input with some more info added.
        \''.$pluginTitle.'.SettingName\' => [
            \'Default\' => \'Hello World!\',
            \'Options\' => [\'class\' => \'InputBox SmallInput\']
        ],

        // TextArea.
        \''.$pluginTitle.'.SettingName\' => [
            \'Control\' => \'TextBox\',
            \'LabelCode\' => \'Here is a multi line textarea!\',
            \'Description\' => \'Enter some more text here...\',
            \'Options\' => [\'MultiLine\' => true]
        ],

        // DropDown.
        \''.$pluginTitle.'.SettingName\' => [
            \'Control\' => \'DropDown\',
            \'Items\' => [
                \'i1\' => \'One Item\',
                \'i2\' => \'Another one\',
                \'i3\' => \'The Third\'
            ],
            \'LabelCode\' => \'Choose one!\',
            \'Options\' => [\'IncludeNull\' => true] // Show empty line.
        ],

        // Category DropDown.
        \''.$pluginTitle.'.SettingName\' => [
            \'Control\' => \'CategoryDropDown\',
            \'LabelCode\' => "What\'s your favorite category?",
            \'Description\' => \'Besides its content, this is a normal DropDown\',
            \'Options\' => [\'IncludeNull\' => true]
        ],

        // CheckBox.
        \''.$pluginTitle.'.SettingName\' => [
            \'Control\' => \'CheckBox\',
            \'Description\' => \'Choose wise...\',
            \'LabelCode\' => \'This is awesome!\',
            \'Default\' => true
        ],

        // Radio Buttons.
        \''.$pluginTitle.'.SettingName\' => [
            \'Control\' => \'RadioList\',
            \'LabelCode\' => \'Phew...\',
            \'Items\' => [
                \'y\' => \'Yes\',
                \'n\' => \'No\'
            ],
            \'Default\' => \'y\'
        ],

        // Image Upload.
        \''.$pluginTitle.'.SettingName\' => [
            \'Control\' => \'ImageUpload\',
            \'LabelCode\' => \'Upload a test picture if you like\'
        ]
    ]
);
$configurationModule->renderAll();
            '
        ]
    ]
];
