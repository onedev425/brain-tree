<?php

namespace App\Services\User;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * @var CreateNewUser
     */
    public $createUserAction;

    /**
     * @var UpdateUserProfileInformation
     */
    public $updateUserProfileInformationAction;

    public function __construct(CreateNewUser $createUserAction, UpdateUserProfileInformation $updateUserProfileInformationAction)
    {
        $this->createUserAction = $createUserAction;
        $this->updateUserProfileInformationAction = $updateUserProfileInformationAction;
    }

    /**
     * Get all users.
     */
    public function getAllUsers(): Collection|static
    {
        return User::get();
    }

    /**
     * Get a user by id.
     *
     * @param int $id
     *
     * @return \App\Models\User
     */
    public function getUserById($id)
    {
        return User::find($id);
    }

    /**
     * Get users by role.
     *
     * @param string $role
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsersByRole($role)
    {
        return User::Role($role)->get();
    }

    /**
     * Create a new user.
     *
     *
     * @return User
     */
    public function createUser($record)
    {
        $user_data = [
            'role'                  => $record['role'],
            'name'                  => $record['user_name'],
            'email'                 => $record['email'],
            'photo'                 => null,
            'password'              => $record['password'],
            'password_confirmation' => $record['password_confirmation'],
            'phone'                 => $record['phone'],
            'country_id'            => $record['role'] == 3 ? null : $record['country'],
            'language_id'           => $record['role'] == 3 ? null : $record['language'],
            'industry_id'           => $record['role'] == 3 ? null : $record['industry'],
            'experience'            => $record['role'] == 3 ? null : $record['experience'],
            'skills'                => $record['role'] == 3 ? null : $record['skills'],
            'description'           => $record['role'] == 3 ? null : $record['description'],
        ];

        $user = $this->createUserAction->create($user_data);

        return $user;
    }

    /**
     * Create full name from first name, last name and other names.
     *
     * @param string|null $othernames
     *
     * @return string
     */
    public function createFullName($firstname, $lastname)
    {
        return $firstname.' '.$lastname;
    }

    /**
     * Check if user has a role.
     *
     * @param int    $id
     * @param string $role
     *
     * @return bool
     */
    public function verifyRole($id, $role)
    {
        $user = $this->getUserById($id);

        return $user->load('roles')->hasRole($role);
    }

    /**
     * Update user profile information.
     *
     * @param User   $user User instance
     * @param string $role Verify role before updating
     *
     * @return \App\Models\User
     */
    public function updateUser(User $user, $record, string $role = null)
    {
        if (isset($role)) {
            if (!$this->verifyRole($user->id, $role)) {
                abort('403', "User isn't a/an $role");
            }
        }
        $record['name'] = $this->createFullName($record['first_name'], $record['last_name']);

        //update profile photo if present
        if (isset($record['profile_photo'])) {
            $user->updateProfilePhoto($record['profile_photo']);
        }

        $user = $this->updateUserProfileInformationAction->update($user, $record);

        return $user;
    }

    /**
     * Delete a user.
     *
     * @param string $role
     *
     * @return void
     */
    public function deleteUser(User $user)
    {
        $user->delete();
    }

    /**
     * verify user role or return 404.
     *
     *
     * @return response
     */
    public function verifyUserIsOfRoleElseNotFound(User $user, string $role)
    {
        if (!$this->verifyRole($user->id, $role)) {
            abort(404);
        }
    }

    /**
     * Lock or Unlock a user account.
     *
     * @return void
     */
    public function lockUserAccount(User $user, $lock = true)
    {
        $user->locked = $lock;
        $user->save();
    }
}
