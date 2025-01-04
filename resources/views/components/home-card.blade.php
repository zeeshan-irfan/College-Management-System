<!-- Single Card  -->
<div class="col-12 col-md-6 col-lg-4 mb-3">
    <div class="card card-body shadow">
        <div class="d-inline-flex align-items-center" style="min-height:128px">
            <div class="me-2">
                <div class="bg-light text-{{$icolor}} p-3 rounded-circle">
                    <i class="bi bi-{{$icon}} fs-2"></i>
                </div>
            </div>
            <div>
                <span class="fw-bold display-5 mb-5 counter" data-end="{{$count}}">0</span>
                <span>{{$sign}}</span>
                <p class="lead"><b>{{$heading}}</b> {{$subheading}}</p>
            </div>
        </div>
    </div>
</div>
