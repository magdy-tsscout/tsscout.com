<div class="card mb-3 rounded-0">
    <div class="card-body">
        <div class="row">
            @foreach ( $result as $k=>$v)
                <div class="col-lg-4 mb-1">
                    <span class="text-muted">{{ $k }}: </span>
                    <span class="text-primary">{{ $v }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
