<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{

    public static function CreateToken($userEmail, $userID):string{

        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'X-Shop',
            'iat' => time(),
            'exp' => time()+ 60*60*24,
            'userEmail' => $userEmail,
            'userID' => $userID
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToken($token):string|object{

        try{
            if($token == null){
                return 'unauthorized';
            }
            else {
                $key = env('JWT_KEY');
                $decode = JWT::decode($token, new Key($key, 'HS265'));
                return $decode;
            }
        }
        catch(Exception $e){
            return 'unauthorized';
        }

    }

}
