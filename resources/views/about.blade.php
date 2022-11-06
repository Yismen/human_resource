@extends(config('human_resource.layout'))

@section('content')
<div class="card">
    <div class="card-body">
        {!! $content !!}
    </div>
</div>
@endsection