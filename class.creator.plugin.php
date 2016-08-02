<?php

$PluginInfo['creator'] = [
    'Name' => 'Creator',
    'Description' => 'Allows building plugin skeletons.',
    'Version' => '0.1',
    'HasLocale' => false,
    'Author' => 'Robin Jurinka',
    'AuthorUrl' => 'http://vanillaforums.org/profile/r_j',
    'RequiredApplications' => ['Vanilla' => '>=2.2'],
    'MobileFriendly' => true,
    'License' => 'MIT'
];

class CreatorPlugin extends Gdn_Plugin {
    /**
     * Add Link to plugin to Addons section.
     *
     * @param gardenController $sender Instance of the calling class.
     * @return void.
     */
    public function base_getAppSettingsMenuItems_handler($sender) {
        $menu = &$sender->EventArguments['SideMenu'];
        $menu->addLink(
            'Add-ons',
            t('Plugin Creator'),
            'plugin/creator',
            'Garden.Settings.Manage'
        );
    }

    /**
     * Built plugin creator form.
     *
     * @param pluginController $sender Instance of the calling object.
     * @return void.
     */
    public function pluginController_creator_create($sender) {
        // Check for legitimation.
        $sender->permission('Garden.Settings.Manage');

        $sender->addSideMenu('plugin/creator');
        $sender->Form = new Gdn_Form();
        $sender->addCssFile('creator.css', 'plugins/creator');
        $sender->setData('Title', t('Plugin Creator'));

        // Include external resources (header & snippets info).
        include __DIR__.'/plugininfo.php';
        $sender->setData('PluginInfo', $pluginInfo);
        $snippets = [];
        foreach (glob(__DIR__.'/snippets/*.php') as $snippet) {
            include $snippet;
        }
        $sender->setData('Snippets', $snippets);
        // Ensure snippets have a unique name in the form.
        $duplicateNames = array_intersect(
            array_keys($snippets),
            array_keys($pluginInfo)
        );
        if (count($duplicateNames) > 0) {
            // Ugly, ugly, ugly...
            decho('Snippets are not allowed to have the same name as PluginInfo keys!');
            decho($duplicateNames);
            die;
        }

        if ($sender->Form->authenticatedPostBack() !== false) {
            $formValues = $sender->Form->formValues();

            // Check for errors in plugin info fieldset.
            $errors = $this->pluginInfoValidation($formValues, $pluginInfo);
            $sender->Form->setValidationResults($errors);

            // Add required snippets and required PluginInfo entries.
            $formValues = $this->dissolveSnippetRequirements($formValues, $snippets);

            // Only proceed if there were no validation errors.
            if ($errors == []) {
                $pluginCode = $this->getSourceCode(
                    $formValues,
                    $pluginInfo,
                    $snippets
                );

                $filename = 'class.'.strtolower($formValues['PluginTitle']).'.plugin.php';
                /*
                $path = __DIR__.'../'.$formValues['PluginTitle'];
                if (!mkdir($path, '0775')) {
                    $sender->informMessage('Directory could not be created!');
                }
                if (!file_put_contents($path.'/'.$filename)) {
                    $sender->informMessage('Plugin could not be saved!');
                    */
                    header('Content-Length: '.strlen($pluginCode));
                    header('Content-type: application/octet-stream');
                    header('Content-Disposition: attachment; filename='.$filename);
                    echo $pluginCode;
                    exit;
                    /*
                }
                $sender->informMessage('Your plugin has been saved to '.$path.'/'.$filename);
                */
            }
        } else {
            // Set Default values.
            foreach ($pluginInfo as $name => $info) {
                if ($info['Default'] != '') {
                    $sender->Form->setValue($name, $info['Default']);
                }
            }
        }

        $sender->render('creator', '', 'plugins/creator');
    }

