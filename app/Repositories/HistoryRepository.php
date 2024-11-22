<?php

namespace App\Repositories;

use App\Models\AdminOfficeEMployee;
use App\Models\History;
use App\Trait\SetLoggedUserDataTrait;

class HistoryRepository
{
    use SetLoggedUserDataTrait;
    protected $model;

    public function __construct(History $model)
    {
        $this->model = $model;
    }
    public function store($id)
    {
        $employee = AdminOfficeEmployee::find($id);
        if ($employee) {
            $historyData = $employee->toArray();
            $historyData = collect($historyData)->except(['id','image', 'cnic_front_image' , 'cnic_back_image' , 'father_cnic_front_image' , 'father_cnic_back_image' , 'cv','date', 'logged_in_id', 'logged_in_name', 'user_agent', 'ip_address'])->toArray();
            $historyData['employee_id'] = $employee->id;
            $historyData = $this->setLoggedUserData($historyData);

            History::create($historyData);
        }
    }

    public function find($id)
    {
        $history = History::where('employee_id', $id)->get();
        return $history;
    }
    public function findForPrint($id)
    {
        return $this->model->find($id);
    }
    public function printLadger($employeeId)
    {
       return AdminOfficeEMployee::with('histories')->find($employeeId);
    }
}
