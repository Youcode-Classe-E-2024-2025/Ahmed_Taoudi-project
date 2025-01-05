
/* Insert fake data for testing */

-- Insert fake users with hashed passwords (using default hash for testing)
INSERT INTO users (name, email, password, role_id) VALUES
('Ahmed Mohamed', 'ahmed@taoudi.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 1), -- admin
('Fatma Ali', 'fatma.ali@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 2), -- manager
('Mohamed Hassan', 'mohamed.hassan@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 3), -- developer
('Sara Ibrahim', 'sara.ibrahim@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 4), -- designer
('Omar Khaled', 'omar.khaled@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 2), -- manager
('Youssef Ali', 'youssef.ali@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 3), -- developer
('Layla Ahmed', 'layla.ahmed@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 3), -- developer
('Karim Mahmoud', 'karim.mahmoud@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 4), -- designer
('Nour Hassan', 'nour.hassan@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 3), -- developer
('Amira Samir', 'amira.samir@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 2), -- manager
('Hassan Ibrahim', 'hassan.ibrahim@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 3), -- developer
('Rania Adel', 'rania.adel@example.com', '$2y$10$l1JWggGTOraAbNxoeC/VJe.fgb6F9.NyVO.h0WWGgcjViUvP48Wei', 4); -- designer

-- Insert sample projects with different statuses
INSERT INTO projects (name, description, start_date, end_date, status, created_by) VALUES
('Refonte du Site Web', 'Modernisation complète du site web de l''entreprise avec nouvelles fonctionnalités', '2025-01-01', '2025-06-01', 'in_progress', 1),
('Application Mobile', 'Développement d''une application mobile pour nos clients', '2025-02-01', '2025-08-01', 'planning', 2),
('Système de Gestion', 'Implémentation d''un nouveau système de gestion interne', '2025-01-15', '2025-05-01', 'in_progress', 1),
('Plateforme E-commerce', 'Création d''une plateforme e-commerce pour nos produits', '2025-03-01', '2025-09-01', 'planning', 2),
('Système de BI', 'Mise en place d''un système de Business Intelligence', '2025-02-15', '2025-07-15', 'planning', 5),
('Automatisation DevOps', 'Automatisation des processus de déploiement et d''intégration', '2025-01-20', '2025-04-20', 'in_progress', 1),
('Application RH', 'Développement d''une application de gestion des ressources humaines', '2025-03-15', '2025-08-15', 'planning', 10),
('Plateforme de Formation', 'Création d''une plateforme e-learning pour les employés', '2025-04-01', '2025-09-01', 'planning', 2);

-- Insert tasks for each project
INSERT INTO tasks (title, description, project_id, status, due_date) VALUES
-- Tasks for Website Redesign
('Analyse des besoins', 'Recueillir et analyser les besoins des utilisateurs', 1, 'done', '2025-01-10'),
('Maquettes UI/UX', 'Créer les maquettes pour le nouveau site', 1, 'in_progress', '2025-02-01'),
('Développement Frontend', 'Implémenter l''interface utilisateur', 1, 'todo', '2025-03-01'),
('Tests d''intégration', 'Effectuer les tests d''intégration', 1, 'todo', '2025-04-01'),

-- Tasks for Mobile App
('Architecture App', 'Définir l''architecture de l''application', 2, 'in_progress', '2025-02-15'),
('Design UI Mobile', 'Créer le design de l''interface mobile', 2, 'todo', '2025-03-01'),
('Développement iOS', 'Développer la version iOS', 2, 'todo', '2025-04-01'),
('Développement Android', 'Développer la version Android', 2, 'todo', '2025-04-01'),

-- Tasks for Management System
('Analyse du système', 'Analyser le système actuel', 3, 'done', '2025-01-20'),
('Configuration Serveur', 'Configurer l''environnement serveur', 3, 'in_progress', '2025-02-01'),
('Développement Backend', 'Développer les APIs backend', 3, 'todo', '2025-03-01'),
('Formation Utilisateurs', 'Former les utilisateurs au nouveau système', 3, 'todo', '2025-04-15'),

-- Tasks for E-commerce Platform
('Étude de marché', 'Analyser le marché et la concurrence', 4, 'in_progress', '2025-03-15'),
('Architecture système', 'Définir l''architecture du système', 4, 'todo', '2025-04-01'),
('Intégration paiement', 'Intégrer les systèmes de paiement', 4, 'todo', '2025-05-01'),
('Tests de sécurité', 'Effectuer les tests de sécurité', 4, 'todo', '2025-06-01'),

-- Tasks for BI System
('Analyse des données', 'Analyser les sources de données existantes', 5, 'in_progress', '2025-02-20'),
('Conception ETL', 'Concevoir les processus ETL', 5, 'todo', '2025-03-15'),
('Développement Tableaux', 'Créer les tableaux de bord', 5, 'todo', '2025-04-15'),
('Tests Performance', 'Optimiser les performances', 5, 'todo', '2025-05-15'),

-- Tasks for DevOps
('Audit Infrastructure', 'Auditer l''infrastructure existante', 6, 'done', '2025-01-25'),
('Configuration CI/CD', 'Mettre en place les pipelines CI/CD', 6, 'in_progress', '2025-02-15'),
('Tests Automatisés', 'Implémenter les tests automatisés', 6, 'todo', '2025-03-10'),
('Documentation', 'Rédiger la documentation technique', 6, 'todo', '2025-04-01'),

-- Tasks for HR App
('Analyse Processus RH', 'Analyser les processus RH actuels', 7, 'in_progress', '2025-03-20'),
('Design Interface', 'Designer l''interface utilisateur', 7, 'todo', '2025-04-15'),
('Développement Core', 'Développer les fonctionnalités principales', 7, 'todo', '2025-05-15'),
('Intégration Paie', 'Intégrer le système de paie', 7, 'todo', '2025-06-15'),

-- Tasks for Training Platform
('Analyse Besoins Formation', 'Analyser les besoins en formation', 8, 'todo', '2025-04-15'),
('Création Contenu', 'Créer le contenu des formations', 8, 'todo', '2025-05-15'),
('Développement Plateforme', 'Développer la plateforme e-learning', 8, 'todo', '2025-06-15'),
('Tests Utilisateurs', 'Réaliser les tests utilisateurs', 8, 'todo', '2025-07-15');

-- Assign users to projects
INSERT INTO user_projects (user_id, project_id) VALUES
-- Website Redesign Team
(1, 1), (2, 1), (3, 1), (4, 1), (7, 1),
-- Mobile App Team
(2, 2), (3, 2), (4, 2), (6, 2), (8, 2),
-- Management System Team
(1, 3), (2, 3), (5, 3), (6, 3), (9, 3),
-- E-commerce Platform Team
(2, 4), (3, 4), (4, 4), (5, 4), (11, 4),
-- BI System Team
(5, 5), (7, 5), (9, 5), (11, 5),
-- DevOps Team
(1, 6), (3, 6), (6, 6), (9, 6),
-- HR App Team
(10, 7), (8, 7), (11, 7), (12, 7),
-- Training Platform Team
(2, 8), (4, 8), (7, 8), (12, 8);

-- Assign users to tasks
INSERT INTO task_users (task_id, user_id) VALUES
-- Website Redesign Tasks
(1, 2), (2, 4), (3, 3), (4, 3), (2, 7), (3, 7),
-- Mobile App Tasks
(5, 2), (6, 4), (7, 3), (8, 6), (7, 8), (8, 8),
-- Management System Tasks
(9, 5), (10, 6), (11, 3), (12, 2), (11, 9),
-- E-commerce Platform Tasks
(13, 2), (14, 3), (15, 6), (16, 5), (15, 11),
-- BI System Tasks
(17, 5), (18, 7), (19, 9), (20, 11),
-- DevOps Tasks
(21, 1), (22, 3), (23, 6), (24, 9),
-- HR App Tasks
(25, 10), (26, 8), (27, 11), (28, 12),
-- Training Platform Tasks
(29, 2), (30, 4), (31, 7), (32, 12);