    /**
     * Validate form fields based on the pluginInfo (only validates "Required").
     *
     * @param array $formValues The posted form values.
     * @param array $pluginInfo The valid plugin info array keys.
     * @return array Error messages.
     */
    private function pluginInfoValidation($formValues, $pluginInfo) {
        $result = [];
        // Do validations for PluginInfo fields.
        foreach ($pluginInfo as $name => $info) {
            if (
                val('Required', $info, false) === true &&
                val($name, $formValues, '') == ''
            ) {
                $result[$name][] = 'Please fill "'.$info['Label'].'"';
            }
        }
        return $result;
    }

    /**
     * Dissolve all snippet requirements.
     *
     * @param array $formValues Posted form values.
     * @param array $snippets Code snippets.
     * @return array FormValues with required snippets added.
     */
    private function dissolveSnippetRequirements($formValues = [], $snippets = []) {
        // Add additionally needed snippets.
        foreach ($snippets as $snippetName => $snippetContent) {
            $requiredSnippets = val('RequiredSnippet', $snippetContent, []);
            foreach ($requiredSnippets as $requiredSnippet) {
                $formValues[$requiredSnippet] = true;
            }
        }

        // Add additionally needed plugin information fields.
        foreach ($snippets as $snippetName => $snippetContent) {
            // Don't proceed for unused snippets.
            if ($formValues[$snippetName] == false) {
                continue;
            }
            // Loop through required fields and
            // a) add them if they do not exist yet or
            // b) overwrite them if they exist or
            // c) attach them if they are arrays
            foreach ($snippetContent['RequiredPluginInfo'] as $key => $default) {
                if (!isset($formValues[$key]) || !is_array($default)) {
                    $formValues[$key] = $default;
                } else {
                    $formValues[$key] = array_merge($formValues[$key], $default);
                }
            }
        }

        return $formValues;
    }

    /**
     * Build plugin skeleton from form values.
     *
     * @param array $formValues The posted from values.
     * @param array $pluginInfo The possible plugin info array keys.
     * @param array $snippets The code snippets.
     * @return string The code of the plugin.
     */
    private function getSourceCode($formValues, $pluginInfo, $snippets) {
        $pluginTitle = $formValues['PluginTitle'];
        $className = ucfirst($pluginTitle);
        $fileName = 'class.'.strtolower($pluginTitle).'.plugin.php';
        unset($pluginInfo['PluginTitle']);

        // Built PluginInfo array.
        $pluginInfoArray = '';
        foreach ($pluginInfo as $name => $info) {
            // Only proceed for fields with values.
            if ($formValues[$name] == '') {
                continue;
            }
            if ($info['Type'] === 'Text') {
                $pluginInfoArray .= sprintf(
                    "    '%s' => '%s',\n",
                    $name,
                    addslashes($formValues[$name])
                );
            } else {
                $pluginInfoArray .= sprintf(
                    "    '%s' => %s,\n",
                    $name,
                    $formValues[$name]
                );
            }
        }
        $pluginInfoArray = rtrim($pluginInfoArray);
        $pluginInfoArray = rtrim($pluginInfoArray, ',');

        $pluginInfo = $formValues;
        $snippets = [];
        foreach (glob(__DIR__.'/snippets/*.php') as $snippet) {
            include $snippet;
        }
        $methodArray = [];
        $methods = '';

        foreach ($snippets as $snippetName => $snippet) {
            // Only proceed for required used snippets.
            if ($formValues[$snippetName] != true) {
                continue;
            }
            foreach ($snippet['Content'] as $method) {
                $methodArray[$method['Method']][] = $method['Code'];
            }
        }
        foreach ($methodArray as $method => $code) {
            $methods .= "    {$method} {";
            $methods .= str_replace(
                "\n",
                "\n        ",
                implode("\n", $code)
            );
            $methods = rtrim($methods)."\n    }\n";
        }

        $result = <<<EOS
<?php

\$PluginInfo['{$pluginTitle}'] = [
{$pluginInfoArray}
];

class {$className}Plugin extends Gdn_Plugin {
{$methods}
}

EOS;
        return $result;
    }
}
