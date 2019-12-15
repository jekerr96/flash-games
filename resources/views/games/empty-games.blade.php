@extends("layout")
@section("content")
    <div class="container">
        <div class="list-games">
            <? foreach ($games as $item): ?>
                @include("partials.game-item")
            <? endforeach ?>
            <? if ($games->isEmpty()): ?>
                Таких игр нет
            <? endif; ?>
        </div>
    </div>
@endsection
