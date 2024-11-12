<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HistoryRepository;

class PayrollHistoryControlelr extends Controller
{
    protected $historyRepository;
    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }
    public function store($id)
    {
        $this->historyRepository->store($id);
        return redirect()->back()->with("success","Salary has been paid.");
    }
    public function history($id)
    {
        $employeeId = $id;
        $data = $this->historyRepository->find($id);
        return view("admin.history.index", compact("data" , 'employeeId'));
    }
    public function print($id)
    {
        $data = $this->historyRepository->findForPrint($id);
        return view("admin.payrolls.print-salary", compact("data"));
    }
    public function printLadger($employeeId)
    {
        $data = $this->historyRepository->printLadger($employeeId);
        return view("admin.payrolls.print-salary-ladger", compact("data"));
    }
}
