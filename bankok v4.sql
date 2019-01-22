-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 15 jan. 2019 à 15:03
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bankok`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `account_type` enum('Courant','Epargne') COLLATE utf8_bin DEFAULT NULL,
  `account_rib` varchar(23) COLLATE utf8_bin DEFAULT NULL,
  `account_balance` int(10) DEFAULT NULL,
  `account_overdraft` int(10) DEFAULT NULL,
  `account_user_id` int(11) DEFAULT NULL,
  `account_status` enum('pending','valide','rejected') COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_type`, `account_rib`, `account_balance`, `account_overdraft`, `account_user_id`, `account_status`) VALUES
(1, 'Courant', 'Courant', '3E3JF6OGSZISPJ9UKJDK43K', -9695, 200, 1, 'valide'),
(3, 'Courant', 'Courant', '65QGTJLXY3XYNZUCPOP9PRG', 21829, 500, 15, 'valide'),
(4, 'Epargne', 'Epargne', 'KBTRJI5TGTL076G6GVC0VYT', 555, 500, 15, 'pending'),
(5, 'Livret A', 'Epargne', 'RRLFTTF2YW57ZIU6QOW4COI', 12468, 500, 15, 'valide'),
(6, 'Livret B', 'Epargne', 'J4T8Z2B9FX7YZ49CVEY7THW', -400, 500, 15, 'pending'),
(8, 'Epargne anais', 'Epargne', 'O91EH3VXFJ8L9QTTU2WHSF1', 500, 500, 1, 'valide'),
(11, 'Courant3', 'Courant', 'BVNETTOJVQ3990K5JXW1FN4', 0, 500, 15, 'valide'),
(12, 'PEL', 'Epargne', 'X0UBMMHBWBQKNTU66K11YRE', 67000, 500, 15, 'pending'),
(13, 'Courant2', 'Courant', 'AZERTYUIOPMLKJHGFDSQWXC', 1000, 500, 1, 'valide');

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `add_id` int(11) NOT NULL,
  `add_number` int(5) NOT NULL,
  `add_street` varchar(50) COLLATE utf8_bin NOT NULL,
  `add_postal_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `add_city` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`add_id`, `add_number`, `add_street`, `add_postal_code`, `add_city`) VALUES
(1, 5, 'boulevard de l\'opéra', '75008', 'PARIS'),
(2, 8, 'rue aubervilliers', '92800', 'PUTEAUX'),
(5, 8, 'rue de l\'oasis', '92800', 'PUTEAUX'),
(6, 18, 'Rue poittier', '92200', 'Neuilly sur seine'),
(7, 12, 'rue nui truc', '92100', 'Quelque part'),
(8, 45, 'Rue chevalier', '92200', 'Neuilly sur seine'),
(9, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(10, 56, 'Boulevard de la saussaye', '92', 'Neuilly sur seine'),
(11, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(12, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(13, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(14, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(15, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(16, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(17, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(18, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(19, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine'),
(20, 56, 'Boulevard de la saussaye', '92200', 'Neuilly sur seine');

-- --------------------------------------------------------

--
-- Structure de la table `agencies`
--

CREATE TABLE `agencies` (
  `agency_id` int(11) NOT NULL,
  `agency_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `agency_password` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `add_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `agencies`
--

INSERT INTO `agencies` (`agency_id`, `agency_name`, `agency_password`, `add_id`) VALUES
(1, 'PARIS', '1234567890', 1),
(2, 'PUTEAUX', '0987654321', 2);

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `benef_id` int(11) NOT NULL,
  `account_id_1` int(11) DEFAULT NULL,
  `account_id_2` int(11) DEFAULT NULL,
  `benef_status` enum('pending','valide','rejected') COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `beneficiaries`
--

INSERT INTO `beneficiaries` (`benef_id`, `account_id_1`, `account_id_2`, `benef_status`) VALUES
(17, 3, 11, 'rejected'),
(18, 11, 5, 'valide'),
(19, 5, 3, 'pending'),
(20, 5, 11, 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE `operations` (
  `ope_id` int(11) NOT NULL,
  `ope_method` enum('transfer','check') COLLATE utf8_bin DEFAULT NULL,
  `ope_amount` int(10) DEFAULT NULL,
  `ope_date` date DEFAULT NULL,
  `ope_acc_id_1` int(11) DEFAULT NULL,
  `ope_acc_id_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `operations`
