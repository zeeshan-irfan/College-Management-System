<div class="container text-center py-3">
    <div
        id="admissionNotification"
        class="card border-0 text-center rounded p-4 p-lg-6"
    >
        <div class="card-body mb-3 mb-lg-4">
            <div class="col-xl-11 col-xxl-9 mx-auto">
                <p class="text-white fw-bold text-uppercase mb-4">Admissions Notification</p>
                <h3 class="text-white fw-bold display-6">{!! $message !!}</h3>
            </div>
        </div>
        <a
            class="btn btn-warning btn-lg mx-auto d-inline-block text-dark fw-bold"
            href="{{ route($route) }}"
            role="button"
            aria-label="Admission Details">{{ $button }}
        </a>
    </div>
</div>
