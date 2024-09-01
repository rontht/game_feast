<div id="add-form">
    <h1 id="add-title">Add a new Game</h1>
    <form method="post" action="{{url("add_game_action")}}">
        {{csrf_field()}}
        <div id="add-input-container">
            <label>Name</label>
            <input id="add-input" type="text" name="name" required>
        </div>
        <div id="add-input-container">
            <label>Developer</label>
            <input id="add-input" type="text" name="dev" required>
        </div>
        <div id="add-input-container">
            <label>Release Date</label>
            <input id="add-input" type="date" name="release_date" required>
        </div>
        <div id="add-input-container">
            <label>Tags</label>
            <input id="add-input" type="text" name="tag" required>
        </div>
        <div id="add-input-container">
            <label>Price</label>
            <input id="add-input" type="text" name="price">
        </div>
        <div id="add-input-container">
            <label>Description</label>
            <textarea id="add-textarea" type="text" name="about"></textarea>
        </div>
        <input id="add-button" type="submit" value="ADD">
    </form>
</div>