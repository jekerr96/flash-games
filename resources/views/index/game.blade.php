@extends("layout")
@section("content")
    <div class="container">
        <div class="game-title">
            <h1><?= $game->name ?></h1>
            <i class="add-to-favorite js-tippy js-favorite<?= $favorite ? " active" : "" ?>" data-tippy-content="<?= $favorite ? "Удалить из закладок" : "Добавить в закладки" ?>" data-id="<?= $game->id ?>"></i>
        </div>
        <div class="game-container">
            <?= $game->html ?>
        </div>
        <div class="game-description">
            <?= $game->description ?>
        </div>
        <div class="tags-wrapper">
            <? foreach ($game->genres as $genre): ?>
                <a href="<?= $genre->getUrl() ?>"><?= $genre->name ?></a>
            <? endforeach; ?>
        </div>
        <div class="comment-wrapper">
            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
            <script type="text/javascript">
                VK.init({apiId: 7238015, onlyWidgets: true});
            </script>
            <div id="vk_comments"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
            </script>
        </div>
    </div>

@endsection
