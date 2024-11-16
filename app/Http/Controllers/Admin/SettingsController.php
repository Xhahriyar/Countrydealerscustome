<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
class SettingsController extends Controller
{
    public function index()
    {
        $this->authorize(PermissionEnum::SETTINGS(), [Type::class]);

        $data = Type::all();
        return view('admin.settings.settings'  ,compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type_category' => 'required',
        ]);

        Type::create($request->all());

        return redirect()->back()->with('success' , 'Record Added Successfully.');
    }
    public function delete($id)
    {
        $this->authorize(PermissionEnum::SETTINGS_TYPE_DELETE(), [Type::class]);

        Type::find($id)->delete();
        return redirect()->back()->with('success' , 'Record Deleted Successfully.');
    }
}
