<?php

namespace RenokiCo\EchoServer\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RenokiCo\EchoServer\AppsManagers\App;
use RenokiCo\EchoServer\Contracts\AppsManager;
use RenokiCo\EchoServer\Http\Middleware\AuthenticatesWithToken;

class AppsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(AuthenticatesWithToken::class);
    }

    /**
     * Get an app by ID.
     *
     * @param  \RenokiCo\EchoServer\Contracts\AppsManager  $appsManager
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $appId
     * @return \Illuminate\Http\Response
     */
    public function show(AppsManager $appsManager, Request $request, string $appId)
    {
        $app = $appsManager->find($appId);

        if (! $app) {
            return response()->json(['app' => null], 404);
        }

        return response()->json([
            'app' => $app->toArray(),
        ]);
    }
}