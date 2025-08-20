#pokemon#

#Backend (Symfony)

Installation d'une entité Pokémon avec :

ID

Nom

Types

Image

Ajout d'un contrôleur avec une méthode POST pour récupérer les Pokémons depuis POKEAPI et les enregistrer dans la base de donnée.

Migration pour insérer les données.

Création d'un contrôleur GET qui envoie les données au frontend.

#Frontend (React + Next.js)

Installation et configuration du projet React + Next.js avec npm.

Création d'un dossier pokemon qui servira de route principale 

Écrire un script en JavaScript (fetch) pour appeler l’API backend et afficher :

Nom

Image

Type

ID

Ajouter du CSS pour rendre l’interface jolie et agréable.




#comment lancer mon projet

# Pokémon App

Une application web qui affiche des Pokémon en utilisant Symfony (backend) et React + Next.js (frontend). Les données des Pokémon sont importées depuis l’API publique "POKEAPI".

# Prérequis
Avant de lancer le projet, assurez-vous d’avoir installé :  
WAMP/MAMP/XAMPP (ou tout serveur MySQL local)  
PHP + Composer  
Node.js et npm  

# Installation et lancement

1.Lancer le serveur MySQL WAMP/MAMP/XAMPP
   Démarrez WAMP/MAMP/XAMPP pour que la base de données MySQL soit accessible.  

2.Lancer le backend (Symfony)  
   Ouvrir le projet dans **VS Code**.  
   Aller dans le dossier "back" :  cd back
     
   Lancer le serveur Symfony :  symfony server:start


3.Lancer le frontend (React + Next.js)  
   Ouvrir un "nouveau terminal".  
   Aller dans le dossier "front" : cd front
   Lancer le serveur de développement Next.js :  npm run dev


4. **Accéder à l’application**  
   Une fois le backend et le frontend lancés, ouvrez :  
http://localhost:3000/pokemon

Vous verrez la liste des Pokémon avec leur (nom, image, type et ID)