<?php

namespace App\Http\Middleware;

use App\Helpers\Constant;
use App\Helpers\Util;
use Closure;

class AuthenticateOnceWithBasicAuth
{
    protected $request;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->request = $request;
        $this->appendTokenToBearerHeader();
        if ($this->protectedAuthBasic()) {
            return $next($request);
        } else {
            $this->destroyAuthBasic();
            return isset($_SERVER[Constant::BASIC_AUTH_NAME]) ? $next($request) : $this->unauthorized();
        }
    }

    /**
     * Custom unauthorized result
     *
     * @return Unauthorized header
     */
    private function unauthorized()
    {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");
    }

    /**
     * Destroy basic authorization
     */
    private function destroyAuthBasic()
    {
        if (isset($_SERVER[Constant::BASIC_AUTH_NAME])) {
            unset($_SERVER[Constant::BASIC_AUTH_NAME]);
        }

        if (isset($_SERVER[Constant::BASIC_AUTH_PWD])) {
            unset($_SERVER[Constant::BASIC_AUTH_PWD]);
        }
    }

    /**
     * Check basic authorization param is correct
     *
     * @return bool
     */
    private function protectedAuthBasic()
    {
        if (Util::getGlobalServer(Constant::BASIC_AUTH_NAME) == Constant::VALUE_AUTH_NAME &&
            Util::getGlobalServer(Constant::BASIC_AUTH_PWD) == Constant::VALUE_AUTH_PWD) {
            return true;
        }
        return false;
    }

    /**
     * Append token in body param to Authorization header
     */
    private function appendTokenToBearerHeader()
    {
        $token = $this->request->get('token');
        $_SERVER[Constant::HTTP_AUTHORIZATION] = 'Bearer ' . $token;
        $this->request->headers->set('Authorization', $_SERVER[Constant::HTTP_AUTHORIZATION]);
    }
}
