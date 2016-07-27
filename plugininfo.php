<?php

$pluginInfo = [
    [
        'FieldName' => 'PluginTitle',
        'Label' => 'Plugin Title',
        'Description' => 'The name of the folder and the class. Use camelCase ("myPlugin"). Also used as folder name.',
        'Default' => c('creator.default.PluginName', 'myPlugin'),
        'Required' => true,
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'Name',
        'Label' => 'Name',
        'Description' => 'The name how it should be displayed in the plugins list.',
        'Default' => c('creator.default.Name', 'My New Plugin'),
        'Required' => true,
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'Description',
        'Label' => 'Description',
        'Description' => 'Short description of what can be done with this plugin.',
        'Default' => c('creator.default.Description', ''),
        'Required' => true,
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'Version',
        'Label' => 'Version',
        'Description' => '',
        'Default' => c('creator.default.Version', '0.1'),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'RequiredApplications',
        'Label' => 'RequiredApplications',
        'Description' => 'Which applications (Vanilla, Messages, YAGA etc.) are requirements.',
        'Default' => c('creator.default.RequiredApplications', "['Vanilla' => '>=2.2']"),
        'Type' => 'Array'
    ],
    [
        'FieldName' => 'RequiredPlugins',
        'Label' => 'RequiredPlugins',
        'Description' => 'Array of required plugins (if any).',
        'Default' => c('creator.default.RequiredPlugins', ''),
        'Type' => 'Array'
    ],
    [
        'FieldName' => 'RequiredTheme',
        'Label' => 'RequiredTheme',
        'Description' => 'Name of a required theme.',
        'Default' => c('creator.default.RequiredTheme', ''),
        'Type' => 'Text'        
    ],
    [
        'FieldName' => 'RegisterPermissions',
        'Label' => 'RegisterPermissions',
        'Description' => 'Custom permissions. Please try to stick to the form "PluginName.Subject.Action" where action should be one of Add, Delete, Edit, View, Allow, Manage since this are the most common used permissions.',
        'Default' => c('creator.default.RegisterPermissions', "['myPlugin.Settings.Manage']"),
        'Type' => 'Array'
    ],
    [
        'FieldName' => 'SettingsUrl',
        'Label' => 'SettingsUrl',
        'Description' => 'If this is set, the given address will be accessible with the button "Settings" in the plugins list.',
        'Default' => c('creator.default.SettingsUrl', '/settings/myplugin'),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'SettingsPermission',
        'Label' => 'SettingsPermission',
        'Description' => 'This is not used, but it is convention to state the needed permissions here.',
        'Default' => c('creator.default.SettingsPermission', "['Garden.Settings.Manage']"),
        'Type' => 'Array'
    ],
    [
        'FieldName' => 'MobileFriendly',
        'Label' => 'MobileFriendly',
        'Description' => 'You can prevent that your plugin shows up in mobile view by setting this to "false". Since default behavior will change, you should always include this info.',
        'Default' => c('creator.default.MobileFriendly', 'true'),
        'Type' => 'Boolean'
    ],
    [
        'FieldName' => 'HasLocale',
        'Label' => 'HasLocale',
        'Description' => 'If you made your plugin translatable, you should set this to "true".',
        'Default' => c('creator.default.HasLocale', 'true'),
        'Type' => 'Boolean'
    ],
    [
        'FieldName' => 'Url',
        'Label' => 'Url',
        'Description' => 'You can link to an external page which offers more info (if you have one).',
        'Default' => c('creator.default.Url', ''),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'Author',
        'Label' => 'Author',
        'Description' => 'Your Name.',
        'Default' => c('creator.default.Author', ''),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'AuthorUrl',
        'Label' => 'AuthorUrl',
        'Description' => 'A link to your private web page.',
        'Default' => c('creator.default.AuthorUrl', ''),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'AuthorEmail',
        'Label' => 'AuthorEmail',
        'Description' => 'You can add your mail address here.',
        'Default' => c('creator.default.AuthorEmail', ''),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'License',
        'Label' => 'License',
        'Description' => 'Adding a license is recommended if you publish your plugin.',
        'Default' => c('creator.default.License', 'MIT'),
        'Type' => 'Text'
    ],
    [
        'FieldName' => 'SocialConnect',
        'Label' => 'SocialConnect',
        'Description' => 'Flag if this plugin is used for external authentication.',
        'Default' => c('creator.default.SocialConnect', 'false'),
        'Type' => 'Boolean'
    ],
    [
        'FieldName' => 'Hidden',
        'Label' => 'Hidden',
        'Description' => 'Setting this to "true" would hide the plugin to appear in the plugins list. Mostly used for social connect plugins.',
        'Default' => c('creator.default.Hidden', 'false'),
        'Type' => 'Boolean'
    ],
    [
        'FieldName' => 'RequiresRegistration',
        'Label' => 'RequiresRegistration',
        'Description' => 'Flag which has to be set to true if there the forum owner needs to register an app before using the plugin.',
        'Default' => c('creator.default.RequiresRegistration', 'false'),
        'Type' => 'Boolean'
    ]
];

