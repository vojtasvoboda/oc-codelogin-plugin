<?php namespace VojtaSvoboda\CodeLogin\Repositories;

use Auth;
use October\Rain\Auth\AuthException;
use RainLab\User\Models\User;
use RainLab\User\Models\UserGroup;

class UserRepository
{
    /**
     * Returns user by password
     *
     * @param $password
     *
     * @return User|null
     */
    public function getUserByPassword($password, $groupId = null)
    {
        $users = !empty($groupId) ? $this->getAllUsersOfGroup($groupId) : $this->getAllUsers();

        foreach ($users as $user) {

            try {
                $user = Auth::findUserByCredentials([
                    'email' => $user->email,
                    'password' => $password,
                ]);

                return $user;

            } catch (AuthException $e) {
                $user = null;
            }

        }

        return null;
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function getAllUsersOfGroup($groupId)
    {
        return User::whereHas('groups', function ($groupQuery) use ($groupId) {
            return $groupQuery->where('id', '=', $groupId);
        })->where('is_activated', true)->get();
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function getAllUsers()
    {
        return User::where('is_activated', true)->get();
    }

    public function getAllGroups($columns = ['*'])
    {
        return UserGroup::select($columns)->get();
    }
}
