<aside id="edit-game-form">
    <div class="sidebar-item">
        <form method="post" action="{{url("edit_game_action")}}">
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
                <input class="form-control" type="text" name="game_id_edit" hidden value="{{$game->id}}">
                <input class="form-control" type="text" name="game_user_id_edit" hidden value="{{$game->user_id}}">
                <li class="sidebar-item p-2" id="add-form-dropdown">
                    <div class="p-1" id="add-input-container">
                        <label>Game Name <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="text" name="game_name_edit" value="{{$game->name}}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Developer</label>
                        <select aria-label="Developer Choices" name="game_dev_id_edit" id="dev-select" class="form-control"
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
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Release Date <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="date" name="game_release_date_edit" value="{{$game->release_date}}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Tags <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="text" name="game_tag_edit" value="{{$game->tag}}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Price in AUD</label>
                        <input class="form-control" type="text" id="price-input" min="0" step="0.01"
                            data-bind="value:price-input" name="game_price_edit" value="{{$game->price}}" />
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" rows="5" 
                            name="game_about_edit">{{$game->about}}</textarea>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <input id="add-button" type="submit" value="Save Changes">
                    </div>
                </li>
            </ul>
        </form>
    </div>
</aside>