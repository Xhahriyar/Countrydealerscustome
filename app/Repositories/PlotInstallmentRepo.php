<?php

namespace App\Repositories;


use App\Models\Client;
use App\Models\ClientNotification;
use App\Models\PlotInstallment;
use App\Models\PlotSalesOfficer;
use App\Trait\SetLoggedUserDataTrait;
use Illuminate\Support\Facades\Validator;

class PlotInstallmentRepo
{
    use SetLoggedUserDataTrait;
    protected $model;
    protected $client;
    protected $clientNotification;
    protected $plotSalesOfficer;

    public function __construct(PlotInstallment $model, Client $client, ClientNotification $clientNotification, PlotSalesOfficer $plotSalesOfficer)
    {
        $this->model = $model;
        $this->client = $client;
        $this->clientNotification = $clientNotification;
        $this->plotSalesOfficer = $plotSalesOfficer;
    }
    public function find(int $id)
    {
        return $this->model->find($id);
    }
    public function store(array $data, $client_id)
    {
        if ($data["payment_method"] != "cash") {
            // Iterate over the installment arrays
            for ($i = 0; $i < count($data['cheque_installment_amount']); $i++) {
                // Handle the image upload for each installment
                if (isset($data['cheque_image'][$i]) && $data['cheque_image'][$i]->isValid()) {
                    // Store the image and get the file path
                    $imagePath = $data['cheque_image'][$i]->store('cheque_images', 'public');
                } else {
                    $imagePath = null; // Handle case where no image is provided
                }

                // Create an array for each installment's data
                $installmentPayment = [
                    "client_id" => $client_id,
                    "payment_type" => $data["payment_type"],
                    "payment_method" => $data["payment_method"],

                    // Accessing installment amount, due date, and stored image path
                    "cheque_installment_amount" => $data['cheque_installment_amount'][$i],
                    "cheque_installment_due_date" => $data['cheque_installment_due_date'][$i],
                    "cheque_image" => $imagePath, // Store the image path in the database
                ];

                // Save each installment as a new record in the database
                $this->model->create($installmentPayment);
            }
        } else {
            for ($i = 0; $i < count($data['installment_payment']); $i++) {
                // Create an array for each cash installment's data
                $installmentPayment = [
                    "client_id" => $client_id,
                    "payment_type" => $data["payment_type"],
                    "payment_method" => $data["payment_method"],

                    // Accessing cash installment amount and due date
                    "installment_payment" => $data['installment_payment'][$i],
                    "payment_installment_due_date" => $data['payment_installment_due_date'][$i],
                ];

                // Save each cash installment as a new record in the database
                $this->model->create($installmentPayment);
            }
        }
    }

    public function getCashInstallments($client_id)
    {
        $cashInstallments = $this->model->where('client_id', $client_id)->where('payment_method', '=', 'cash')->get();
        $chequeInstallments = $this->model->where('client_id', $client_id)->where('payment_method', '=', 'cheque')->get();
        return [$cashInstallments, $chequeInstallments];
    }
    public function updateInstallmentStatus($paymentId, $data)
    {
        $payment = $this->find($paymentId);
        $payment->status = 'PAID';
        if (isset($data['date']) && !empty($data['date'])) {
            $payment->date = $data['date'];
        }
        if (isset($data['payment_type']) && !empty($data['payment_type'])) {
            $payment->payment_type = $data['payment_type'];
        }
        if (isset($data['receipt_image']) && $data['receipt_image']->isValid()) {
            $payment->receipt_image = $data['receipt_image']->store('installmentreceiptimages', 'public');
        }
        $payment = $payment->save();
        // to delete the notification from the `client_notifications` table

        $this->clientNotification::where('client_notification_id', $paymentId)->delete();
        return $payment;
    }

