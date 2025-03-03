<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between"
                    id="count-main-div">
                    @isset($label1)
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                {{ $label1 }}
                            </p>
                            <label class="badge badge-outline-success badge-pill">{{ number_format($val1) }}</label>
                        </div>
                    @endisset
                    @isset($label2)
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-check-circle mr-2"></i>
                                {{ $label2 }}
                            </p>
                            <label class="badge badge-outline-warning badge-pill">{{formatNumberWithCurrencyExtension( $val2) }}</label>
                        </div>
                    @endisset
                    @isset($label3)
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-chart-line mr-2"></i>
                                {{ $label3 }}
                            </p>
                            <label class="badge badge-outline-danger badge-pill count-val3"
                                id="countVal3">{{formatNumberWithCurrencyExtension( $val3) }}</label>
                        </div>
                    @endisset
                    @isset($label3)
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-dollar mr-2"></i>
                                {{ $label4 }}
                            </p>
                            <label class="badge badge-outline-secondary badge-pill count-val3"
                                id="countVal3">{{formatNumberWithCurrencyExtension( $val4) }}</label>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
