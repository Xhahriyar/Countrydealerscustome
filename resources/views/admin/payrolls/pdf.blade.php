<!doctype html>
<html lang="en">

<head>
    <title>PDF</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        @media print {

            /* Ensure the table fits within the print area */
            table {
                width: 100%;
                table-layout: fixed;
                /* Ensures fixed width for all columns */
                border-collapse: collapse;
                /* Optional: removes gaps between table cells */
            }

            th,
            td {
                word-wrap: break-word;
                /* Makes sure text does not overflow */
                white-space: normal;
                /* Allows wrapping of text within cells */
                padding: 5px;
                /* Optional: adjust padding to fit content */
            }

            /* Optional: Adjust the overall page layout */
            body {
                margin: 0;
                padding: 20px;
            }

            /* Optional: Resize font size for printing */
            body,
            th,
            td {
                font-size: 10px;
                /* Reduce font size to fit content */
            }
        }
    </style>
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
                <div class="text-center lh-1 mb-4">
                    <h6 class="fw-bold">Employees Ladger</h6> <span class="fw-normal">All Employees</span>
                </div>
                <div class="logo d-flex justify-content-end">
                    <img src="{{ asset('assets/images/COUNTRY DEALERS LOGO AZ.svg') }}" alt="Logo Image" height="50px">
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="myTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>CNIC</th>
                                                <th>Employee Type</th>
                                                <th>Loan</th>
                                                <th>Monthly Loan Return</th>
                                                <th>Remaining Loan</th>
                                                <th>Received Loan</th>
                                                <th>Salary</th>
                                                <th>Other Allowances</th>
                                                <th>Net Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $key => $data)
                                                <tr>
                                                    <td>{{ $key += 1 }}</td>
                                                    <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                                                    <td>{{ $data->cnic }}</td>
                                                    <td>{{ $data->employee_type }}</td>
                                                    <td>{{ $data->loan_amount ?? 0 }}</td>
                                                    <td>{{ $data->loan_return ?? 0 }}</td>
                                                    <td>{{ $data->loan_amount > 0 && $data->loan_amount - $data->histories->sum('loan_return') >= 0 ? $data->loan_amount - $data->histories->sum('loan_return') : 0 }}
                                                    </td>

                                                    <td>{{ $data->loan_amount > 0 ? $data->histories->sum('loan_return') : 0 }}
                                                    </td>

                                                    <td>{{ $data->salary ?? 0 }}</td>
                                                    <td>{{ $data->other_allowance ?? 0 }}</td>
                                                    <td>{{ $data->salary - $data->loan_return + $data->other_allowance ?? 0 }}
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
