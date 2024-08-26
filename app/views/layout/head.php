<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>

    <!-- Conditional Page-Specific Scripts -->
    <?php if (isset($scripts) && !empty($scripts)): ?>
        <?php foreach ($scripts as $script): ?>
            <script src="<?= htmlspecialchars($script) ?>" defer></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Conditional Page-Specific Styles -->
    <?php if (isset($styles) && !empty($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= htmlspecialchars($style) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
