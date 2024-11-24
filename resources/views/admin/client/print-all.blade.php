<!doctype html>
<html lang="en">

<head>
    <title>Print</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<style>
    .info-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 15px;
        width: fit-content;
        margin-bottom: 40px;
    }

    .info-row {
        display: flex;
        flex-direction: row;
        gap: 10;
        align-items: center;
        padding-bottom: 0;
        border-bottom: 2px solid black;
        width: fit-content;
        font-weight: 400;
    }

    .label {
        width: 120px;
    }

    .value {
        text-align: left;
    }

    .receipt-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .receipt-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 70%;
        border-bottom: 2px solid black;
        text-align: right;
    }

    .receipt-row span {
        text-align: right;
        /* Ensure text aligns to the right */
    }

    /* For the table-responsive container */
    .table-responsive {
        width: 60%;
    }

    /* Style for the table */
    .table {
        width: 100%;
        border-collapse: collapse;
        padding: 0;
    }


    .table th,
    .table td {
        text-align: right;
        /* Align text to the right */
        border: none;
        border-bottom: 2px solid black;
    }

    .table td {
        border-bottom: 2px solid black;
        padding: 5px 0;
    }

    /* Add bottom border to each row, except header */
    .table tbody tr {
        border-bottom: 2px solid black;
    }

    /* Styling for the table's summary rows */
    .table tfoot tr {
        font-weight: bold;
        /* Make text bold for the footer rows */
        border-bottom: 2px solid black;
        padding: 4px 0 0 0;
    }

    .table th {
        font-weight: normal;
        padding: 4px 0 0 0;
    }

    @media print {
        .bg-primary {
            background-color: #007bff !important;
            /* Ensure the primary color is printed */
            -webkit-print-color-adjust: exact;
            /* For Webkit browsers like Chrome */
            print-color-adjust: exact;
            /* For other browsers */
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .w-100 {
            width: 100%;
        }

        body {
            margin: 0;
            padding: 0;
        }

        main {
            border: none;
            padding: 10px;
            height: 100vh;
            /* Adjust padding to fit content on one page */
        }

        .info-container,
        .receipt-container {
            width: 100%;
            /* Ensure it adjusts to page width */
            padding: 0;
        }

        .receipt-row {
            font-size: 12px;
            /* Reduce font size to fit more content */
            padding: 4px 0;
            /* Minimize padding to save space */
        }

        p,
        span {
            font-size: 12px;
            /* Adjust text size for print readability */
        }

        .d-flex {
            flex-wrap: wrap;
            /* Ensure content adjusts for smaller page size */
        }

        .bg-primary {
            background-color: #007bff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            height: 10px;
            /* Control height for print output */
        }

        #banknameInput {
            width: calc(1ch * (attr(value).length + 1));
            /* Dynamically set width */
        }

        footer,
        #printButton {
            display: none;
            /* Hide unnecessary elements on print */
        }
    }
</style>

