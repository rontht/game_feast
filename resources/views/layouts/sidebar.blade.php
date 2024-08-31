<aside id="sidebar">
    <!-- GameFeast Logo and Label -->
    <div class="d-flex">
        <button id="sidebar-icon" type="button">
            <i class="lni lni-mushroom"></i>
        </button>
        <div class="sidebar-logo">
            <a href="{{url("/")}}">GameFeast</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <!-- HOME PAGE -->
        <li class="sidebar-item">
            <a href="{{url("/")}}" class="sidebar-link">
                <i class="lni lni-home"></i>
                <span id="sidebar-link-span">Home</span>
            </a>
        </li>

        <!-- GAMEs PAGE -->
        <li class="sidebar-item">
            <a href="{{url("game")}}" class="sidebar-link">
                <i class="lni lni-game"></i>
                <span id="sidebar-link-span">Games</span>
            </a>
        </li>

        <!-- DEVs PAGE -->
        <li class="sidebar-item">
            <a href="{{url("dev")}}" class="sidebar-link">
                <i class="lni lni-code"></i>
                <span id="sidebar-link-span">Developers</span>
            </a>
        </li>

        <!-- DROPDOWN for GAME PLATFORM -->
        <li class="siderbar-item">
            <a href="$" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                data-bs-target="#platforms" aria-expanded="false" aria-controls="platforms">
                <i class="lni lni-play"></i>
                <spam id="sidebar-link-span">Platforms</spam>
            </a>
            <ul id="platforms" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item" id="platforms-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-display"></i>
                        <span id="sidebar-link-span">Computer</span>
                    </a>
                </li>
                <li class="sidebar-item" id="platforms-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-playstation"></i>
                        <span id="sidebar-link-span">Playstation 5</span>
                    </a>
                </li>
                <li class="sidebar-item" id="platforms-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-xbox"></i>
                        <span id="sidebar-link-span">Xbox One</span>
                    </a>
                </li>
                <li class="sidebar-item" id="platforms-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-more-alt"></i>
                        <span id="sidebar-link-span">more</span>
                    </a>
                </li>
            </ul>
        </li>

        <!--  -->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span id="sidebar-link-span">Settings</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span id="sidebar-link-span">Logout</span>
        </a>
    </div>
</aside>