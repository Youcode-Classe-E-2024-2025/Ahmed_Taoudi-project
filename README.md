# TeamFlow - Gestion de Projets

TeamFlow est une application web moderne de gestion de projets développée en PHP. Elle permet aux équipes de gérer efficacement leurs projets, tâches et collaborations.

## 🚀 Fonctionnalités

- **Gestion des Projets**
  - Création et gestion de projets
  - Projets publics et privés
  - Tableaux de bord
  - Suivi de l'avancement des projets

- **Gestion des Tâches**
  - Système Kanban pour la gestion des tâches
  - Attribution des tâches aux membres
  - Suivi des délais et des statuts

- **Collaboration d'Équipe**
  - Gestion des membres du projet
  - Tableaux de bord d'équipe
  - Statistiques de productivité
  - Partage de fichiers

## 🛠️ Technologies Utilisées

- **Backend**
  - PHP 8.0+
  - MySQL
  - PDO pour la connexion base de données

- **Frontend**
  - HTML5/CSS3
  - JavaScript (ES6+)
  - Tailwind CSS
  - Chart.js pour les graphiques

- **Outils**
  - Git pour le contrôle de version

## 📋 Prérequis

- PHP 8.0 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache/Nginx) ou PHP built-in server

## 🚀 Installation

1. **Cloner le repository**
   ```bash
   git clone https://github.com/Youcode-Classe-E-2024-2025/Ahmed_Taoudi-project.git
   cd Ahmed_Taoudi-project
   ```

2. **Configuration de la base de données**
   - La base de données sera créée automatiquement lors de la première exécution de l'application

3. **Démarrer l'application**
   ```bash
   php -S localhost:8000
   ```

## 🔧 Configuration

1. **Base de données**
   - Modifier les paramètres dans `assets/configDB.php`:
     ```php
     $host = "127.0.0.1";
     $port = "3306";
     $user = "root";
     $password = "password";
     $dbname = "teamflow";
     ```

## 📚 Structure du Projet

```
teamflow/
├── assets/         # Ressources statiques (CSS, JS, images, config)
├── controllers/    # Contrôleurs de l'application
├── core/          # Classes principales du framework
├── models/        # Modèles de données
├── views/         # Vues et templates
└── config/        # Fichiers de configuration
```

## 🔒 Sécurité

- Protection contre les injections SQL via PDO
- Validation des entrées utilisateur
- Protection CSRF
- Sessions sécurisées
- Hachage des mots de passe

## 📝 License

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👤 Auteur

- **Ahmed Taoudi**
  - GitHub: [@ahmed-taoudi](https://github.com/tawdi)
