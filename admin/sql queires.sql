-- Table for slider images (multiple photos per slider)
CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL COMMENT 'Foreign key to slider table',
  `image_path` varchar(255) NOT NULL COMMENT 'Path to the image file',
  `image_order` int(11) DEFAULT 0 COMMENT 'Order of images',
  `is_cover` tinyint(1) DEFAULT 0 COMMENT '1 for cover photo, 0 for others',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `slider_id` (`slider_id`),
  CONSTRAINT `slider_images_ibfk_1` FOREIGN KEY (`slider_id`) REFERENCES `slider` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add a column to indicate if slider has multiple images
ALTER TABLE `slider` ADD COLUMN `has_multiple_images` tinyint(1) DEFAULT 0 AFTER `status`;



logo3 orginal file jpg



-- Create committee table
CREATE TABLE committees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    committee_name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create committee_members table (employee_name_designation is a single combined field)
CREATE TABLE committee_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    committee_id INT NOT NULL,
    employee_name_designation VARCHAR(255) NOT NULL COMMENT 'Combined field: Employee Name & Designation',
    role VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (committee_id) REFERENCES committees(id) ON DELETE CASCADE
);

-- Sample indexes for better performance
CREATE INDEX idx_committee_members_committee ON committee_members(committee_id);
CREATE INDEX idx_committee_name ON committees(committee_name);




-- Insert committees
INSERT INTO committees (committee_name) VALUES 
('Capital Works Advisory Committee (CWAC)'),
('Capital Works Monitoring Committee (CWMC)'),
('Academic Committee'),
('IT & Website Committee'),
('Sports Committee'),
('Transport Committee'),
('Security & Fire Safety Committee'),
('Guest House Management Committee (GHMC)'),
('Central Room Allotment Committee'),
('Internal Complaints Committee (ICC)'),
('MoU/MoA committee of ICMR-NIIRNCD, Jodhpur and MRHRU Jaipur'),
('Medical committee');

-- Assuming auto_increment ids start from 1 in the order inserted above

-- Insert members
-- CWAC members (committee_id = 1)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(1, 'Dr. Sandeep Kumar Yadav, Professor, Dept. of Electrical Engineering, IIT Jodhpur (Electrical Expert)', 'Chairperson'),
(1, 'Dr. Pardeep Kumar Dammala, Assistant Professor, Dept. of Civil & Infrastructure Engineering, IIT Jodhpur (Civil Expert)', 'External Member'),
(1, 'Dr. Manish Kumar, Professor, Dept. of Production & Industrial Engineering, MBM University, Jodhpur (Mechanical Expert)', 'External Member'),
(1, 'Dr. Rajesh Sharma, Head, Dept. of Architecture & T.P., MBM Jodhpur (Architect Expert)', 'External Member'),
(1, 'Prof. (Dr.) Pankaj Bhardwaj, Director, ICMR-NIIRNCD, Jodhpur', 'Member'),
(1, 'Dr. P. K. Anand, Scientist-F, NIIRNCD, Jodhpur', 'Member'),
(1, 'Sh. Dinesh Soni, Sr. Administrative Officer, NIIRNCD, Jodhpur', 'Member'),
(1, 'Sh. Om Prakash, Accounts Officer, NIIRNCD, Jodhpur', 'Member'),
(1, 'Dr. Anil Purohit, STO-III, NIIRNCD, Jodhpur', 'Member Secretary'),
(1, 'Representatives of the Executing Agency', 'Invitees');

-- CWMC members (committee_id = 2)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(2, 'Dr. P. K. Anand, Scientist-F, NIIRNCD', 'Chairperson'),
(2, 'Dr. Sandeep Kumar Yadav, Professor, IIT Jodhpur', 'External Member'),
(2, 'Dr. Rajesh Sharma, Head, Dept. of Architecture & T.P., MBM Jodhpur', 'External Member'),
(2, 'Sh. Dinesh Soni, Sr. Administrative Officer', 'Member'),
(2, 'Sh. Om Prakash, Accounts Officer', 'Member'),
(2, 'Dr. Anil Purohit, STO-III', 'Member Secretary'),
(2, 'Representatives of the Executing Agency', 'Invitees');

-- Academic Committee (committee_id = 3)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(3, 'Dr. P. K. Anand, Scientist-F', 'Chairperson'),
(3, 'Dr. Mukti Khetan, Scientist-C', 'Member'),
(3, 'Dr. Janesh Kumar Gautam, Scientist-C', 'Academic Officer & Member'),
(3, 'Dr. Rina Kumawat, Scientist-C', 'Member'),
(3, 'Sh. Utkarsh Trivedi, Technician-I', 'Member Secretary');

-- IT Committee (committee_id = 4)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(4, 'Dr. Ramesh Kumar Sangwan, Scientist-C', 'Chairperson'),
(4, 'Sh. Pankaj Kumar, TO-B', 'Member'),
(4, 'Sh. Rajnish Gupta, TO-A', 'Member'),
(4, 'Sh. Haresh Jadhav, Section Officer', 'Member'),
(4, 'Dr. Kanchan Bala, JHO', 'Member'),
(4, 'Sh. Manish Prajapati, TS (CS/IT)', 'Member Secretary');

-- Sports Committee (committee_id = 5)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(5, 'Dr. Ramesh Kumar Huda, Scientist-C', 'Chairperson'),
(5, 'Shri Haresh Jadhav, Section Officer', 'Member'),
(5, 'Ms. Shakshi Dahiya, Technical Assistant', 'Member'),
(5, 'Shri Bhanwar Manohar Singh, Technician-I', 'Member'),
(5, 'Shri Narendra Kumar, UDC', 'Member Secretary');

