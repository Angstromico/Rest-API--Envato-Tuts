<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Route;
    use Laravel\Sanctum\Sanctum;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/setup', function () {
        $credentials = [
            'email' => 'adminman@admin.com',
            'password' => 'passwords'
        ];

        if (!Auth::attempt($credentials)) {
            $user = new App\Models\User();

            $user->name = 'Admin';
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);

            $user->save();
            //dd($user);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $adminToken = $user->createToken('admin_token', ['create', 'update', 'delete']);
                $updateToken = $user->createToken('update_token', ['create', 'update']);
                $basicToken = $user->createToken('basic_token', ['none']);

                return [
                    'admin' => $adminToken->plainTextToken,
                    'update' => $updateToken->plainTextToken,
                    'basic' => $basicToken->plainTextToken,
                ];
            }
        }
    });
