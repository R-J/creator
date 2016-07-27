<?php defined('APPLICATION') or die ?>
<h1><?= $this->data('Title') ?></h1>
<?= $this->Form->open(), $this->Form->errors(); ?>
<fieldset>
<legend class="H">Plugin Info</legend>
<table>
    <?php foreach ($this->data('PluginInfo') as $name => $info): ?>
    <tr>
        <td class="CreatorLabel">
            <?= $info['Label'] ?><span class="HoverHelp">[?]
                <div class="Help"><?= $info['Description'] ?></div>
            </span>
        </td>
        <td class="CreatorField">
        <?php if (isset($info['Type']) && $info['Type'] === 'Boolean'): ?>
            <?= $this->Form->dropDown($name, ['true' => 'true', 'false' => 'false'], ['IncludeNull' => true, 'placeholder' => $info['Default']])  ?>
        <?php else: ?>
            <?= $this->Form->textBox($name, ['class' => 'InputBox WideInput', 'placeholder' => $info['Default']]) ?>
        <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</fieldset>




<fieldset>
<legend class="H">Snippets</legend>
<ul>
<?php foreach ($this->data('Snippets') as $index => $snippet): ?>
    <li>
        <?= $this->Form->checkBox($index, $snippet['ShortDescription']); ?>
        <span class="HoverHelp">
            [?]
            <div class="Help"><?= $snippet['Help'] ?></div>
        </span>
    </li>
<?php endforeach ?>
</ul>
</fieldset>

<?= $this->Form->close('Create!') ?>