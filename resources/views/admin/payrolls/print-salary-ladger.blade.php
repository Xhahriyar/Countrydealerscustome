<!doctype html>
<html lang="en">

<head>
    <title>Salary Ladger</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div>
                    <a href="javascript:;" class="btn btn-sm btn-primary" id="print">Print</a>
                </div>
                <div class="logo d-flex justify-content-end">
                    <img src="{{ asset('assets/images/COUNTRY DEALERS LOGO AZ.svg') }}" alt="Logo Image" height="50px">
                </div>
                <div class="col-md-12">
                    <div class="text-center lh-1 mb-4">
                        <h6 class="fw-bold">Payslip</h6> <span class="fw-normal">Payment slip of all time</span>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">EMP Name</span> <small
                                            class="ms-3">{{ $data->first_name }} {{ $data->last_name }}</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Department</span> <small
                                            class="ms-3">{{ $data->department }}</small> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Ac No.</span> <small
                                            class="ms-3">{{ $data->account_number }}</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Bank</span> <small
                                            class="ms-3">{{ $data->bank_name }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Designation</span> <small class="ms-3">
                                            {{ $data->designation }}
                                        </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Type</span> <small
                                            class="ms-3">{{ $data->employee_type }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="mt-4 table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Net Salary</th>
                                    <th scope="col">Loan Deductions</th>
                                    <th scope="col">Total Loan</th>
                                    <th scope="col">Remaining Loan</th>
                                    <th scope="col">Total Paid Loan</th>
                                    <th scope="col">Month</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Start with the initial loan amount from the first entry
                                    $remainingLoan = $data->first()->loan_amount;
                                    $loanPermotn = $data->first()->loan_return;
                                @endphp
                                @foreach ($data->histories as $history)
                                    <tr>
                                        <td>{{ $history->salary + $history->other_allowance }}.00</td>
                                        <td>{{ $history->loan_return }}.00</td>
                                        <td>{{ $history->loan_amount }}.00</td>

                                        {{-- Calculate and display the remaining loan balance --}}
                                        <td>
                                            @php
                                                // Decrease the remaining loan balance by the loan return amount for the current month
                                                $remainingLoan -= $history->loan_return;
                                            @endphp
                                            {{ $remainingLoan }}.00

                                        </td>
                                        <td>
                                            {{ $loanPermotn }}.00
                                            @php
                                                $loanPermotn += $history->loan_return;
                                            @endphp

                                        </td>

                                        <td>{{ Carbon\Carbon::parse($history->created_at)->format('M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="d-flex flex-column mt-2"> <span class="fw-bolder">Country Dealers</span> </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        let printButton = document.getElementById('print');
        printButton.addEventListener('click', function() {
            printButton.style.display = 'none';
            window.print(); // Opens the print dialog
            window.location.reload(); // Refreshes the page
        });
    </script>
</body>

</html>
