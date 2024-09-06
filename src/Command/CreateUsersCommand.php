<?php
// src/Command/CreateUsersCommand.php

namespace App\Command;

use App\Entity\Owner;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUsersCommand extends Command
{
    protected static $defaultName = 'app:create-users';

    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates users from the Owner entity.')
            ->addArgument('role', InputArgument::OPTIONAL, 'Role of the user to be created', 'ROLE_USER');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $role = $input->getArgument('role');

        $repository = $this->entityManager->getRepository(Owner::class);
        $owners = $repository->findAll();

        foreach ($owners as $owner) {
            // Encode the password if necessary
            $encodedPassword = $this->passwordHasher->hashPassword($owner, $owner->getPassword());
            $owner->setPassword($encodedPassword);
            $owner->setRoles([$role]);

            // Persist changes
            $this->entityManager->persist($owner);
        }

        $this->entityManager->flush();

        $output->writeln('Users have been created or updated successfully.');

        return Command::SUCCESS;
    }
}
