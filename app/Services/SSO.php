<?php
namespace App\Services;

use Illuminate\Http\Request;
use Jasny\SSO\Broker;

class SSO {
    public $sso = null;

    public function __construct(Request $r)
    {
        $this->sso = new Broker(
            'https://ssoserv.bcsoetta.org/',
            '5',
            '5h1n74aPPs'
        ); 

        // auto set token
        $token = $r->bearerToken();
        $this->sso->token = $token;

        // info("SSO spawned with token : $token");
    }

    public function getUserInfo() {
        // $this->sso->token = $accessToken;

        // call get user
        try {
            $userInfo = $this->sso->getUserInfo();
            return $userInfo;
        } catch (\Exception $e) {
            // echo "getUserInfo error: {$e->getMessage()}";
            return null;
        }
    }

    public function __call($fn, $args) {
        return $this->sso->__call($fn, $args);
    }
}