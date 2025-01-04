<form id="{{ $id }}"
      action="{{ route($route, $routeid ?? null) }}"
      method="POST"
      enctype="multipart/form-data">

    @method($method)
    @csrf

    <div class="container my-3 p-3 bg-light rounded-3 shadow">
        <div class="row">
            <div class="col-12 mb-4">
                <h5 class="mb-0 text-primary-emphasis">{{ $heading }}</h5>
                <small class="text-secondary">{{ $subheading }}</small>
            </div>

            {{ $slot }}

            <div class="col-12 order-4 order-sm-4">
                <button id="actionButton" type="submit" class="btn btn-dark px-4">{{ $button }}</button>
            </div>
        </div>
    </div>
</form>
