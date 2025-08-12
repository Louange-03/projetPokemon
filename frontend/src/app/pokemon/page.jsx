'use client';

import { useEffect, useState } from 'react';
import './style.css'; // <-- Import du fichier CSS

export default function PokemonPage() {
  const [pokemonList, setPokemonList] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/pokemons')
      .then(res => res.json())
      .then(data => {
        setPokemonList(data);
        setLoading(false);
      })
      .catch(err => {
        console.error('Erreur lors du fetch :', err);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <p className="loading-text">Chargement des Pokémon...</p>;
  }

  if (pokemonList.length === 0) {
    return <p className="loading-text">Aucun Pokémon trouvé.</p>;
  }

  return (
    <main className="main-container">
      <h1 className="title">Liste des Pokémon</h1>
      <ul className="pokemon-grid">
        {pokemonList.map(pokemon => (
          <li key={pokemon.id} className="pokemon-card">
            <img
              src={pokemon.sprite}
              alt={pokemon.name}
              className="pokemon-image"
            />
            <h2 className="pokemon-name">{pokemon.name}</h2>
            <p className="pokemon-id">
              ID: <strong>{pokemon.pokeApiId}</strong>
            </p>
            <p className="pokemon-types">
              Types: {pokemon.types.join(', ')}
            </p>
          </li>
        ))}
      </ul>
    </main>
  );
}
