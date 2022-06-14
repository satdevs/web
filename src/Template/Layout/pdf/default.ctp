<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('pdf.css', ['fullBase' => true]) ?>
</head>
<body>
    <div id="container">
        <div id="content">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</body>
</html>