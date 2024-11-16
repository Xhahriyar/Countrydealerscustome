<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;

class CampaignController extends Controller
{
    public function getAdCampaigns()
    {
        $app_id = env('FB_APP_ID');
        $app_secret = env('FB_APP_SECRET');
        $access_token = env('FB_ACCESS_TOKEN');
        $account_id = "act_" . env('FB_AD_ACCOUNT_ID');
        $api = Api::init($app_id, $app_secret, $access_token);
        $account = new AdAccount($account_id);
        $cursor = $account->getCampaigns();

        // Loop over objects
        foreach ($cursor as $campaign) {
            echo $campaign->{CampaignFields::NAME} . PHP_EOL;
        }
    }
}