    public function checkBalanceForInstallments($data, $id, $paymentField)
    {

        $installmentData = $data->all();
        $client = $this->client::find($id);
        $totalInstallments = $this->model::where('client_id', $id)
            ->selectRaw('COALESCE(SUM(cheque_installment_amount), 0) as cheque_sum, COALESCE(SUM(installment_payment), 0) as installment_sum')
            ->first();

        $finalTotal = $totalInstallments->cheque_sum + $totalInstallments->installment_sum;
        $remainingBalance = $client->plot_sale_price - ($client->adjustment_price + $client->advance_payment + $finalTotal);
        // dd((int) $remainingBalance);
        if ((int) $installmentData[$paymentField] > (int) $remainingBalance) {
            return false;
        } else {
            return true;
        }
        if ((int) $finalTotal > (int) $remainingBalance) {
            return false;
        } else {
            return true;
        }
    }
    public function addCustomCashInstallment($data, $id)
    {
        $data->validate([
            'installment_payment' => 'required',
            'payment_installment_due_date' => 'required',
        ]);
        $checkBalance = $this->checkBalanceForInstallments($data, $id, 'installment_payment');
        if ($checkBalance == false) {
            return false;
        }
        $new = $this->model;
        $new->client_id = $id;
        $new->payment_type = 'no';
        $new->payment_method = 'cash';
        $new->installment_payment = $data['installment_payment'];
        $new->payment_installment_due_date = $data['payment_installment_due_date'];
        $new->date = date('Y-m-d');
        $loggedData = $this->setLoggedUserData($new->toArray());
        $new->fill($loggedData);
        $new->save();
        return true;
    }
    public function addCustomChequeInstallment($data, $id)
    {
        $data->validate([
            'cheque_installment_amount' => 'required|string|max:255',
            'cheque_image' => 'required|image',
            'cheque_installment_due_date' => 'required',
        ]);
        $checkBalance = $this->checkBalanceForInstallments($data, $id, 'cheque_installment_amount');
        if ($checkBalance == false) {
            return false;
        }
        $new = $this->model;
        $new->client_id = $id;
        $new->payment_type = 'no';
        $new->payment_method = 'cheque';
        if (isset($data['cheque_image']) && $data['cheque_image']->isValid()) {
            // Store the image and get the file path
            $imagePath = $data['cheque_image']->store('cheque_images', 'public');
        }
        $new->cheque_image = $imagePath;
        $new->cheque_installment_amount = $data['cheque_installment_amount'];
        $new->cheque_installment_due_date = $data['cheque_installment_due_date'];
        $new->date = date('Y-m-d');

        // Update the model data with the logged user info
        $loggedData = $this->setLoggedUserData($new->toArray());

        // Convert the array back to the model and save
        $new->fill($loggedData);
        $new->save();

        return true;
    }
    public function calculateSalesOfficerCommission($id, $InstallmentPayment)
    {

        $getClientSalesOfficers = $this->plotSalesOfficer
            ->where('client_id', $id)
            ->select('client_id', 'sales_officer_id', 'commission_amount', \DB::raw('MAX(id) as id'))
            ->with(['officer', 'client'])
            ->groupBy('sales_officer_id', 'client_id', 'commission_amount')
            ->get();

        $uniqueSalesOfficerCount = $getClientSalesOfficers->count();

        foreach ($getClientSalesOfficers as $getClientSalesOfficer) {
            $clientId = $getClientSalesOfficer->client_id;
            $officerId = $getClientSalesOfficer->sales_officer_id;
            $commissionAmount = $getClientSalesOfficer->commission_amount;

            $commissionGoingToTheSalesOfficers = ($commissionAmount / 100) * $InstallmentPayment;
            $commissionGoingToTheOneSalesOfficer = $commissionGoingToTheSalesOfficers / $uniqueSalesOfficerCount;

            $salesOfficer = [
                "client_id" => $clientId,
                "sales_officer_id" => $officerId,
                "commission_type" => 'percent',
                "commission_amount" => $commissionAmount,
                "commission_received" => $commissionGoingToTheOneSalesOfficer,
                "commission_received_status" => 'PENDING',
                "is_installment" => true,
            ];
            $this->plotSalesOfficer->create($salesOfficer);
        }
    }
    public function getAllInstallmentsForPrint($clientId)
    {
        return $this->model::where([
            'client_id' => $clientId,
            'status' => 'PAID',
        ])->get();
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
