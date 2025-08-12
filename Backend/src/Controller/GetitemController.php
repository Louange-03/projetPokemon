<?php

namespace App\Controller;

use App\Entity\PokemonDb;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
set_time_limit(0);

class GetitemController extends AbstractController
{
    #[Route('/api/import-pokemon', name: 'api_import_pokemon', methods: ['POST'])]
    public function import(EntityManagerInterface $em): JsonResponse
    {
        $httpClient = HttpClient::create();

        try {
            // Récupère tous les Pokémon disponibles (1281 max actuellement)
            $response = $httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=100');
            $results = $response->toArray()['results'];

            $imported = 100;

            foreach ($results as $pokemonData) {
                // Détails du Pokémon
                $details = $httpClient->request('GET', $pokemonData['url'])->toArray();

                $pokeID = $details['id'];
                $name = $details['name'];
                $sprite = $details['sprites']['front_default'] ?? null;
                $types = array_map(fn($t) => $t['type']['name'], $details['types']);

                // Vérifie si déjà présent dans la DB
                $existing = $em->getRepository(PokemonDb::class)->findOneBy(['pokeApiId' => $pokeID]);
                if ($existing) {
                    continue;
                }

                // Création
                $pokemon = new PokemonDb();
                $pokemon->setPokeApiId($pokeID);
                $pokemon->setName($name);
                $pokemon->setSprite($sprite);
                $pokemon->setTypes($types);

                $em->persist($pokemon);
                $imported++;
            }

            $em->flush();

            return $this->json([
                'status' => 'success',
                'imported' => $imported,
                'message' => "$imported Pokémon importés depuis PokéAPI"
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
