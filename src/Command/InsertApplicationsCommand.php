<?php

namespace App\Command;

use App\Entity\Application;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:insert-applications',
    description: 'Insert fixed applications into the database',
)]
class InsertApplicationsCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $applications = [
            ['name' => 'EmpowerVerse', 'type' => 'main'],
            ['name' => 'Vible', 'type' => 'sub'],
            ['name' => 'E/ACC', 'type' => 'sub'],
            ['name' => 'Bloom Scroll', 'type' => 'sub'],
            ['name' => 'InstaRama', 'type' => 'sub'],
            ['name' => 'Flic', 'type' => 'sub'],
            ['name' => 'SolTok', 'type' => 'sub'],
            ['name' => 'PumpTok', 'type' => 'sub'],
            ['name' => 'OvaDrive', 'type' => 'sub'],
            ['name' => 'Gratitude', 'type' => 'sub'],
        ];

        foreach ($applications as $appData) {
            $existingApp = $this->entityManager->getRepository(Application::class)
                ->findOneBy(['name' => $appData['name']]);

            if (!$existingApp) {
                $app = new Application();
                $app->setName($appData['name']);
                $app->setType($appData['type']);

                $this->entityManager->persist($app);
                $output->writeln("Inserted: " . $appData['name']);
            } else {
                $output->writeln("Skipped (Already Exists): " . $appData['name']);
            }
        }

        $this->entityManager->flush();
        $output->writeln("✅ Applications inserted successfully!");

        return Command::SUCCESS;
    }
}
