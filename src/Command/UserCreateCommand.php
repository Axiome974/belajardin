<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'user:create',
    description: 'Add a short description for your command',
)]
class UserCreateCommand extends Command
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');
        $question = new Question("User login?");
        $userLogin = $helper->ask($input, $output, $question);

        $question = new Question("Password?");
        $password = $helper->ask($input, $output, $question);

        $user = new User();
        $user->setEmail($userLogin);
        $user->setPassword( $this->hasher->hashPassword($user, $password));
        $user->setRoles(['ROLE_ADMIN']);

        $this->manager->persist($user);
        $this->manager->flush();

        $io->success("User created!");
        return Command::SUCCESS;
    }
}
