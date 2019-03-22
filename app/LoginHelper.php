<?php

namespace FlowCp;

use FlowCp\User;

interface PasswordHashStrategy
{
    public function hash($password);
}

interface VerifyStrategy
{
    public function verifyUser($password, $stored_password);
}

class MD5HashStrategy implements PasswordHashStrategy, VerifyStrategy
{
    public function hash($password)
    {
        return md5($password);
    }

    public function verifyUser($password, $stored_password)
    {
        return hash_equals($stored_password, md5($password));
    }
}

class PlaintextStrategy implements PasswordHashStrategy, VerifyStrategy
{
    public function hash($password)
    {
        return $password;
    }

    public function verifyUser($password, $stored_password)
    {
        return hash_equals($stored_password, $password);
    }
}

class BcryptStrategy implements PasswordHashStrategy, VerifyStrategy
{
    public function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyUser($password, $stored_password)
    {
        return password_verify($password, $stored_password);
    }
}

class LoginHelper
{
    private $passwordHashStrategy;
    private $verifyStrategy;

    public function __construct($hashStrat, $verifyStrat)
    {
        $this->passwordHashStrategy = $hashStrat;
        $this->verifyStrategy = $verifyStrat;
    }

    public static function create()
    {
        switch (config('flow.password_algo')) {
            case 'MD5':
                $strat = new MD5HashStrategy();
                return new LoginHelper($strat, $strat);
            case 'BCRYPT':
                $strat = new BcryptStrategy();
                return new LoginHelper($strat, $strat);
            case 'NONE':
                $strat = new PlaintextStrategy();
                return new LoginHelper($strat, $strat);
            default:
                throw new \Exception('Unknown password hashing algorithm');
        }
    }

    public function hash($password)
    {
        return $this->passwordHashStrategy->hash($password);
    }

    public function verifyUser($username, $password)
    {
        $user = User::where('userid', $username)->first();

        return $user != null && $this->verifyStrategy->verifyUser($password, $user->user_pass);
    }
}
