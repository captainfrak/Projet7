-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 27 fév. 2020 à 13:44
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_bilemo`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `password`, `roles`) VALUES
(1, 'SFR', 'client@sfr.fr', '$2y$13$E66Tor3vctC06sF2uASGC.9dDFCXu3l1xkDwUc6PQXlzxmXsn0KC2', '[\"ROLE_ADMIN\"]'),
(5, 'orange', 'client@orange.fr', '$2y$13$E66Tor3vctC06sF2uASGC.9dDFCXu3l1xkDwUc6PQXlzxmXsn0KC2', '[\"ROLE_ADMIN\"]'),
(6, 'bouygues', 'client@bouygues.fr', '$2y$13$E66Tor3vctC06sF2uASGC.9dDFCXu3l1xkDwUc6PQXlzxmXsn0KC2', '[\"ROLE_ADMIN\"]');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200121143853', '2020-01-21 14:39:14'),
('20200121145026', '2020-01-21 14:50:37'),
('20200203170408', '2020-02-03 17:04:29'),
('20200226211240', '2020-02-26 21:12:59'),
('20200226212527', '2020-02-26 21:25:31');

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specs` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `phone`
--

INSERT INTO `phone` (`id`, `name`, `specs`, `price`) VALUES
(1, 'Iphone 8', 'blah blah', 60),
(2, 'Iphone X', 'blouh blouh', 999),
(3, 'Iphone 11', 'blah blah blouh', 600);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `client_id`) VALUES
(6, 'test233@bilemo.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$Vy5KNlNHMWkzVm1GMTNSQg$qEATi46IYYtlHXhnjMLweAfxCkNKMIpFcQ9h7YjlGsw', 5),
(7, 'test222@bilemo.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$bDdJc3VHVFVUNDJhQkxYTA$GT2N70jx8KC3TcM9Ea1ErXv0J3D7WztKNpnX3GHJBig', 1),
(9, 'test5@bilemo.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$VmR5OVZYU2hTRTQ2WkhjWg$YMZSpRSK18Z+SNfngaNzwos0ukiXafPfMNk39TKB2B8', 1),
(13, 'testt5tt@bilemo.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$ZDF6QkYvYlFMVlZ5WnN6Uw$gg8QP6MUDoCQ7guxlQFvQb5PXjPKD8Ioeh5W7tQ5MVo', 1),
(14, 'testtcvb5tt@bilemo.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$WGVoa1lycnk5NFlKMy5CMg$ClWioL+rtcjOEroEuC0gyvGyIdg0x/Q620y3EuhbpEo', 1),
(15, 'test@bilemo.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$MVlsOGttQmZxZFBvZWp1SA$bz2gOdxobn5irdUOWxZK1fHDyHw1cnLZAX0a93AN6hM', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_444F97DD5E237E06` (`name`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D64919EB6921` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
