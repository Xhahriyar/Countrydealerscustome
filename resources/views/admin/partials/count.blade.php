<div>
    <span id="val2">{{ $val2 }}</span>
    <span id="val3">{{ $val3 }}</span>
</div>
<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                            {{$label1}}
                        </p>
                        <h2>{{$val1}}</h2>
                        {{-- <label class="badge badge-outline-danger badge-pill">50</label> --}}
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-check-circle mr-2"></i>
                            {{$label2}}
                        </p>
                        <h2 id="h1">{{$val2}}</h2>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-chart-line mr-2"></i>
                            {{$label3}}
                        </p>
                        <h2 id="h2">{{$val3}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
