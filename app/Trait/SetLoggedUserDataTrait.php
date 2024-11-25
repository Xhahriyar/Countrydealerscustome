<?php

namespace App\Trait;

use Illuminate\Http\Request;

trait SetLoggedUserDataTrait
{
    /**
     * @param Request $request
     * @return $this|false|string
     */

    // case code generate function

    public function setLoggedUserData($data): array
    {
        if(!is_array($data)){
            $data = $data->toArray();
        }
        if (!empty($data) && isset($data)) {
            $user = auth()->user();
            $data['logged_in_id'] = $user->id;
            $data['logged_in_name'] = $user->first_name . ' ' . $user->last_name;
            $data['user_agent'] = request()->userAgent();
            $data['ip_address'] = request()->ip();
        } 
        return $data;
    }
}
