'use client'

import { useEffect, useState } from 'react'

export default function PokemonPage() {
  const [pokemonList, setPokemonList] = useState([])

  useEffect(() => {
    fetch('http://127.0.0.1:8080/api/pokemon_dbs')
      .then(res => res.json())
      .then(data => {
        if (data.member) {
          setPokemonList(data.member)
        }
      })
      .catch(err => console.error('Erreur lors du fetch :', err))
  }, [])

  return (
    <main className="p-6">
      <h1 className="text-3xl font-bold mb-6">Liste des Pokémon</h1>
      <ul className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
        {pokemonList.map(pokemon => (
          <li
            key={pokemon.id}
            className="bg-white rounded-xl shadow p-4 text-center hover:shadow-lg transition"
          >
            <img
              src={pokemon.sprite}
              alt={pokemon.name}
              className="w-24 h-24 mx-auto"
            />
            <h2 className="text-lg font-semibold capitalize mt-2">{pokemon.name}</h2>
            <p className="text-sm text-gray-600">
              ID: <strong>{pokemon.pokeApiId}</strong>
            </p>
            <p className="text-sm text-gray-600">
              Types: {pokemon.types.join(', ')}
            </p>
          </li>
        ))}
      </ul>
    </main>
  )
}
