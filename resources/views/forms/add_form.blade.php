<aside id="add-form">
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
                        <label>Developer Name</label>
                        <input class="form-control" id="add-input" type="text" name="name" required>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" name="about"></textarea>
                    </div>
                    <input id="add-button" type="submit" value="ADD">
                </li>
            </ul>
        </form>
    </div>
    <div class="sidebar-item">
        <form class="needs-validation" novalidate method="post" action="{{url("add_game_action")}}">
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
                            <input class="form-control-plaintext" id="add-input" type="text" name="username"
                                value="{{Session::get('name')}}" hidden>
                        @else
                            <label>Username</label>
                            <input class="form-control" id="add-input" type="text" name="username" required>
                            <div id="validation-feedback" class="invalid-feedback">Required!</div>
                            <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                        @endif
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Game Name</label>
                        <input class="form-control" id="add-input" type="text" name="name" required>
                        <div id="validation-feedback" class="invalid-feedback">Required!</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Developer</label>
                        <select aria-label="Developer Choices" name="dev_id" id="dev-select" class="form-control"
                            onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <option selected value="1" id="dev-options">Select one developer.</option>
                            @foreach ($devs as $dev)
                                <option value="{{$dev->id}}" id="dev-options">{{$dev->name}}</option>
                            @endforeach
                        </select>
                        <div id="validation-feedback-select" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Release Date</label>
                        <input class="form-control" id="add-input" type="date" name="release_date" required>
                        <div id="validation-feedback" class="invalid-feedback">Required!</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Tags</label>
                        <input class="form-control" id="add-input" type="text" name="tag" required>
                        <div id="validation-feedback" class="invalid-feedback">Required!</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Price in AUD</label>
                        <input class="form-control" type="number" id="price-input" min="0" step="0.01" data-bind="value:price-input"
                            name="price" value="0" />
                        <div id="validation-feedback" class="invalid-feedback">Please enter a valid price.</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" name="about"></textarea>
                    </div>
                    <input id="add-button" type="submit" value="ADD">
                </li>
            </ul>
        </form>
    </div>
</aside>