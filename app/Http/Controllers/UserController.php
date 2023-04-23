<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\HistoryService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    private const PERCENT_70 = 0.7;
    private const PERCENT_50 = 0.5;
    private const PERCENT_30 = 0.3;
    private const PERCENT_10 = 0.1;

    public function __construct(
        private readonly UserService    $service,
        private readonly HistoryService $historyService,
    ){ }

    public function register(): View
    {
        return view('user.registration');
    }

    public function store(CreateUserRequest $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $params = $request->validated();

        $params['token'] = $this->getRandomToken();
        $params['token_valid_until'] = now()->addDays(7);

        $this->service->create($params);

        return view('user.registration-complete', ['link' => config('app.url') . '/user/' . $params['token']]);
    }

    public function getUserPage($token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $user = $this->service->getUserByToken($token);

        if ($user) {
            return view('user.page', ['user' => $user]);
        }

        return to_route('register');
    }

    public function addLucky($token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $user = $this->service->getUserByToken($token);

        if ($user) {
            $random_number = rand(1, 1000);
            $win = !($random_number % 2);

            $params['user_id'] = $user->id;
            $params['random_number'] = $random_number;
            $params['win'] = $win;
            $params['sum'] = 0;

            if ($win) {
                $params['sum'] = match (true) {
                    $random_number > 900 => round($random_number * self::PERCENT_70),
                    $random_number > 600 => round($random_number * self::PERCENT_50),
                    $random_number > 300 => round($random_number * self::PERCENT_30),
                    default => round($random_number * self::PERCENT_10),
                };
            }

            $history = $this->historyService->create($params);

            return view('user.lucky', ['user' => $user, 'history' => $history]);
        }

        return to_route('register');
    }

    public function getHistory($token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $user = $this->service->getUserByToken($token);

        if ($user) {
            $histories = $this->historyService->getHistoryByToken($token);

            return view('user.history', ['user' => $user, 'histories' => $histories]);
        }

        return to_route('register');
    }

    public function deactivateUser($token): RedirectResponse
    {
        $user = $this->service->getUserByToken($token);

        if ($user) {
            $this->service->deactivateUser($user);
        }

        return to_route('register');
    }

    public function updateLink($token): RedirectResponse
    {
        $user = $this->service->getUserByToken($token);

        if ($user) {
            $new_token = $this->getRandomToken();
            $this->service->updateUserToken($user, $new_token);

            return to_route('user', ['token' => $new_token]);
        }

        return to_route('register');
    }

    private function getRandomToken(): string
    {
        return Str::random(32);
    }
}
