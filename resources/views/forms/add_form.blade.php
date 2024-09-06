<aside id="add-form" style="overflow-hidden">
    <div class="sidebar-item">
        <form method="post" action="{{url("add_dev_action")}}">
            {{csrf_field()}}
            <a href="$" class="sidebar-form has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#dev-form"
                aria-expanded="false" aria-controls="dev-form" id="add-form-link">
                <i class="lni lni-code" id="add-form-icon"></i>
                <spam id="sidebar-form-span">
                    Add a new Developer
                </spam>
            </a>
            <ul id="dev-form" class="sidebar-dropdown list-unstyled collapse m-0" data-bs-parent="#add-form">
                <li class="sidebar-item p-3" id="add-form-dropdown">
                    <div class="p-1" id="add-input-container">
                        <label>Developer Name <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="text" name="dev_name" value="{{ old('dev_name') }}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" rows="8" name="dev_about">{{ old('dev_about') }}</textarea>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <input id="add-button" type="submit" value="Add Developer">
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class="sidebar-item" style="overflow-hidden">
        <form method="post" action="{{url("add_game_action")}}">
            {{csrf_field()}}
            <a href="$" class="sidebar-form has-dropdown collapsed" data-bs-toggle="collapse"
                data-bs-target="#game-form" aria-expanded="false" aria-controls="game-form" id="add-form-link">
                <i class="lni lni-game" id="add-form-icon"></i>
                <spam id="sidebar-form-span">
                    Add a new Game
                </spam>
            </a>
            <ul id="game-form" class="sidebar-dropdown show list-unstyled collapse m-0" data-bs-parent="#add-form">
                <li class="sidebar-item p-3" id="add-form-dropdown">
                    <div class="p-1" id="add-input-container">
                        @if (Session::get('name'))
                            <label>Hello, {{Session::get('name')}}.</label>
                            <input class="form-control-plaintext" id="add-input" type="text" name="game_username"
                                value="{{Session::get('name')}}" hidden>
                        @else
                            <label>Username <span id="required">(Required)</span></label>
                            <input class="form-control" id="add-input" type="text" name="game_username" value="{{ old('game_username') }}">
                        @endif
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Game Name <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="text" name="game_name" value="{{ old('game_name') }}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Developer</label>
                        <select aria-label="Developer Choices" name="game_dev_id" id="dev-select" class="form-control"
                            onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <option selected value="1" id="dev-options">Select one developer.</option>
                            @foreach ($devs as $dev)
                                <option value="{{$dev->id}}" id="dev-options">{{$dev->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Release Date <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="date" name="game_release_date" value="{{ old('game_release_date') }}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Tags <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="text" name="game_tag" value="{{ old('game_tag') }}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Price in AUD</label>
                        <input class="form-control" type="text" id="price-input" min="0" step="0.01" data-bind="value:price-input"
                            name="game_price" value="{{ old('game_price') }}" />
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" rows="3" name="game_about">{{ old('game_about') }}</textarea>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <input id="add-button" type="submit" value="Add Game">
                    </div>
                </li>
            </ul>
        </form>
    </div>
</aside>