--

INSERT INTO `operations` (`ope_id`, `ope_method`, `ope_amount`, `ope_date`, `ope_acc_id_1`, `ope_acc_id_2`) VALUES
(1, 'transfer', 500, '2019-01-13', 3, 4),
(4, 'transfer', 111, '2019-01-13', 3, 4),
(6, 'transfer', 45, '2019-01-13', 3, 4),
(7, 'transfer', 150, '2019-01-13', 3, 1),
(8, 'transfer', 125, '2019-01-14', 1, 3),
(9, 'transfer', 12345, '2019-01-14', 1, 3),
(10, 'transfer', 1500, '2019-01-14', 8, 1),
(11, 'transfer', 111, '2019-01-14', 3, 4),
(12, 'transfer', 123, '2019-01-15', 11, 5);

-- --------------------------------------------------------

--
-- Structure de la table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_id` int(11) NOT NULL,
  `payment_method` enum('check','credit card') COLLATE utf8_bin DEFAULT NULL,
  `payment_serial_number` int(25) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `payment_date_order` date DEFAULT NULL,
  `payment_status` enum('pending','valide','rejected') COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_last_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_first_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_password` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `user_phone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `user_date_of_birth` date DEFAULT NULL,
  `user_active` tinyint(1) DEFAULT '1',
  `add_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_last_name`, `user_first_name`, `user_email`, `user_password`, `user_phone`, `user_date_of_birth`, `user_active`, `add_id`, `agency_id`) VALUES
(1, 'BERNARD', 'AnaÃ¯s', 'xxx@hotmail.com', '$2y$10$nBw6EYQlWVr4aarjK/e2Ge.ccGvev67cmJnGpl2Cl2d6rie.uL2ti', '0987654321', '1996-05-24', 1, 5, 1),
(2, 'Billard', 'Corentin', 'coco@gmail.com', '$2y$10$aNzGIwejKjw09e0AqSAjwOX91mW/klY2jKJWV5fK.mAyN994bnSuu', '0987654321', '1995-11-12', 1, 6, 1),
(3, 'Bernard', 'Pascal', 'papa@hotmail.fr', '$2y$10$OvikANSSVxQmlzgqqTyxluHpQIGFn/Ymb90pKd5EZ.VoKp9NjuD4a', '0987654321', '1958-04-17', 1, 7, 1),
(4, 'BERNARD', 'AurÃ©lie', 'aur@hotmail.fr', '$2y$10$AIdz70oPc0bbFiAclHrK0e6FLGibJbFq/7r07/gD44WnwV0YYQ1U6', '0987654321', '1999-02-19', 1, 8, 1),
(15, 'VIEL', 'ValÃ©rie', 'val@hotmail.fr', '$2y$10$eRVM1Zu6MkA.slgKXWLSeuF18xLqSNVULURz1G139OYj6B4BFprlC', '0987654321', '1960-02-03', 1, 20, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`account_user_id`);

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`add_id`);

--
-- Index pour la table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`agency_id`),
  ADD KEY `add_id` (`add_id`);

--
-- Index pour la table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`benef_id`),
  ADD KEY `account_id_1` (`account_id_1`),
  ADD KEY `account_id_2` (`account_id_2`);

--
-- Index pour la table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`ope_id`),
  ADD KEY `ope_acc_id_1` (`ope_acc_id_1`),
  ADD KEY `ope_acc_id_2` (`ope_acc_id_2`);

--
-- Index pour la table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `add_id` (`add_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `benef_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `operations`
--
ALTER TABLE `operations`
  MODIFY `ope_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`account_user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `agencies`
--
ALTER TABLE `agencies`
  ADD CONSTRAINT `agencies_ibfk_1` FOREIGN KEY (`add_id`) REFERENCES `adresses` (`add_id`);

--
-- Contraintes pour la table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_ibfk_1` FOREIGN KEY (`account_id_1`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `beneficiaries_ibfk_2` FOREIGN KEY (`account_id_2`) REFERENCES `accounts` (`account_id`);

--
-- Contraintes pour la table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`ope_acc_id_1`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `operations_ibfk_2` FOREIGN KEY (`ope_acc_id_2`) REFERENCES `accounts` (`account_id`);

--
-- Contraintes pour la table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`add_id`) REFERENCES `adresses` (`add_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;