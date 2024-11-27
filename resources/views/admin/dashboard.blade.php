@extends('admin.app')

@section('content')
    <div class="content-wrapper">
        <!-- Upper Statistics Section (Unchanged) -->
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                    Expenses
                                </p>
                                @if ($expensesCount == 0)
                                    <h2 class="no-records">No records found</h2>
                                @else
                                    <h2>{{ formatNumberWithCurrencyExtension($totalExpensesAmount) }}</h2>
                                    <label class="badge badge-outline-danger badge-pill">{{ $expensesCount }}</label>
                                @endif
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-check-circle mr-2"></i>
                                    Purchase
                                </p>
                                @if ($purchasesCount == 0)
                                    <h2 class="no-records">No records found</h2>
                                @else
                                    <h2>{{ formatNumberWithCurrencyExtension($totalPurchasesAmount) }}</h2>
                                    <label class="badge badge-outline-success badge-pill">{{ $purchasesCount }}</label>
                                @endif
                            </div>
                            <div class="statistics-item">
                                <p>
                                    <i class="icon-sm fas fa-chart-line mr-2"></i>
                                    Sales
                                </p>
                                @if ($salesCount == 0)
                                    <h2 class="no-records">No records found</h2>
                                @else
                                    <h2>{{ formatNumberWithCurrencyExtension($totalSalesAmount) }}</h2>
                                    <label class="badge badge-outline-success badge-pill">{{ $salesCount }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Combined Chart for Sales, Purchase, and Expenses -->
        <div class="row">
            <div class="col-12">
                <div class="chart-container">
                    <h3>Sales, Purchase, and Expense Amounts Over Time</h3>
                    @php
                        $combinedChartData = [
                            'labels' => $commonDatesFormatted, // using common dates for all charts
                            'datasets' => [
                                [
                                    'label' => 'Sales Amount',
                                    'data' => $salesDataFilled,  // Filled data for sales
                                    'borderColor' => 'rgba(0, 255, 0, 1)', // Green color for sales
                                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                                    'fill' => true,
                                ],
                                [
                                    'label' => 'Purchase Amount',
                                    'data' => $purchaseDataFilled,  // Filled data for purchases
                                    'borderColor' => 'rgba(54, 162, 235, 1)',
                                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                                    'fill' => true,
                                ],
                                [
                                    'label' => 'Expense Amount',
                                    'data' => $expenseDataFilled,  // Filled data for expenses
                                    'borderColor' => 'rgba(255, 99, 132, 1)',
                                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                                    'fill' => true,
                                ]
                            ]
                        ];
                    @endphp
                    <div style="height: 800px">
                        @include('components.purchase-chart', [
                            'id' => 'combinedLineGraph',
                            'data' => $combinedChartData,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .card-body {
        padding: 20px;
    }

    .statistics-item {
        text-align: center;
        padding: 10px;
    }

    .statistics-item p {
        font-size: 1rem;
        font-weight: 600;
    }

    .statistics-item h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 10px;
    }

    .statistics-item .badge {
        font-size: 0.9rem;
        margin-top: 10px;
    }


    .no-records {
        text-align: center;
        font-size: 1.2rem;
        color: white;
        margin-top: 20px;
    }

    .no-records2 {
        text-align: center;
        font-size: 1.2rem;
        color: black;
        margin-top: 20px;
    }

    .chart-container div {
        height: auto;
    }

    @media (max-width: 768px) {
        .statistics-item {
            margin-bottom: 15px;
        }

        .statistics-item h2 {
            font-size: 1.2rem;
        }
    }
</style>
