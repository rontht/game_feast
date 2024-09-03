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
                    <input class="form-control" type="text" name="id" hidden value="{{$dev->id}}">
                    <div class="p-1" id="add-input-container">
                        <label>Developer Name</label>
                        <input class="form-control" id="add-input" type="text" name="name" required value="{{$dev->name}}">
                    </div>
                    <div class="p-1" id="add-input-container">
                        <label>Description</label>
                        <textarea class="form-control" id="add-textarea" type="text" name="about">{{$dev->about}}</textarea>
                    </div>
                    <input id="add-button" type="submit" value="ADD">
                </li>
            </ul>
        </form>
    </div>
</aside>