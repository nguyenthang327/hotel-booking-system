<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ProcessApiService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends Controller
{
    private $apiService;

    //constructor
    public function __construct()
    {
        $this->apiService = new ProcessApiService();
    }

    public function loginView(Request $request)
    {
        // if ($request->session()->has('token')) {

        //     return redirect('/danh-sach-dieu-khien');
        // }
        $cookieValue = $request->cookie('data');
        $cookie = cookie('data_1', 'value xxx', 2);
        dump($cookieValue, 1, request()->cookie());
        dump(session()->all());
        return view('auth.pages.login.index');
    }

    public function login(Request $request)
    {

        //validate request
        try {

            $params = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
// dd($params);

$response = Http::post('http://localhost:8081/api/v1/auth/login', [
    'email'    => $request->input('email'),
    'password' => $request->input('password'),
]);
dd($response);
            $response = $this->apiService->login($params);
            $request->session()->invalidate();
            //regenerate csrf token
            $request->session()->regenerateToken();

            $token = $response['token'];

            session()->put('token', $token);
            $user = $response['user'];

            $request->session()->put('user', $user);

            session()->regenerate();
            dd($response);
            //  return redirect('/danh-sach-dieu-khien');
        } catch (Exception $e) {
//            dd($e);
            $errorMsg = "Có lỗi xảy ra!";
            error_log($e->getMessage());
            Log::error('[FE][AuthController][login] error: ' . $e->getMessage());
            //return back with login error
            return back()->withInput()->with('loginError', $errorMsg);
        }
    }
}
