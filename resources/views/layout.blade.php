<html lang="ru">
<head>
    <link rel="stylesheet" href="/css/style.css?<?= filemtime($_SERVER["DOCUMENT_ROOT"] . "/public/css/style.css") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Главная</title>
</head>
<body class="<?= $pageType ?>-page">
<main>
    <header data-aos="fade-down">
        <div class="container">
            <div class="header-wrapper">
                <a href="/" class="logo"><img src="/images/logo.png" alt=""></a>
                <div class="header-actions">
                    <a href="/history/" class="history-link js-tippy" data-tippy-content="История">
                        <i></i>
                    </a>
                    <a href="/favorites/" class="favorite-link js-tippy" data-tippy-content="Избранные">
                        <i></i>
                    </a>
                </div>
                <div class="header-search">
                    <form action="">
                        <input type="text" name="q" autocomplete="off" placeholder="Поиск" value="<?= $_GET["q"] ?? "" ?>">
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <? if (isset($sections)): ?>
        <div class="sections-wrapper" data-aos="fade">
            <? foreach ($sections as $section): ?>
            <a href="<?= $section->getUrl() ?>"><span><?= $section->name ?></span></a>
            <? endforeach; ?>
        </div>
        <? endif ?>
            
        <? if (isset($sort)): ?>    
            <div class="sort-wrapper">
                <div class="sort-title">Сортировка: </div>
                <a class="sort-link<?= request()->get("sort") == "date" || !request()->get("sort") ? " active" : "" ?>" href="<?= request()->fullUrlWithQuery (['sort' => 'date']) ?>">По дате</a>
                <a class="sort-link<?= request()->get("sort") == "popularity" ? " active" : "" ?>" href="<?= request()->fullUrlWithQuery (['sort' => 'popularity']) ?>">По популярности</a>
            </div>
        <? endif; ?>
    </div>
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

