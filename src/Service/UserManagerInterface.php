<?php
declare(strict_types=1);


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Exception\StorageException;



interface UserManagerInterface
{
    /**
     * @return UserRepository
     */
    public function getRepository(): UserRepository;

    /**
     * Get one User from storage.
     *
     * @param string|int $id
     *
     * @return User|null
     */
    public function get($id): ?User;

    /**
     * Remove User from storage.
     *
     * @param User $user
     *
     * @return User
     *
     * @throws StorageException
     */
    public function delete(User $user): User;

    /**
     * Store changes.
     *
     * @param User $user
     *
     * @return User
     *
     * @throws StorageException
     */
    public function store(User $user): User;

}