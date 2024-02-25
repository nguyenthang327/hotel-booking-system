<?php

namespace App\Logics;

use App\Models\Room;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomManagement
{
    const LIMIT = 10;

    public function list($request){
        try {
            $keySearch = $request->query('key_search');
            $limit = $request->input('limit', self::LIMIT);
            $type = $request->input('type');

            $rooms = Room::query();

            $keySearch = str_replace(' ', '%', $keySearch);
            if ($keySearch) {
                $rooms = $rooms->where(function ($query) use ($keySearch) {
                    $query->where('rooms.name', "like", "%$keySearch%")
                        ->orWhere('rooms.code', "like", "%$keySearch%");
                });
            }

            $rooms = $rooms->when($type, function($query) use ($type){
                $query->where('rooms.type', $type);
            });


            $rooms = $rooms->paginate($limit);
            return $rooms;
        } catch (Exception $e) {
            Log::error("[Logic][RoomManagement][list] error: " . $e->getMessage());
            throw new Exception('[Logic][RoomManagement][list] error: ' . $e->getMessage());
        }
    }

    public function store($request){
        DB::beginTransaction();
        try {
            $params = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'price' => $request->input('price') ?? 0,
                'type' => $request->input('type') ?? Room::TYPE_SINGLE,
                'status' => $request->input('type') ?? Room::STATUS_OPEN,
            ];

            $room = Room::create($params);
            DB::commit();
            return $room;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("[Logic][RoomManagement][store] error: " . $e->getMessage());
            throw new Exception('[Logic][RoomManagement][store] error: ' . $e->getMessage());
        }
    }

    public function detail($id) {
        try {
            $room = Room::where('id', $id)->first();
            if (!$room) {
                return null;
            }

            return $room;
        } catch (Exception $e) {
            Log::error("[Logic][RoomManagement][detail] error: " . $e->getMessage());
            throw new Exception('[Logic][RoomManagement][detail] error: ' . $e->getMessage());
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $room = Room::where('id', $id)->first();
            if (!$room) {
                return null;
            }

            $params = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'price' => $request->input('price') ?? 0,
                'type' => $request->input('type') ?? Room::TYPE_SINGLE,
                'status' => $request->input('type') ?? Room::STATUS_OPEN,
            ];

            $room->update($params);
            DB::commit();
            return $room;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("[Logic][RoomManagement][update] error: " . $e->getMessage());
            throw new Exception('[Logic][RoomManagement][update] error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $room = Room::where('id', $id)->first();
            if (!$room) {
                return null;
            }
            $room->delete();
            DB::commit();
            return $room;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("[Logic][RoomManagement][destroy] error: " . $e->getMessage());
            throw new Exception('[Logic][RoomManagement][destroy] error: ' . $e->getMessage());
        }
    }
}
