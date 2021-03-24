<?php
declare(strict_types = 1);
namespace App\Auth;
use App\Models\User;
use SlimSession\Helper;

class Auth
{


    public function attemp($username, $password): bool
    {
        $user = User::where("email", $username)->first();
        
        if(!$user){
            return false;
        }
        
        if ($user->password === md5($password)) {
            $_SESSION['user_am'] = $user->toArray();
            return true;
        } else {
            return false;
        }

        return true;

        return false;
    }

    public function user() {
        return $_SESSION['user_am'];
    }

    public function setUser(User $user) {
        $_SESSION["user_am"] = $user->toArray();
    }

    public function logout() {
        return session_destroy();
    }

    public function check() : bool
    { 
        if (isset($_SESSION['user_am'])) {
            return true;
        }
        return false;
    }

    public function set($key, $value) {
        $user = $_SESSION['user_am'];
        $user[$key] = $value;
        $_SESSION['user_am'] = $user;
    }

}