<html lang="ru">
<head>
    <link rel="stylesheet" href="/css/style.css?<?= filemtime($_SERVER["DOCUMENT_ROOT"] . "/public/css/style.css") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Главная</title>
</head>
<body class="<?= $pageType ?>-page">
<main>
    <header>

    </header>

    @yield("content")

</main>
<div class="to-top js-to-top hidden"></div>

<?
$jsFileList = ['commons.chunk'];
if ($pageType) {
    $jsFileList[] = $pageType . ".bundle";
}
foreach ($jsFileList as $jsFilename):
$jsFilePath = "/public/js/bundle/$jsFilename.js";
if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $jsFilePath)) continue;
?><script src="<?= $jsFilePath . '?' . filemtime($_SERVER["DOCUMENT_ROOT"] . $jsFilePath)?>"></script><?
endforeach;
?>
</body>
</html>

