@extends("layout")
@section("content")
    <form class="js-form-parse" action="/">
        <label>
            <select name="id" id="">
                <option value="1">Game-game</option>
            </select>
        </label>
        <label>
            <span>Со страницы</span>
            <input type="text" class="js-from" name="from">
        </label>
        <label>
            <span>По страницу</span>
            <input type="text" class="js-to" name="to">
        </label>
        <button class="js-submit">Parse it!</button>
    </form>
    <div class="js-info"></div>
@endsection
