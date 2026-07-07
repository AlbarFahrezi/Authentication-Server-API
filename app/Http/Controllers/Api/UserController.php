<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * List User
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sort = $request->get('sort', 'id');
        $order = strtolower($request->get('order', 'asc'));

        $allowedSort = ['id', 'name', 'email', 'role', 'created_at'];

        if (!in_array($sort, $allowedSort)) {
            $sort = 'id';
        }

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        $query->orderBy($sort, $order);

        // Pagination
        $users = $query->paginate(10);

        return $this->success([
            'users' => UserResource::collection($users),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ]
        ], 'Data user berhasil diambil');
    }

    /**
     * Detail User
     */
    public function show($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(
                'User tidak ditemukan',
                404
            );
        }

        return $this->success(
            new UserResource($user),
            'Detail user berhasil diambil'
        );
    }

    /**
     * Tambah User
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        return $this->success(
            new UserResource($user),
            'User berhasil ditambahkan',
            201
        );
    }

    /**
     * Update User
     */
    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(
                'User tidak ditemukan',
                404
            );
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return $this->success(
            new UserResource($user->fresh()),
            'User berhasil diupdate'
        );
    }

    /**
     * Hapus User
     */
    public function destroy($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(
                'User tidak ditemukan',
                404
            );
        }

        $user->delete();

        return $this->success(
            null,
            'User berhasil dihapus'
        );
    }
}