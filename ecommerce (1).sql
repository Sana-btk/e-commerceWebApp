-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 jan. 2025 à 13:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `id_panier` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`id_panier`, `id_utilisateur`, `id_produit`, `quantite`) VALUES
(20, 18, 7, 2),
(21, 18, 4, 1),
(23, 6, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` float NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom`, `description`, `prix`, `categorie`, `image`) VALUES
(1, 'feuilles de basilic', 'Grains de basilic frais pour votre jardin.', 1000, 'Plantes', 'sweetYardsBasil.jpg'),
(2, 'Tondeuse sans fil', 'Tondeuse électrique sans fil pour un entretien facile.', 3000, 'Outils', 'TondeuseAGazonElectriqueSansFil.jpg'),
(3, 'outils de jardinage', 'Ensemble complet de 6 outils pour jardiner.', 2000, 'Outils', 'OutilsdeJardinage6PiècesEnsembleKitdOutils.jpg'),
(4, 'pots biodégradables', 'Set de 80 pots biodégradables pour plantes.', 980, 'Pots', 'Jaylan80PieceCelluloseFlowerpotSet.jpg'),
(5, 'Pelle', 'À la fois solide, légère et confortable, cette pelle est dotée dune lame de bonne taille à la pointe arrondie, qui senfonce bien dans les sols compacts et déplace de bonnes quantités de matière rapidement.', 7000, 'Outils', 'Pelleenacierinoxydableàmancheenbois.jpg'),
(6, 'Brouette', 'Cette brouette permet de transporter à la main divers types de matériaux en vrac ou des objets lourds et encombrants sur de courtes et moyennes distances.', 9000, 'Outils', 'Brouettebasculanteenmétalvert75Lt.jpg'),
(7, 'Couvercle Pot', 'Protection de sol pour pot de fleurs avec clous Grille pour pot de fleurs Couvercle de pot de fleurs Sécurité pour bébé Souris Protecteur de plantes Repousse les chats Jardin Ménage.', 1900, 'Pots', 'couvercle.jpg'),
(8, 'Lampes solaires dextérieur', 'Lampes solaires dextérieur, lot de 4 appliques murales solaires dextérieur.', 50000, 'Aménagement extérieur', 'lampesSolairesExt.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `adresse` text DEFAULT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `email`, `mot_de_passe`, `adresse`, `role`) VALUES
(6, 'ayaaaa', 'ayaboutkedjirt@gmail.com', '$2y$10$oVGxoJTMEf7BMD6yFug2/eqzqXIVsWrdljVJ.Btqe.PAWDWEfY/XC', 'bouzareah', 'client'),
(7, 'loulyy', 'louly@gmail.com', '$2y$10$N2FN5F6RVhWvw0HfmQ7ZfOZjjKmTI9IjyzpA87kTwvnH1xNQB/WHG', 'scala', 'client'),
(9, 'sanaaa', 'sana@gmail.com', '$2y$10$N2FN5F6RVhWvw0HfmQ7ZfOZjjKmTI9IjyzpA87kTwvnH1xNQB/WHG', 'elbiar', 'admin'),
(18, 'nadine', 'nadine@gmail.com', '$2y$10$WVIZyEWOnnzgDr5/Vu3ow.NlRaiMR2PlYQxzvUPhuK1xNKVYy5G1G', 'bouzareah', 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id_panier`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
