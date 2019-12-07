@extends("layout")
@section("content")
<? foreach ($items as $item): ?>
<div>
    <a href="/game/<?= $item->id ?>">
        <img src="<?= $item->image ?>" alt="">
        <span><?= $item->name ?></span>
    </a>
    <div>
        <?= $item->genres->implode("name", " / ") ?>
    </div>
</div>

    <? endforeach ?>
{{ $items->links() }}
@endsection
