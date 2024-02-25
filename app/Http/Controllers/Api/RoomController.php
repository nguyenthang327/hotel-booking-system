<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Logics\RoomManagement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $roomManagement = new RoomManagement;
            $data = $roomManagement->list($request);

            return response()->json([
                'message' => 'Success',
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error("[RoomController][index] error: " . $e->getMessage());
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
    public function store(StoreRoomRequest $request)
    {
        try {
            $roomManagement = new RoomManagement;
            $data = $roomManagement->store($request);

            return response()->json([
                'message' => 'Success',
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error("[RoomController][store] error: " . $e->getMessage());
            return response()->json([
                'message' =>  $e->getMessage(),
                'data' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $roomManagement = new RoomManagement;
            $data = $roomManagement->detail($id);

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
            Log::error("[RoomController][show] error: " . $e->getMessage());
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
    public function update(StoreRoomRequest $request, string $id)
    {
        try {
            $roomManagement = new RoomManagement;
            $data = $roomManagement->update($request, $id);

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
            Log::error("[RoomController][update] error: " . $e->getMessage());
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
            $roomManagement = new RoomManagement;
            $data = $roomManagement->destroy($id);

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
            Log::error("[RoomController][destroy] error: " . $e->getMessage());
            return response()->json([
                'message' =>  $e->getMessage(),
                'data' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
