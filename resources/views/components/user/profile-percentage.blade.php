@if ($number)
{{$count}}
@else
<div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$count}}" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark" style="width:{{$count}}%">{{$count}}% Completed</div>
</div>
@endif
