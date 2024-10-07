<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('getAuthUserModulePermissions')) {
    function getAuthUserModulePermissions()
    {
        $permissions = [];
        $user = auth()->user();
        if($user){
            $permissions = \App\Models\RolePermission:: where('role_id',$user->role_id)->pluck('permission')->toArray();
        }
        return $permissions;
    }

}

if (!function_exists('hasPermissions')) {
    function hasPermissions($permissions,$permission)
    {
        $user = auth()->user();
        if(!$user){
            return false;
        }
        if($user->role_id == 1){
            return  true;
        }
        if(in_array($permission,$permissions)){
            return true;
        }
        return false;
    }


}


if (!function_exists('getSideBar')) {
    function getSideBar()
    {
        $user = auth()->user();
        $menus = [];
        if($user->role_id == 1){
            $menus = \App\Models\Module::all();
        }else{
            $menuIds = \App\Models\RolePermission::where('role_id',$user->role_id)->pluck('module_id')->toArray();
            $menus = \App\Models\Module::whereIn('id',$menuIds)->get();
        }
        return $menus;
    }


}
if (!function_exists('sendSms')) {
    function sendSms($to,$message)
    {
        $key = config('services.infobip.key');
        $url = config('services.infobip.url');
        $headers = [
            'Authorization' => "App {$key}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $data = [
            'messages' => [
                [
                    'destinations' => [
                        ['to' => $to],
                    ],
                    'from' => 'ServiceSMS',
                    'text' => $message,
                ],
            ],
        ];

        try {
            $response = Http::withHeaders($headers)->post($url, $data);
            if ($response->status() == 200) {
                echo $response->body();
            } else {
                echo 'Unexpected HTTP status: ' . $response->status() . ' ' . $response->reason();
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}


