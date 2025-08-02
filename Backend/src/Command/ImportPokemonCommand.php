<?php

// src/Command/ImportPokemonCommand.php

// src/Command/ImportPokemonCommand.php

namespace App\Command;

use App\Entity\PokemonDb;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import-pokemon',
    description: 'Importe les Pokémon depuis la PokéAPI',
)]
class ImportPokemonCommand extends Command
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        for ($i = 1; $i <= 151; $i++) {
            $response = $this->httpClient->request('GET', "https://pokeapi.co/api/v2/pokemon/$i");
            $data = $response->toArray();

            $pokemon = new PokemonDb();
            $pokemon->setPokeApiId($data['id']);
            $pokemon->setName($data['name']);
            $pokemon->setSprite($data['sprites']['front_default']);

            // Récupération des types
            $types = array_map(fn($typeInfo) => $typeInfo['type']['name'], $data['types']);
            $pokemon->setTypes($types);

            $this->em->persist($pokemon);
            $output->writeln("✅ {$data['name']} importé");
        }

        $this->em->flush();
        $output->writeln("🎉 Tous les Pokémon ont été importés.");

        return Command::SUCCESS;
    }
}