<body>
    <main class="px-3" style="border : 2px solid black">
        <button class="btn btn-sm btn-primary mt-2" id="printButton">Print</button>
        <div class="logo d-flex justify-content-end">
            <img src="{{ asset('assets/images/COUNTRY DEALERS LOGO AZ.svg') }}" alt="Logo Image"
                style="max-width: 100%; height: 150px;">
        </div>
        <h4 class="text-center"><u>Payment Receipt</u></h6>
            <p class="text-end"> <u>Date: (<input type="text" id="customDateInput"
                        style="width: 100px;border:none; font-wight:underline; background:transparent;outline: none;">
                    <span id="hiddenSpan" style="position: absolute; visibility: hidden; white-space: nowrap;"></span>
                </u>)</p>
            <div class="info-container">
                <div class="info-row">
                    <span class="label">Paid By:</span>
                    <span class="value">
                        <input type="text" id="dynamicInput" value={{ $data->name }}
                            style="width: 100px;border:none; background:transparent;outline: none;"> </span>
                </div>
                <div class="info-row">
                    <span class="label">CNIC No:</span>
                    <span class="value">{{ $data->cnic }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Plot Size:</span>
                    <span class="value">{{ $data->plot_size }} ( {{ convertMarlaToSqFt($data->plot_size) }} Sq. Ft )</span>
                </div>
                <div class="info-row">
                    <span class="label">Plot No:</span>
                    <span class="value">{{ $data->plot_number }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Location:</span>
                    <span class="value">{{ $data->address }}</span>
                </div>
            </div>


            <div class="d-flex justify-content-center">
                <p style="width: 90%;"> Dear Sir/Madam, <br>
                    This is here by acknowledge that Country Dealers & Developers has Received Rs.
                    {{ formatNumberWithCurrencyExtension($data->installments->where('status', 'PAID')->sum('cheque_installment_amount') + $data->installments->where('status', 'PAID')->sum('installment_payment')) }}/-
                    to Country Dealers
                    as
                    payment against Plot No. ({{ $data->plot_number }}) as
                    Remanning Amount.
                    <br>
                    Your Payment Status is as Follows:
                </p>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="table-responsive" style="width: 70%;">
                    <table class="table ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" style="width: 10%;">#</th>
                                <th scope="col" style="width: 45%;">Amount</th>
                                <th scope="col" style="width: 45%;">Paid Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->installments as $key => $installment)
                                @if ($installment->status == 'PAID')
                                    <tr>
                                        <td scope="row" c>{{ $key + 1 }}</td>
                                        <td class="text-end">
                                            {{ formatNumberWithCurrencyExtension($installment->cheque_installment_amount ?? $installment->installment_payment, 2) }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($installment->updated_at)->format('d-M-Y') }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary">
                                <th colspan="2" class="text-end">Plot Price</th>
                                <th class="text-end" style="padding-right:0;">
                                    {{ formatNumberWithCurrencyExtension($data->plot_sale_price, 2) }}</th>
                            </tr>
                            <tr class="table-secondary">
                                <th colspan="2" class="text-end" style="font-weight: bold;">Total Paid</th>
                                <th class="text-end" style="padding-right:0;">
                                    {{ formatNumberWithCurrencyExtension($data->installments->where('status', 'PAID')->sum('cheque_installment_amount') + $data->installments->where('status', 'PAID')->sum('installment_payment'), 2) }}
                                </th>
                            </tr>
                            <tr class="table-secondary">
                                <th colspan="2" class="text-end">Adjustment / Advance payments</th>
                                <th class="text-end" style="padding-right:0;">
                                    {{ formatNumberWithCurrencyExtension($data->advance_payment + $data->adjustment_price, 2) }}
                                </th>
                            </tr>
                            <tr class="table-secondary">
                                <th colspan="2" class="text-end">Remaining</th>
                                <th class="text-end" style="padding-right:0;">
                                    {{ formatNumberWithCurrencyExtension($data->plot_sale_price - ($data->installments->where('status', 'PAID')->sum('cheque_installment_amount') + $data->installments->where('status', 'PAID')->sum('installment_payment')) - ($data->advance_payment + $data->adjustment_price), 2) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <p style="font-size: 9px; text-align:center; width:90%" class="p-0">Note: This is a
                    Computer-Generated Receipt/Invoice. In Case of any
                    Discrepancies/Queries/Objections, Please Notify Country Dealers & Developers.</p>

                <div class="d-flex justify-content-end align-items-end flex-column"
                    style="width: 70%; margin-botttom:4px;">
                    <img src="{{ asset('/assets/images/signatures.png') }}" alt="" width="200px">
                    <div class="d-flex flex-column">
                        <input type="text" value="Muhammad Hassan Chheenah"
                            style="border:none; border-bottom: 1px solid black; outline:none; background:transparent;outline: none;position: relative; bottom: 4px;width: 250px">
                        <span>CEO Murree Resorts</span>
                    </div>
                </div>
                <div class="bg-primary py-2 w-100"></div>
            </div>
            <div class="d-flex justify-content-start align-items-start w-100">
                <ul type="square" class="mt-1">
                    <li>+92512321790-91</li>
                    <li>Main Murree Road Near BOP Bhara Kahu, Islamabad </li>
                    <li><a href="https://www.CountryDealers.com" target="_blank">www.CountryDealers.com</a></li>
                </ul>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dynamicInput').on('input', function() {
                var inputVal = $(this).val();
                $('#hiddenSpan').text(inputVal);
                // Adjust the input width based on the hidden span width
                $(this).css('width', $('#hiddenSpan').width() + 5); // Add some padding (e.g., 20px)
            });
            $('#banknameInput').on('input', function() {
                var inputVal = $(this).val();
                $('#banknameInputSpan').text(inputVal);
                // Adjust the input width based on the hidden span width
                $(this).css('width', $('#banknameInputSpan').width() + 5); // Add some padding (e.g., 20px)
            });
            $('#customDateInput').on('input', function() {
                var inputVal = $(this).val();
                $('#banknameInputSpan').text(inputVal);
                // Adjust the input width based on the hidden span width
                $(this).css('width', $('#banknameInputSpan').width() + 5); // Add some padding (e.g., 20px)
            });

            $('#printButton').on('click', function() {
                $(this).hide();
                print();
                window.location.reload();
            })
        });
    </script>
</body>

</html>
