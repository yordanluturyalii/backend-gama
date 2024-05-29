<?php 

namespace App\Repository\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepositoryImpl implements AuthRepository {
    public function addDataUser(array $data)
    {
        $user = new User();
        $user->full_name = $data["full_name"];
        $user->address = $data["address"];
        $user->phone_number = $data["phone_number"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->save();

        return $user;
    }

    public function getDataUserOrCreate($data)
    {
        $user = User::query()->firstOrCreate([
            'email' => $data->getEmail()
        ], [
            'full_name' => $data->getName(),
            'address' => '',
            'phone_number' => '',
            'email' => $data->getEmail(),
            'google_id' => $data->getId(),
            'email_verified_at' => now(),
            'password' => $data->getId()
        ]);

        return $user;
    }
}