<?php

namespace App\Logics;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManagement
{
    const LIMIT = 10;

    public function list($request){
        try {
            $user = User::query();

            $user = $user->paginate(self::LIMIT);
            return $user;
        } catch (Exception $e) {
            Log::error("[Logic][UserManagement][list] error: " . $e->getMessage());
            throw new Exception('[Logic][UserManagement][list] error: ' . $e->getMessage());
        }
    }

    public function detail($id) {
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                return null;
            }

            return $user;
        } catch (Exception $e) {
            Log::error("[Logic][UserManagement][detail] error: " . $e->getMessage());
            throw new Exception('[Logic][UserManagement][detail] error: ' . $e->getMessage());
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                return null;
            }

            $params = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ];

            if ($request->input('password')) {
                $params['password'] = Hash::make($request->input('password'));
            }

            $user->update($params);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("[Logic][UserManagement][update] error: " . $e->getMessage());
            throw new Exception('[Logic][UserManagement][update] error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                return null;
            }
            $user->delete();
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("[Logic][UserManagement][destroy] error: " . $e->getMessage());
            throw new Exception('[Logic][UserManagement][destroy] error: ' . $e->getMessage());
        }
    }
}
