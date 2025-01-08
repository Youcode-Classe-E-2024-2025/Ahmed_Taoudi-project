/* create database*/

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS teamflow;
USE teamflow;

-- Roles table
CREATE TABLE IF NOT EXISTS roles (
    name VARCHAR(50) PRIMARY KEY,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert default roles
INSERT INTO roles (name, description) VALUES

('admin', 'System administrator with full access'),

('manager', 'can read and create and edit tasks of a project and add or delete a membre and change 
the role of membre '),

('membre', 'default membre of project'),

('rwe', 'can read and create and edit tasks of a project'),

('r-e', 'can read and edit'),

('rwe_add', 'can read and create and edit tasks of a project and add new membre '),

('rwe_rm', 'can read and create and edit tasks of a project and delete a membre '),

('rwe_addrm', 'can read and create and edit tasks of a project and add or delete a membre ')
;


-- Permissions table
CREATE TABLE IF NOT EXISTS permission (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
-- Insert default Permissions 
INSERT INTO permission (name, description) VALUES

('read' , 'read tasks'), /* 1 */

('write' , 'create tasks'),/* 2 */

('edit' , 'edit tasks'),/* 3 */

('addMembre' , 'add new membre to the project'),/* 4 */

('removeMembre' , 'remove membre from a project'),/* 5 */

('changeRole' , 'change the role of membre for a project')/* 6 */
;


-- role_permission table
CREATE TABLE IF NOT EXISTS role_permission (
    role VARCHAR(100) NOT NULL,
    permission INT NOT NULL,
    PRIMARY KEY (role, permission),
    FOREIGN KEY (role) REFERENCES roles(name) ON DELETE CASCADE,
    FOREIGN KEY (permission) REFERENCES permission(id) ON DELETE CASCADE
);

-- Insert default role_permission 
INSERT INTO role_permission (role, permission) VALUES

('manager' , 1), ('manager' , 2), ('manager' , 3), ('manager' , 4),('manager' , 5),('manager' , 6),

('membre' , 1), 

('rwe' , 1), ('rwe' , 2), ('rwe' , 3),

('r-e' , 1), ('r-e' , 3), 

('rwe_add' , 1), ('rwe_add' , 2), ('rwe_add' , 3), ('rwe_add' , 4),

('rwe_rm' , 1), ('rwe_rm' , 2), ('rwe_rm' , 3), ('rwe_rm' , 5),

('rwe_addrm' , 1), ('rwe_addrm' , 2), ('rwe_addrm' , 3), ('rwe_addrm' , 4), ('rwe_addrm' , 5)
;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- Projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    status ENUM('planning', 'in_progress', 'completed') DEFAULT 'planning',
    visibility ENUM('public', 'private') DEFAULT 'private',
    created_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- Tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    project_id INT NOT NULL,
    category_id INT,
    status ENUM('todo', 'in_progress', 'review', 'done') DEFAULT 'todo',
    due_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);



-- Tags table
CREATE TABLE IF NOT EXISTS tags (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- User-Project relationship table
CREATE TABLE IF NOT EXISTS user_projects (
    user_id INT NOT NULL,
    project_id INT NOT NULL,
    role_name VARCHAR(100) NOT NULL DEFAULT 'membre',
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, project_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_name) REFERENCES roles(name) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);
-- Task-User relationship table
CREATE TABLE IF NOT EXISTS task_users (
    task_id INT NOT NULL,
    user_id INT NOT NULL,
    assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (task_id, user_id),
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Task-Tags relationship table
CREATE TABLE IF NOT EXISTS task_tags (
    task_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (task_id, tag_id),
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);