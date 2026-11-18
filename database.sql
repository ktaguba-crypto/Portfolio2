-- ============================================================
-- Portfolio_taguba - Database Schema & Seed Data
-- Database : db_tagubb
-- Owner    : Kirbe Dedicatoria Taguba (BSIT 4th Year, CSU - Piat)
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_tagubb
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE db_tagubb;

-- ------------------------------------------------------------
-- Main profile table (single row: id = 1)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tblkirby (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    job_title VARCHAR(150) DEFAULT 'Aspiring Web Developer',
    hero_title VARCHAR(200) DEFAULT 'Building Basic Websites',
    hero_subtitle VARCHAR(255) DEFAULT 'BSIT 4th Year student. Started from the basics, now building real web systems.',
    about_text TEXT,
    motto TEXT,
    email VARCHAR(150),
    phone VARCHAR(50),
    location VARCHAR(150),
    address VARCHAR(255),
    birthday VARCHAR(50),
    age INT,
    facebook_url VARCHAR(255),
    instagram_url VARCHAR(255),
    github_url VARCHAR(255),
    linkedin_url VARCHAR(255),
    profile_photo VARCHAR(255),
    resume_file VARCHAR(255),
    languages VARCHAR(255),
    hobbies VARCHAR(255),
    tools VARCHAR(255),
    open_to_ojt TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Projects
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    category ENUM('Web','Design','Capstone') NOT NULL DEFAULT 'Web',
    image VARCHAR(255),
    tech_stack VARCHAR(255),
    role VARCHAR(100),
    live_url VARCHAR(255),
    github_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Skills (grouped by category)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(100) NOT NULL,
    category ENUM('Frontend','Backend','Tools') NOT NULL DEFAULT 'Frontend',
    percentage INT NOT NULL DEFAULT 50 CHECK (percentage BETWEEN 0 AND 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Education / experience timeline
-- entry_type: 'Education' (schools) or 'Experience' (work/org)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entry_type VARCHAR(20) NOT NULL DEFAULT 'Education',
    school_name VARCHAR(200) NOT NULL,
    degree VARCHAR(200),
    period VARCHAR(100),
    status VARCHAR(100) DEFAULT 'Completed',
    description TEXT,
    sort_order INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Contact form messages
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Certificates
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    issuer VARCHAR(200),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Visitor counter (daily hits)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visit_date DATE NOT NULL UNIQUE,
    hits INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SEED DATA
-- ============================================================

-- Profile: Kirbe Dedicatoria Taguba
INSERT INTO tblkirby
    (full_name, job_title, hero_title, hero_subtitle, about_text, motto,
     email, phone, location, address, birthday, age,
     facebook_url, instagram_url, github_url, linkedin_url,
     profile_photo, resume_file, languages, hobbies, tools, open_to_ojt)
VALUES (
    'Kirbe Dedicatoria Taguba',
    'Aspiring Web Developer',
    'Building Basic Websites',
    'BSIT 4th Year student. Started from the basics, now building real web systems.',
    'My name is Kirbe D. Taguba from Maguilling, Piat, Cagayan. I am a 4th Year Bachelor of Science in Information Technology student at Cagayan State University - Piat Campus. I want to master Database Management and build web systems that help local communities.',
    'Just like a fish, you just keep swimming. Even if you struggle in life, you just continue and don''t stop.',
    'tagubakirby05@gmail.com',
    '09053585979',
    'Maguilling, Piat, Cagayan / Tuguegarao City',
    'Maguilling, Piat, Cagayan',
    'January 4, 2005',
    21,
    'https://www.facebook.com/share/1Bjwmh3YH4/?mibextid=wwXIfr',
    'https://www.instagram.com/kirbetaguba/',
    'https://github.com/Kirby123gwapo',
    '',
    'uploads/profile.jpg',
    '',
    'Tagalog, English, Ilocano, Itawes',
    'Coding, Gaming, Music',
    'Canva, Photoshop, VS Code, PPT, Excel, Word',
    1
);

-- Education timeline
INSERT INTO tbl_experience (entry_type, school_name, degree, period, status, description, sort_order) VALUES
('Education', 'Piat Central Elementary School', 'Elementary Education', 'Completed', 'Completed',
 'Completed my primary education at Piat Central Elementary School, building the foundation of my academic journey.', 1),
('Education', 'Our Lady of Piat High School, Inc.', 'Secondary Education (Senior High School)', 'Completed', 'Completed',
 'Completed secondary education at Our Lady of Piat High School, Inc., where I developed strong analytical and communication skills.', 2),
('Education', 'Cagayan State University - Piat Campus', 'BSIT - 4th Year', '2022 - Present', 'Currently 4th Year',
 'Currently in my 4th year of BS Information Technology at CSU - Piat Campus, Tuguegarao City. Ongoing - not yet graduated.', 3);

-- Experience: OJT / part-time / org
INSERT INTO tbl_experience (entry_type, school_name, degree, period, status, description, sort_order) VALUES
('Experience', 'BFAR Region 02', 'On-the-Job Training (OJT)', 'Nov 9 - Present', 'Ongoing',
 'Currently undergoing OJT at BFAR Region 02, gaining hands-on experience in a government work environment.', 1),
('Experience', 'Fishpond Caretaker', 'Part-time Work', 'Present', 'Ongoing',
 'Part-time fishpond caretaker responsible for daily maintenance and monitoring of fishpond operations.', 2),
('Experience', 'BSIT Department, CSU - Piat Campus', 'Board Member', 'Present', 'Ongoing',
 'Serves as a Board Member of the BSIT Department student organization, helping organize activities and events for IT students.', 3);

-- Projects (only real project)
INSERT INTO tbl_projects (title, description, category, image, tech_stack, role, live_url, github_url) VALUES
('Online Business Permit and Revenue Collection System for LGU Tuao',
 'Web-based system for LGU Tuao to make business permit application faster. Business owners can apply online, upload requirements, and track permit status. System also helps in Revenue Collection - it can compute fees, record payments, and generate reports so data is organized and accurate.',
 'Capstone', NULL, 'PHP, MySQL, HTML, CSS, JavaScript', 'Leader', '', '');

-- Skills
INSERT INTO tbl_skills (skill_name, category, percentage) VALUES
('PHP', 'Backend', 90),
('MySQL', 'Backend', 90),
('CSS', 'Frontend', 80),
('HTML', 'Frontend', 70),
('JavaScript', 'Frontend', 50),
('Excel / Data Encoding', 'Tools', 30),
('Photoshop', 'Tools', 30),
('Word / PPT', 'Tools', 30);

-- Certificates
INSERT INTO tbl_certificates (title, issuer, image) VALUES
('Leadership Award', 'Kleyn Baltazar (2021-2022)', NULL);
