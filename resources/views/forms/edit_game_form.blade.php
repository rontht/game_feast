<aside id="edit-game-form">
    <div class="sidebar-item">
        <form class="needs-validation" novalidate method="post" action="{{url("edit_game_action")}}">
            {{csrf_field()}}
            <a href="$" class="sidebar-form has-dropdown collapsed" data-bs-toggle="collapse"
                data-bs-target="#edit-game" aria-expanded="false" aria-controls="edit-game" id="add-form-link">
                <i class="lni lni-game" id="add-form-icon"></i>
                <spam id="sidebar-form-span">
                    Editing {{$game->name}}
                </spam>
            </a>
            <ul id="edit-game" class="sidebar-dropdown show list-unstyled collapse m-0" data-bs-parent="#edit-game-form">
                <!-- Game ID Hidden -->
                <input class="form-control" type="text" name="user_id" hidden value="{{$game->user_id}}">
                <input class="form-control" type="text" name="id" hidden value="{{$game->id}}">
                <li class="sidebar-item p-3" id="add-form-dropdown">
                    <div class="p-1" id="add-input-container">
                        <label>Game Name</label>
                        <input class="form-control" id="add-input" type="text" name="name" required
                            value="{{$game->name}}">
                        <div id="validation-feedback" class="invalid-feedback">Required!</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Developer</label>
                        <select aria-label="Developer Choices" name="dev_id" id="dev-select" class="form-control"
                            onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <option value="1" id="dev-options">Select one developer.</option>
                            @foreach ($devs as $dev)
                                @if ($dev->id == $dev_info->id)
                                    <option selected value="{{$dev->id}}" id="dev-options">{{$dev->name}}</option>
                                @else
                                    <option value="{{$dev->id}}" id="dev-options">{{$dev->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div id="validation-feedback-select" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Release Date</label>
                        <input class="form-control" id="add-input" type="date" name="release_date" required
                            value="{{$game->release_date}}">
                        <div id="validation-feedback" class="invalid-feedback">Required!</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Tags</label>
                        <input class="form-control" id="add-input" type="text" name="tag" required
                            value="{{$game->tag}}">
                        <div id="validation-feedback" class="invalid-feedback">Required!</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Price in AUD</label>
                        <input class="form-control" type="number" id="price-input" min="0" step="0.01"
                            data-bind="value:price-input" name="price" value="{{$game->price}}" />
                        <div id="validation-feedback" class="invalid-feedback">Please enter a valid price.</div>
                        <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text"
                            name="about">{{$game->about}}</textarea>
                    </div>
                    <input id="add-button" type="submit" value="Save Changes">
                </li>
            </ul>
        </form>
    </div>
</aside>