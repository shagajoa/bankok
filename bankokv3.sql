-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 06 jan. 2019 à 00:54
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

CREATE DATABASE bankok
CHARACTER SET utf8
COLLATE utf8_bin;

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `account_rib` varchar(23) COLLATE utf8_bin DEFAULT NULL,
  `account_balance` int(10) DEFAULT NULL,
  `account_overdraft` int(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_status` enum('pending','valide','rejected') COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `add_id` int(11) NOT NULL,
  `add_number` int(5) NOT NULL,
  `add_street` varchar(50) COLLATE utf8_bin NOT NULL,
  `add_postal_code` int(5) NOT NULL,
  `add_city` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `benef_id` int(11) NOT NULL,
  `account_id_1` int(11) DEFAULT NULL,
  `account_id_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE `operations` (
  `ope_id` int(11) NOT NULL,
  `ope_method` enum('transfer','check') COLLATE utf8_bin DEFAULT NULL,
  `ope_amount` int(10) DEFAULT NULL,
  `ope_way` enum('debit','credit') COLLATE utf8_bin DEFAULT NULL,
  `ope_date` date DEFAULT NULL,
  `ope_acc_id_1` int(11) DEFAULT NULL,
  `ope_acc_id_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `benef_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operations`
--
ALTER TABLE `operations`
  MODIFY `ope_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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
