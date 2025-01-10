
/* Insert fake data for testing */

-- Insert fake users with hashed passwords (using default hash for testing)
INSERT INTO users (name, email, password) VALUES
('Ahmed taoudi', 'ahmed@taoudi.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- admin
('Fatma Ali', 'fatma.ali@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- manager
('Mohamed Hassan', 'mohamed.hassan@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- developer
('Sara Ibrahim', 'sara.ibrahim@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- designer
('Omar Khaled', 'omar.khaled@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- manager
('Youssef Ali', 'youssef.ali@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- developer
('Layla Ahmed', 'layla.ahmed@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- developer
('Karim Mahmoud', 'karim.mahmoud@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- designer
('Nour Hassan', 'nour.hassan@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- developer
('Amira Samir', 'amira.samir@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- manager
('Hassan Ibrahim', 'hassan.ibrahim@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei' ), -- developer
('Rania Adel', 'rania.adel@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei'); -- designer

-- Insert sample projects with different statuses
INSERT INTO projects (name, description, start_date, end_date, status, created_by) VALUES
('Refonte du Site Web', 'Modernisation complète du site web de l''entreprise avec nouvelles fonctionnalités', '2025-01-01', '2025-06-01', 'in_progress',1),
('Application Mobile', 'Développement d''une application mobile pour nos clients', '2025-02-01', '2025-08-01', 'planning', 2),
('Système de Gestion', 'Implémentation d''un nouveau système de gestion interne', '2025-01-15', '2025-05-01', 'in_progress', 1),
('Plateforme E-commerce', 'Création d''une plateforme e-commerce pour nos produits', '2025-03-01', '2025-09-01', 'planning', 2),
('Système de BI', 'Mise en place d''un système de Business Intelligence', '2025-02-15', '2025-07-15', 'planning', 5),
('Automatisation DevOps', 'Automatisation des processus de déploiement et d''intégration', '2025-01-20', '2025-04-20', 'in_progress', 1),
('Application RH', 'Développement d''une application de gestion des ressources humaines', '2025-03-15', '2025-08-15', 'planning', 10),
('Plateforme de Formation', 'Création d''une plateforme e-learning pour les employés', '2025-04-01', '2025-09-01', 'planning', 2);

-- Insert sample categories
INSERT INTO categories (name) VALUES
('Développement'),
('Design'),
('Marketing'),
('Bug Fix'),
('Documentation'),
('Feature'),
('Testing');

-- Insert sample tags
INSERT INTO tags (name) VALUES
('Urgent'),
('En attente'),
('Prioritaire'),
('Backend'),
('Frontend'),
('UI/UX'),
('API'),
('Database'),
('Performance');

-- Insert tasks for each project
INSERT INTO tasks (title, description, project_id, category_id, status, due_date) VALUES
-- Tasks for Website Redesign
('Analyse des besoins', 'Recueillir et analyser les besoins des utilisateurs', 1, 1, 'done', '2025-01-10'),
('Maquettes UI/UX', 'Créer les maquettes pour le nouveau site', 1, 2, 'in_progress', '2025-02-01'),
('Développement Frontend', 'Implémenter l''interface utilisateur', 1, 1, 'todo', '2025-03-01'),
('Tests d''intégration', 'Effectuer les tests d''intégration', 1, 7, 'todo', '2025-04-01'),

-- Tasks for Mobile App
('Architecture App', 'Définir l''architecture de l''application', 2, 1, 'in_progress', '2025-02-15'),
('Design UI Mobile', 'Créer le design de l''interface mobile', 2, 2, 'todo', '2025-03-01'),
('Développement iOS', 'Développer la version iOS', 2, 1, 'todo', '2025-04-01'),
('Développement Android', 'Développer la version Android', 2, 1, 'todo', '2025-04-01'),

-- Tasks for Management System
('Analyse du système', 'Analyser le système actuel', 3, 1, 'done', '2025-01-20'),
('Configuration Serveur', 'Configurer l''environnement serveur', 3, 1, 'in_progress', '2025-02-01'),
('Développement Backend', 'Développer les APIs backend', 3, 1, 'todo', '2025-03-01'),
('Formation Utilisateurs', 'Former les utilisateurs au nouveau système', 3, 5, 'todo', '2025-04-15'),

-- Tasks for E-commerce Platform
('Étude de marché', 'Analyser le marché et la concurrence', 4, 3, 'in_progress', '2025-03-15'),
('Architecture système', 'Définir l''architecture du système', 4, 1, 'todo', '2025-04-01'),
('Intégration paiement', 'Intégrer les systèmes de paiement', 4, 1, 'todo', '2025-05-01'),
('Tests de sécurité', 'Effectuer les tests de sécurité', 4, 7, 'todo', '2025-06-01'),

-- Tasks for BI System
('Analyse des données', 'Analyser les sources de données existantes', 5, 1, 'in_progress', '2025-02-20'),
('Conception ETL', 'Concevoir les processus ETL', 5, 1, 'todo', '2025-03-15'),
('Développement Tableaux', 'Créer les tableaux de bord', 5, 1, 'todo', '2025-04-15'),
('Tests Performance', 'Optimiser les performances', 5, 7, 'todo', '2025-05-15'),

-- Tasks for DevOps
('Audit Infrastructure', 'Auditer l''infrastructure existante', 6, 1, 'done', '2025-01-25'),
('Configuration CI/CD', 'Mettre en place les pipelines CI/CD', 6, 1, 'in_progress', '2025-02-15'),
('Tests Automatisés', 'Implémenter les tests automatisés', 6, 7, 'todo', '2025-03-10'),
('Documentation', 'Rédiger la documentation technique', 6, 5, 'todo', '2025-04-01'),

-- Tasks for HR App
('Analyse Processus RH', 'Analyser les processus RH actuels', 7, 1, 'in_progress', '2025-03-20'),
('Design Interface', 'Designer l''interface utilisateur', 7, 2, 'todo', '2025-04-15'),
('Développement Core', 'Développer les fonctionnalités principales', 7, 1, 'todo', '2025-05-15'),
('Intégration Paie', 'Intégrer le système de paie', 7, 1, 'todo', '2025-06-15'),

-- Tasks for Training Platform
('Analyse Besoins Formation', 'Analyser les besoins en formation', 8, 3, 'todo', '2025-04-15'),
('Création Contenu', 'Créer le contenu des formations', 8, 5, 'todo', '2025-05-15'),
('Développement Plateforme', 'Développer la plateforme e-learning', 8, 1, 'todo', '2025-06-15'),
('Tests Utilisateurs', 'Réaliser les tests utilisateurs', 8, 7, 'todo', '2025-07-15');

-- Link tasks with tags
INSERT INTO task_tags (task_id, tag_id) VALUES
(1, 4), (1, 7), (2, 5), (2, 6), (3, 1), (4, 1), (4, 8), (5, 5), (6, 6), (7, 3), (8, 9), (9, 4), (10, 5);

-- Assign users to projects with specific roles
INSERT INTO user_projects (user_id, project_id, role_name) VALUES
(1, 1, 'manager'), (2, 1, 'rwe'), (3, 1, 'membre'), (4, 1, 'rwe_add'),
(1, 2, 'rwe'), (2, 2, 'manager'), (5, 2, 'rwe_rm'), (6, 2, 'membre'),
(3, 3, 'manager'), (4, 3, 'rwe_addrm'), (7, 3, 'membre'), (8, 3, 'r-e'),
(5, 4, 'manager'), (6, 4, 'rwe'), (7, 4, 'membre'), (8, 4, 'rwe_add'),
(2, 5, 'manager'), (4, 5, 'rwe_rm'), (6, 5, 'membre'), (8, 5, 'r-e'),
(1, 6, 'manager'), (3, 6, 'rwe_addrm'), (5, 6, 'membre'), (7, 6, 'rwe'),
(4, 7, 'manager'), (6, 7, 'rwe'), (8, 7, 'membre'), (2, 7, 'rwe_add'),
(3, 8, 'manager'), (5, 8, 'rwe_rm'), (7, 8, 'membre'), (1, 8, 'r-e');

-- Assign users to tasks
INSERT INTO task_users (task_id, user_id) VALUES
(1, 2), (2, 4), (3, 3), (4, 3), (2, 7), (3, 7),
(5, 2), (6, 4), (7, 3), (8, 6), (7, 8), (8, 8),
(9, 5), (10, 6), (11, 3), (12, 2), (11, 9),
(13, 2), (14, 3), (15, 6), (16, 5), (15, 11),
(17, 5), (18, 7), (19, 9), (20, 11),
(21, 1), (22, 3), (23, 6), (24, 9),
(25, 10), (26, 8), (27, 11), (28, 12),
(29, 2), (30, 4), (31, 7), (32, 12);