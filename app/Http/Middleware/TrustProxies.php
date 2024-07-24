<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as MiddlewareTrustProxies;
use Illuminate\Http\Request;

class TrustProxies extends MiddlewareTrustProxies
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
