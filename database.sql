-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 22 déc. 2017 à 10:45
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `elliot_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `accomodation`
--

CREATE TABLE `accomodation` (
  `id_accomodation` int(9) NOT NULL,
  `name` varchar(250) NOT NULL,
  `id_building` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `accomodation`
--

INSERT INTO `accomodation` (`id_accomodation`, `name`, `id_building`) VALUES
(1, 'Appartement 52', 1),
(2, 'Appartement 324', 2);

-- --------------------------------------------------------

--
-- Structure de la table `building`
--

CREATE TABLE `building` (
  `id_building` int(9) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `building`
--

INSERT INTO `building` (`id_building`, `name`) VALUES
(1, 'Building Champs-Elysées'),
(2, 'Building Issy-les-Moulineaux');

-- --------------------------------------------------------

--
-- Structure de la table `datasensors`
--

CREATE TABLE `datasensors` (
  `id_datasensor` int(9) NOT NULL,
  `date_time` date NOT NULL,
  `value` int(9) NOT NULL,
  `id_sensor` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `datasensors`
--

INSERT INTO `datasensors` (`id_datasensor`, `date_time`, `value`, `id_sensor`) VALUES
(1, '2017-12-16', 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `familysensor`
--

CREATE TABLE `familysensor` (
  `id_familysensor` int(9) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `familysensor`
--

INSERT INTO `familysensor` (`id_familysensor`, `name`) VALUES
(1, 'temperature'),
(2, 'barometer'),
(3, 'humidity'),
(4, 'luminosity'),
(5, 'motion');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `date` date NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `date`, `contenu`, `id_user`) VALUES
(1, '2017-12-01', 'La température est mal réglée', 1);

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id_room` int(9) NOT NULL,
  `name` varchar(250) NOT NULL,
  `id_accomodation` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id_room`, `name`, `id_accomodation`) VALUES
(1, 'diningroom', 2),
(3, 'bedroom', 2),
(4, 'bedroom', 2),
(5, 'kitchen', 2),
(6, 'livingroom', 2),
(7, 'bathroom', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sensors`
--

CREATE TABLE `sensors` (
  `id_sensor` int(9) NOT NULL,
  `name` varchar(250) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `id_familysensor` int(9) NOT NULL,
  `id_user` int(9) NOT NULL,
  `id_room` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sensors`
--

INSERT INTO `sensors` (`id_sensor`, `name`, `state`, `id_familysensor`, `id_user`, `id_room`) VALUES
(1, 'Sensor A', 0, 1, 2, 1),
(2, 'Sensor B', 1, 1, 2, 3),
(3, 'Sensor C', 1, 3, 2, 3),
(4, 'Sensor D', 1, 5, 2, 4),
(5, 'Sensor E', 1, 2, 2, 4),
(6, 'Sensor F', 1, 3, 2, 4),
(7, 'Sensor G', 1, 3, 2, 5),
(8, 'Sensor H', 1, 1, 2, 5),
(9, 'Sensor I', 1, 4, 2, 5),
(10, 'Sensor J', 1, 2, 2, 5),
(11, 'klj', 1, 2, 2, 6),
(12, 'cds', 1, 4, 2, 6),
(13, 'iohuyuvbhjn', 1, 3, 2, 7),
(3456789, 'kjhgcftègh', 1, 5, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(9) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `birthday` varchar(250) NOT NULL,
  `phone_number` int(10) DEFAULT NULL,
  `roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `last_name`, `first_name`, `mail`, `password`, `birthday`, `phone_number`, `roles`) VALUES
(1, 'Elliot', '', 'elliot@elliot.com', '65f1aaaa901a3080e06ad50869a72a8b85190dad', '2017-09-09', NULL, 0),
(2, 'Martin', 'Lambda', 'lambda@gmail.com', '7c6a61c68ef8b9b6b061b28c348bc1ed7921cb53', '1997-01-01', NULL, 1),
(19455174, 'Vavelin', 'Florian', 'root@root.fr', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', '2017-12-16', 987462829, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accomodation`
--
ALTER TABLE `accomodation`
  ADD PRIMARY KEY (`id_accomodation`),
  ADD KEY `foreign_key_accomodation` (`id_building`);

--
-- Index pour la table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id_building`);

--
-- Index pour la table `datasensors`
--
ALTER TABLE `datasensors`
  ADD PRIMARY KEY (`id_datasensor`),
  ADD KEY `foreign_key_datasensors` (`id_sensor`);

--
-- Index pour la table `familysensor`
--
ALTER TABLE `familysensor`
  ADD PRIMARY KEY (`id_familysensor`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fk_message_user` (`id_user`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `foreign_key_room` (`id_accomodation`);

--
-- Index pour la table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id_sensor`),
  ADD KEY `foreign_key_sensor_familySensor` (`id_familysensor`),
  ADD KEY `foreign_key_sensor_user` (`id_user`),
  ADD KEY `foreign_key_sensor_room` (`id_room`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accomodation`
--
ALTER TABLE `accomodation`
  ADD CONSTRAINT `foreign_key_accomodation` FOREIGN KEY (`id_building`) REFERENCES `building` (`id_building`) ON DELETE CASCADE;

--
-- Contraintes pour la table `datasensors`
--
ALTER TABLE `datasensors`
  ADD CONSTRAINT `foreign_key_datasensors` FOREIGN KEY (`id_sensor`) REFERENCES `sensors` (`id_sensor`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `foreign_key_room` FOREIGN KEY (`id_accomodation`) REFERENCES `accomodation` (`id_accomodation`);

--
-- Contraintes pour la table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `foreign_key_sensor_familySensor` FOREIGN KEY (`id_familysensor`) REFERENCES `familysensor` (`id_familysensor`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_key_sensor_room` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_key_sensor_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
