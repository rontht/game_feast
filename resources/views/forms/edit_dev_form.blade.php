<aside id="edit-dev-form">
    <div class="sidebar-item">
        <form method="post" action="{{url("edit_dev_action")}}">
            {{csrf_field()}}
            <a href="$" class="sidebar-form has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#edit-dev"
                aria-expanded="false" aria-controls="edit-dev" id="add-form-link">
                <i class="lni lni-code" id="add-form-icon"></i>
                <spam id="sidebar-form-span">
                    Edit info for a Developer
                </spam>
            </a>
            <ul id="edit-dev" class="sidebar-dropdown list-unstyled show collapse m-0" data-bs-parent="#edit-dev-form">
                <li class="sidebar-item p-3" id="add-form-dropdown">
                    <input class="form-control" type="text" name="dev_id_edit" hidden value="{{$dev->id}}">
                    <div class="p-1" id="add-input-container">
                        <label>Developer Name <span id="required">(Required)</span></label>
                        <input class="form-control" id="add-input" type="text" name="dev_name_edit" value="{{$dev->name}}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" rows="8" name="dev_about_edit">{{$dev->about}}</textarea>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <input id="add-button" type="submit" value="Save Changes">
                    </div>
                </li>
            </ul>
        </form>
    </div>
</aside>