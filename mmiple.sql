-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 26 jan. 2025 à 09:00
-- Version du serveur : 5.7.39
-- Version de PHP : 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mmiple`
--

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`id`, `nom`, `adresse`, `cp`, `ville`) VALUES
(1, 'Blue Orange', '97 Impasse Jean Lamour', '54700', 'Pont-à-Mousson'),
(2, 'Matagot', '161 Rue Fernand Audeguil', '33000', 'Bordeaux'),
(3, 'Z-Man Games', '1995 Country Road B2W', '55113', 'Roseville'),
(4, 'Gigamic', '22 Rue Jean-Marie Bourguignon', '62930', 'Wimereux'),
(5, 'Asmodee', '18 Rue Jacqueline Auriol', '78280', 'Guyancourt'),
(6, 'Next Move Games', '50 Rue Ettore Bugatti', '76800', 'Saint-Etienne du Rouvray'),
(7, 'Iello', '9 Avenue des Erables', '54180', 'Heillecourt'),
(8, 'Repos Production', '22 Rue des Comédiens', '1000', 'Brussels');

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id`, `editeur_id`, `nom`, `duree`, `mini`, `maxi`, `photo1`, `photo2`, `photo3`, `prix`, `stock`) VALUES
(1, 1, 'Kingdomino', 30, 2, 4, 'kingdomino1.jpg', 'kingdomino2.jpg', 'kingdomino3.jpg', '20.99', 12),
(2, 3, 'Cacao', 45, 2, 4, 'cacao1.jpg', 'cacao2.jpg', 'cacao3.jpg', '33.00', 17),
(3, 2, 'Wingspan', 75, 1, 5, 'wingspan1.jpg', 'wingspan2.jpg', 'wingspan3.jpg', '60.00', 8),
(4, 4, 'Chasseurs de lÈgendes', 45, 2, 5, 'chasseurs1.jpg', 'chasseurs2.jpg', 'chasseurs3.jpg', '29.50', 7),
(5, 3, 'Carcassonne', 45, 2, 5, 'carcassonne1.jpg', 'carcassonne2.jpg', 'carcassonne3.jpg', '45.50', 21),
(6, 5, 'Azul', 45, 2, 4, 'azul1.jpg', 'azul2.jpg', 'azul3.jpg', '39.90', 31);

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, 'david@mail.com', '[]', '$2y$13$sQPcJ86OHicmLMz1zZPRouero8W69v9hNSy1FKx.AkcGSJ.Xpx942', 'Annebicque', 'David');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