$pluginInfo = [
    'PluginTitle' => [
        'Label' => 'Plugin Title',
        'Description' => 'The name of the folder and the class. Use camelCase ("myPlugin"). Also used as folder name.',
        'Default' => c('creator.default.PluginName', 'myPlugin'),
        'Required' => true,
        'Type' => 'Text'
    ],
    'Name' => [
        'Label' => 'Name',
        'Description' => 'The name how it should be displayed in the plugins list.',
        'Default' => c('creator.default.Name', 'My New Plugin'),
        'Required' => true,
        'Type' => 'Text'
    ],
    'Description' => [
        'Label' => 'Description',
        'Description' => 'Short description of what can be done with this plugin.',
        'Default' => c('creator.default.Description', ''),
        'Required' => true,
        'Type' => 'Text'
    ],
    'Version' => [
        'Label' => 'Version',
        'Description' => '',
        'Default' => c('creator.default.Version', '0.1'),
        'Type' => 'Text'
    ],
    'RequiredApplications' => [
        'Label' => 'RequiredApplications',
        'Description' => 'Which applications (Vanilla, Messages, YAGA etc.) are requirements.',
        'Default' => c('creator.default.RequiredApplications', "['Vanilla' => '>=2.2']"),
        'Type' => 'Array'
    ],
    'RequiredPlugins' => [
        'Label' => 'RequiredPlugins',
        'Description' => 'Array of required plugins (if any).',
        'Default' => c('creator.default.RequiredPlugins', ''),
        'Type' => 'Array'
    ],
    'RequiredTheme' => [
        'Label' => 'RequiredTheme',
        'Description' => 'Name of a required theme.',
        'Default' => c('creator.default.RequiredTheme', ''),
        'Type' => 'Text'
    ],
    'RegisterPermissions' => [
        'Label' => 'RegisterPermissions',
        'Description' => 'Custom permissions. Please try to stick to the form "PluginName.Subject.Action" where action should be one of Add, Delete, Edit, View, Allow, Manage since this are the most common used permissions.',
        'Default' => c('creator.default.RegisterPermissions', "['myPlugin.Settings.Manage']"),
        'Type' => 'Array'
    ],
    'SettingsUrl' => [
        'Label' => 'SettingsUrl',
        'Description' => 'If this is set, the given address will be accessible with the button "Settings" in the plugins list.',
        'Default' => c('creator.default.SettingsUrl', '/settings/myplugin'),
        'Type' => 'Text'
    ],
    'SettingsPermission' => [
        'Label' => 'SettingsPermission',
        'Description' => 'This is not used, but it is convention to state the needed permissions here.',
        'Default' => c('creator.default.SettingsPermission', "['Garden.Settings.Manage']"),
        'Type' => 'Array'
    ],
    'MobileFriendly' => [
        'Label' => 'MobileFriendly',
        'Description' => 'You can prevent that your plugin shows up in mobile view by setting this to "false". Since default behavior will change, you should always include this info.',
        'Default' => c('creator.default.MobileFriendly', 'true'),
        'Type' => 'Boolean'
    ],
    'HasLocale' => [
        'Label' => 'HasLocale',
        'Description' => 'If you made your plugin translatable, you should set this to "true".',
        'Default' => c('creator.default.HasLocale', 'true'),
        'Type' => 'Boolean'
    ],
    'Url' => [
        'Label' => 'Url',
        'Description' => 'You can link to an external page which offers more info (if you have one).',
        'Default' => c('creator.default.Url', ''),
        'Type' => 'Text'
    ],
    'Author' => [
        'Label' => 'Author',
        'Description' => 'Your Name.',
        'Default' => c('creator.default.Author', ''),
        'Type' => 'Text'
    ],
    'AuthorUrl' => [
        'Label' => 'AuthorUrl',
        'Description' => 'A link to your private web page.',
        'Default' => c('creator.default.AuthorUrl', ''),
        'Type' => 'Text'
    ],
    'AuthorEmail' => [
        'Label' => 'AuthorEmail',
        'Description' => 'You can add your mail address here.',
        'Default' => c('creator.default.AuthorEmail', ''),
        'Type' => 'Text'
    ],
    'License' => [
        'Label' => 'License',
        'Description' => 'Adding a license is recommended if you publish your plugin.',
        'Default' => c('creator.default.License', 'MIT'),
        'Type' => 'Text'
    ],
    'SocialConnect' => [
        'Label' => 'SocialConnect',
        'Description' => 'Flag if this plugin is used for external authentication.',
        'Default' => c('creator.default.SocialConnect', 'false'),
        'Type' => 'Boolean'
    ],
    'Hidden' => [
        'Label' => 'Hidden',
        'Description' => 'Setting this to "true" would hide the plugin to appear in the plugins list. Mostly used for social connect plugins.',
        'Default' => c('creator.default.Hidden', 'false'),
        'Type' => 'Boolean'
    ],
    'RequiresRegistration' => [
        'Label' => 'RequiresRegistration',
        'Description' => 'Flag which has to be set to true if there the forum owner needs to register an app before using the plugin.',
        'Default' => c('creator.default.RequiresRegistration', 'false'),
        'Type' => 'Boolean'
    ]
];
