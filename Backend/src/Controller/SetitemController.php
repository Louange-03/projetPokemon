<?php

namespace App\Controller;

use App\Entity\PokemonDb;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SetitemController extends AbstractController
{
    #[Route('/api/pokemons', name: 'api_get_pokemons', methods: ['GET'])]
    public function getPokemons(EntityManagerInterface $em): JsonResponse
    {
        // Récuperation de tous les Pokémon
        $pokemons = $em->getRepository(PokemonDb::class)->findAll();

        // Transformation des entités en tableau
        $data = array_map(function (PokemonDb $pokemon) {
            return [
                'id' => $pokemon->getId(),
                'pokeApiId' => $pokemon->getPokeApiId(),
                'name' => $pokemon->getName(),
                'sprite' => $pokemon->getSprite(),
                'types' => $pokemon->getTypes(),
            ];
        }, $pokemons);

        return $this->json($data);
    }
}
