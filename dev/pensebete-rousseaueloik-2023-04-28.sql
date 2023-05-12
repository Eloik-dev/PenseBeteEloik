-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 28 avr. 2023 à 13:09
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pensebete_rousseaueloik`
--
CREATE DATABASE IF NOT EXISTS `pensebete_rousseaueloik` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pensebete_rousseaueloik`;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `date_envoi` datetime DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `date_envoi`, `nom`, `email`, `objet`, `message`) VALUES
(1, '2023-03-31 09:13:07', 'dawdawd', 'edlokid@dawloaw.com', 'dawdawd', 'dawodawodkoawd'),
(2, '2023-03-31 09:21:30', 'dawdawd', 'edlokid@dawloaw.com', 'dawdawd', 'dawodawodkoawd'),
(3, '2023-03-31 09:22:56', 'dawdawd', 'edlokid@dawloaw.com', 'dawdawd', 'dawodawodkoawd'),
(4, '2023-03-31 09:23:17', 'dawdawd', 'edlokid@dawloaw.com', 'dawdawd', 'dawodawodkoawd'),
(5, '2023-03-31 09:23:32', 'dawdawd', 'dawda@adwawd.com', 'dawdadad', 'dawdwadawd'),
(6, '2023-03-31 09:24:02', 'dawdawd', 'dawda@adwawd.com', 'dawdadad', 'dawdwadawd'),
(7, '2023-03-31 09:29:55', 'Éloik Rousseau', 'eloik.rousseau@gmail.com', 'Demande de stage', 'Bonjour, j\'aimerais bien avoir un stage dans votre compagnie.\r\n\r\nMerci,\r\nÉloïk Rousseau'),
(8, '2023-03-31 09:31:42', 'dawdawda', 'dadwa@dadwa.com', 'dadwd', 'dawda');

-- --------------------------------------------------------

--
-- Structure de la table `eisenhower`
--

CREATE TABLE `eisenhower` (
  `id` int NOT NULL,
  `titre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eisenhower`
--

INSERT INTO `eisenhower` (`id`, `titre`) VALUES
(1, 'important et urgent'),
(2, 'important et non-urgent'),
(3, 'non-important et urgent'),
(4, 'non-important et non-urgent');

-- --------------------------------------------------------

--
-- Structure de la table `mentionsjaime`
--

CREATE TABLE `mentionsjaime` (
  `id` int NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mentionsjaime`
--

INSERT INTO `mentionsjaime` (`id`, `url`, `date`, `ip`, `commentaire`) VALUES
(1, 'index.php', '2023-04-28 08:44:59', '999.999.999.999', 'Quel magnifique site!'),
(2, 'index.php', '2023-04-28 09:04:30', '999.999.999.999', 'Vous avez réellement fait quelque chose de remarquable...');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int NOT NULL,
  `titre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dateajout` datetime NOT NULL,
  `datelimite` datetime DEFAULT NULL,
  `icone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eisenhower_id` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `titre`, `dateajout`, `datelimite`, `icone`, `eisenhower_id`, `description`) VALUES
(1, 'Examen science', '2023-02-21 16:28:59', '2050-05-21 00:00:00', NULL, NULL, 'Examen sur les sciences de la nature et de la vie'),
(2, 'Examen math', '2023-02-21 16:30:55', '2050-05-21 00:00:00', NULL, NULL, 'Examen sur les mathématiques qui conduisent le monde'),
(3, 'Examen médical', '2023-02-21 16:30:55', '2050-05-21 00:00:00', NULL, NULL, 'Examen vous donnant la possibilité de devenir médecin'),
(4, 'Examen de la vue', '2023-02-21 16:30:55', '2050-05-21 00:00:00', NULL, NULL, 'Examen vous donnant la vue d\'un dieu grecque'),
(5, 'Examen optométriste', '2023-02-21 16:30:55', '2050-05-21 00:00:00', NULL, NULL, 'Examen vous donnant la possibilité de devenir optométriste'),
(6, 'Examen de course à pied', '2023-02-21 16:30:55', '2050-05-21 00:00:00', NULL, NULL, 'Examen vous donnant la possibilité de découvrir si vous possédez en effet des jambes');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `note_id` int NOT NULL,
  `moment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `note_id`, `moment`) VALUES
(1, 1, '2023-03-02 15:15:00'),
(2, 4, '2023-03-03 09:00:00'),
(3, 2, '2023-02-24 16:00:00'),
(4, 6, '2023-02-27 08:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `titre` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `h1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL,
  `texte` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `modification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `url`, `titre`, `description`, `h1`, `public`, `texte`, `modification`) VALUES
(1, 'index.php', 'Remise | Gestion des dates de remise de travaux et d\'examens', 'Remise vous permet de gÃ©rer les dates de remise dans vos cours. Vous pouvez y noter votre horaire et vos travaux et examens dans chacun de vos cours.', 'Pour mieux gÃ©rer mon temps', 1, '', '2020-02-18 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `renseignements`
--

CREATE TABLE `renseignements` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `certificat_naissance` blob,
  `certificat_authentification` char(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_compte` blob,
  `date_naissance` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `renseignements`
--

INSERT INTO `renseignements` (`id`, `nom`, `mot_de_passe`, `certificat_naissance`, `certificat_authentification`, `numero_compte`, `date_naissance`) VALUES
(1, 'John Smith', 'f931c308fc5b60b421c09969912839dff2776957d98b8d2f91c554ed8fc80f78', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `usagers`
--

CREATE TABLE `usagers` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `nomfamille` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `courriel` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `motdepasse` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dernieracces` datetime DEFAULT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `usagers`
--

INSERT INTO `usagers` (`id`, `code`, `prenom`, `nomfamille`, `courriel`, `motdepasse`, `photo`, `dernieracces`, `actif`) VALUES
(1, '2236305', 'Éloïk', 'Rousseau', 'eloik.rousseau@gmail.com', '$2y$10$0fWlqwaRaO/q83Ejo0pxbOLDPpphD/Eh2ClJGJA1eTI0E8r83mHza', NULL, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eisenhower`
--
ALTER TABLE `eisenhower`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mentionsjaime`
--
ALTER TABLE `mentionsjaime`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notes_eisenhower` (`eisenhower_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Index pour la table `renseignements`
--
ALTER TABLE `renseignements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usagers`
--
ALTER TABLE `usagers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usagers_code_unique` (`code`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `eisenhower`
--
ALTER TABLE `eisenhower`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `mentionsjaime`
--
ALTER TABLE `mentionsjaime`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `renseignements`
--
ALTER TABLE `renseignements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `usagers`
--
ALTER TABLE `usagers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_eisenhower` FOREIGN KEY (`eisenhower_id`) REFERENCES `eisenhower` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