-- Transport Committee (committee_id = 6)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(6, 'Dr. P. K. Anand, Scientist-F', 'Chairperson'),
(6, 'Dr. Chet Ram Meena, TO-C', 'Member & Transport In-charge'),
(6, 'Ms. Shakshi Dahiya, TA', 'Member'),
(6, 'Sh. Haresh Jadhav, Section Officer', 'Member Secretary');

-- Security Committee (committee_id = 7)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(7, 'Dr. Suresh Yadav, Scientist-C', 'Chairperson'),
(7, 'Dr. Anil Purohit, STO-III', 'Member'),
(7, 'Shri K. L. Sharma, MSW', 'Member & Security In-charge'),
(7, 'Shri Chetan Singh Gohil, Technician-I (ES)', 'Member'),
(7, 'Shri Mayur Sankhala, Technician-I', 'Member Secretary');

-- Guest House Committee (committee_id = 8)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(8, 'Dr. Janesh Kumar Gautam, Scientist-C', 'Chairperson'),
(8, 'Dr. Kanchan Bala, Junior Health Officer', 'Member'),
(8, 'Mr. Trilok Kumar, Technician-I', 'Member'),
(8, 'Shri Pankaj Sharma, Personal Assistant', 'Member Secretary'),
(8, 'Sh. Rahul Ranjan, Lab Attendant', 'Member & Guest House Caretaker');

-- Central Room Allotment Committee (committee_id = 9)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(9, 'Prof. (Dr.) Pankaj Bhardwaj, Director', 'Chairperson'),
(9, 'Dr. P. K. Anand, Scientist-F', 'Member'),
(9, 'Dr. S. S. Mohanty, Scientist-F', 'Member'),
(9, 'Dr. Mukti Khetan, Scientist-C', 'Member'),
(9, 'Dr. Anil Purohit, STO-III', 'Member'),
(9, 'Shri Haresh Jadhav, Section Officer', 'Member Secretary');

-- ICC Committee (committee_id = 10)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(10, 'Dr. Mukti Khetan, Scientist-C, NIIRNCD', 'Chairperson'),
(10, 'Dr. Sunita Chaudhary, Director, Ek Khwahish Education Foundation, Sikar', 'Member'),
(10, 'Dr. Swati Chhabra, Addl. Professor of Anesthesiology, AIIMS, Jodhpur', 'Member'),
(10, 'Dr. Ramesh Kumar Sangwan, Scientist-C & Social Scientist, NIIRNCD', 'Member'),
(10, 'Ms. Sakshi Dahiya, Technical Assistant (Anthropology), NIIRNCD', 'Member'),
(10, 'Mr. K. C. Ramayya Dora, Administrative Officer, NIIRNCD', 'Member Secretary');

-- MoU/MoA Committee (committee_id = 11)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(11, 'Dr. Janesh Kumar Gautam, Scientist-C, NIIRNCD', 'Chairperson'),
(11, 'Dr. Mukti Khetan, Scientist-C, NIIRNCD', 'Co-Chairperson'),
(11, 'Sh. Pankaj Kumar, TО-В, NIIRNCD', 'Member Secretary'),
(11, 'Sr. Admin. Officer / Admin Officer, NIIRNCD', 'Member'),
(11, 'Accounts Officer, NIIRNCD', 'Member');

-- Medical Committee (committee_id = 12)
INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES
(12, 'Dr. P. K. Anand, Scientist-F, NIIRNCD, Jodhpur', 'Chairperson'),
(12, 'Dr. Janesh Kumar Gautam, Scientist-C, NIIRNCD', 'Member'),
(12, 'Dr. Rina Kumawat, Scientist-C, NIIRNCD', 'Member'),
(12, 'Sh. Haresh Jadhav, Section Officer', 'Member');




-- Create directors table (simplified)
CREATE TABLE directors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(500) DEFAULT NULL,
    service_from DATE NOT NULL,
    service_to DATE DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_service_period (service_from, service_to)
);






-- Run these SQL statements to update your admin table for enhanced security
ALTER TABLE `admin` 
ADD COLUMN `role` VARCHAR(50) DEFAULT 'admin' AFTER `Password`,
ADD COLUMN `is_active` TINYINT(1) DEFAULT 1 AFTER `role`,
ADD COLUMN `login_attempts` INT DEFAULT 0 AFTER `is_active`,
ADD COLUMN `last_login` DATETIME NULL AFTER `login_attempts`,
ADD COLUMN `last_failed_attempt` DATETIME NULL AFTER `last_login`,
ADD COLUMN `account_locked_until` DATETIME NULL AFTER `last_failed_attempt`;

-- Update existing passwords to use secure hashing (run this for each user)
-- First, get the plain text password from the user, then generate hash:
-- Example for password 'admin123':
-- UPDATE admin SET Password = '$2y$10$YourHashHere' WHERE UserName = 'admin';

-- Add login_attempts column if missing
ALTER TABLE admin 
ADD COLUMN IF NOT EXISTS login_attempts INT DEFAULT 0;

ALTER TABLE admin ADD session_token VARCHAR(255) DEFAULT NULL;


-- If no admin exists, create one

INSERT INTO admin (UserName, Password) 
VALUES ('adminncd', MD5('admin12345'));


CREATE TABLE IF NOT EXISTS `user_sessions` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `session_id` varchar(255) NOT NULL,
        `session_token` varchar(255) NOT NULL,
        `ip_address` varchar(45) DEFAULT NULL,
        `user_agent` text,
        `last_activity` datetime NOT NULL,
        `is_active` tinyint(1) DEFAULT 1,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `idx_user_id` (`user_id`),
        KEY `idx_session_token` (`session_token`),
        KEY `idx_is_active` (`is_active`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4