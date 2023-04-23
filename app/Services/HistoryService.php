<?php

namespace App\Services;

use App\Models\History;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class HistoryService
{
    public function create($params): Model
    {
        return History::query()->create($params);
    }

    public function getHistoryByToken($token): Collection|array
    {
        return History::query()
            ->whereHas('user', function ($q) use ($token) {
                $q->where('token', $token);
            })
            ->latest()
            ->take(3)
            ->get();
    }
}
