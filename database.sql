-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 28 nov. 2017 à 09:22
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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

-- --------------------------------------------------------

--
-- Structure de la table `actuators`
--

CREATE TABLE `actuators` (
  `id_actuator` int(9) NOT NULL,
  `name` varchar(250) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `id_user` int(9) NOT NULL,
  `id_room` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `building`
--

CREATE TABLE `building` (
  `id_building` int(9) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `familysensor`
--

CREATE TABLE `familysensor` (
  `id_familysensor` int(9) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(9) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles_users`
--

CREATE TABLE `roles_users` (
  `id_user` int(9) NOT NULL,
  `id_role` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id_room` int(9) NOT NULL,
  `name` varchar(250) NOT NULL,
  `id_accomodation` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `birthday` date NOT NULL,
  `phone_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Index pour la table `actuators`
--
ALTER TABLE `actuators`
  ADD PRIMARY KEY (`id_actuator`),
  ADD KEY `fk_2` (`id_room`),
  ADD KEY `fk_1` (`id_user`);

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
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `roles_users`
--
ALTER TABLE `roles_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `foreign_key_role` (`id_role`);

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
-- Contraintes pour la table `actuators`
--
ALTER TABLE `actuators`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

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
-- Contraintes pour la table `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `foreign_key_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_key_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

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
