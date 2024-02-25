<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Logics\UserManagement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $userManagement = new UserManagement;
            $data = $userManagement->list($request);


            return response()->json([
                'message' => 'Success',
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error("[UserController][index] error: " . $e->getMessage());
            return response()->json([
                'message' =>  $e->getMessage(),
                'data' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $userManagement = new UserManagement;
            $data = $userManagement->detail($id);

            if (empty($data)) {
                return response()->json([
                    'message' => 'Enity not found',
                    'data' => null,
                    'status' => Response::HTTP_NOT_FOUND
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Success',
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error("[UserController][show] error: " . $e->getMessage());
            return response()->json([
                'message' =>  $e->getMessage(),
                'data' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        try {
            $userManagement = new UserManagement;
            $data = $userManagement->update($request, $id);

            if (empty($data)) {
                return response()->json([
                    'message' => 'Enity not found',
                    'data' => null,
                    'status' => Response::HTTP_NOT_FOUND
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Success',
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error("[UserController][update] error: " . $e->getMessage());
            return response()->json([
                'message' =>  $e->getMessage(),
                'data' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $userManagement = new UserManagement;
            $data = $userManagement->destroy($id);

            if (empty($data)) {
                return response()->json([
                    'message' => 'Enity not found',
                    'data' => null,
                    'status' => Response::HTTP_NOT_FOUND
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Success',
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error("[UserController][destroy] error: " . $e->getMessage());
            return response()->json([
                'message' =>  $e->getMessage(),
                'data' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
