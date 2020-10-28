<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Exception\StorageException;
use App\Service\UserManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;


class UserManager implements UserManagerInterface
{

    private EntityManagerInterface $em;
    private UserRepository $repository;
    private LoggerInterface $logger;

    public function __construct(EntityManagerInterface $em, UserRepository $repository, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @return UserRepository
     */
    public function getRepository (): UserRepository
    {
        return $this->repository;
    }

    /**
     * @param int|string $id
     * @return User|null
     */
    public function get ($id): ?User
    {
        return $this->repository->find($id);
    }

    /**
     * Update the user info.
     *
     * @param User $user
     *
     * @return User
     *
     * @throws StorageException
     */
    public function update(User $user): User
    {
        $userId = $user->getId();
        if ($userId === null) {
            throw new StorageException("User with id($userId) was not found.");
        }
        $this->flushToStorage();

        $this->logger->info('User was updated.', ['id' => $user->getId()]);

        return $user;
    }


    /**
     * @param User $user
     * @return User
     */
    public function delete(User $user): User
    {
        $userID = $user->getId();
        if ($userID === null) {
            throw new StorageException("User with id($userID) was not found.");
        }
        $this->em->remove($user);
        $this->flushToStorage();

        $this->logger->info('User was deleted.', ['id' => $user->getId()]);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function store(User $user): User
    {
        $userId = $user->getId();
        if ($userId !== null) {
            throw new StorageException("User with id($userId) already exists.");
        }
        $this->em->persist($user);
        $this->flushToStorage();

        $this->logger->info('User was stored.', ['id' => $user->getId()]);

        return $user;
    }

    /**
     * Store item.
     */
    private function flushToStorage(): void
    {
        try {
            $this->em->flush();
        } catch (\Exception $e) {
            throw new StorageException($e->getMessage(), (int) $e->getCode(), $e);
        }
    }
}