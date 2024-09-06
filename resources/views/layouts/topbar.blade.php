<div id="topbar" class="container overflow-hidden">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col-auto">
                        <h1 id="heading">@yield('heading')</h1>
                    </div>
                    <div class="col" style="font-size: 20px;">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger p-2 m-0" style="height: 50px;">
                                    <div class="row">
                                        <span class="col-auto">{{ $error }}</span>
                                        <div class="col" style="text-align: right;">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col p-0" id="add-button-container">
            <button id="add-menu-button" type="button" onclick="showForm(1)" 
            style="display: flex; justify-content: center; align-items: center;">
            <i class="lni lni-circle-plus" id="plus-logo"></i></button>
        </div>
    </div>
</div>