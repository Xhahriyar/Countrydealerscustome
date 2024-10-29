<!-- resources/views/components/statistics-card.blade.php -->

<div class="col-12">
    <div class="card card-statistics">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="statistics-item">
                    <p>
                        <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                        Expenses
                    </p>
                    <h2>{{ $totalExpensesAmount }}</h2>
                    <label class="badge badge-outline-danger badge-pill">{{ $expensesCount }}</label>
                </div>
                <div class="statistics-item">
                    <p>
                        <i class="icon-sm fas fa-check-circle mr-2"></i>
                        Purchase
                    </p>
                    <h2>{{ $totalPurchasesAmount }}</h2>
                    <label class="badge badge-outline-success badge-pill">{{ $purchasesCount }}</label>
                </div>
                <div class="statistics-item">
                    <p>
                        <i class="icon-sm fas fa-chart-line mr-2"></i>
                        Sales
                    </p>
                    <h2>{{ $totalSalesAmount }}</h2>
                    <label class="badge badge-outline-success badge-pill">{{ $salesCount }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
