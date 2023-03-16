-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 mars 2023 à 17:07
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myhotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230310130050', '2023-03-10 14:01:01', 25),
('DoctrineMigrations\\Version20230310140513', '2023-03-10 15:05:21', 13),
('DoctrineMigrations\\Version20230311104033', '2023-03-11 11:40:42', 24),
('DoctrineMigrations\\Version20230313093326', '2023-03-13 10:33:36', 71),
('DoctrineMigrations\\Version20230316084354', '2023-03-16 09:44:01', 25);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `rooms_id` int(11) NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `total` int(11) NOT NULL,
  `civility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `rooms_id`, `start_at`, `end_at`, `total`, `civility`, `lastname`, `firstname`, `phone`, `email`, `created_at`) VALUES
(1, 1, '2023-03-13', '2023-03-14', 0, 'Homme', 'Lebron', 'Julien', '06 66 84 29 26', 'lebron.pro.77@gmail.com', '2023-03-13 10:52:32'),
(2, 1, '2023-03-13', '2023-03-14', 400, 'Mr', 'Lebron', 'Julien', '06 66 84 29 26', 'lebron.pro.77@gmail.com', '2023-03-13 11:11:52'),
(3, 1, '2023-03-19', '2023-03-25', 2400, 'Mr', 'dza', 'dza', 'dazdza', 'dazdaz@dza.com', '2023-03-13 16:36:32'),
(4, 1, '2023-03-13', '2023-03-14', 400, 'Mr', 'ddza', 'daz', 'daz', 'dazdaz@gmail', '2023-03-13 16:37:55'),
(5, 4, '2023-03-17', '2023-03-19', 960, 'Mr', 'Lebron', 'Julien', '06 66 84 29 26', 'lebron.pro.77@gmail.com', '2023-03-13 18:40:15'),
(6, 5, '2023-03-16', '2023-03-17', 530, 'Mr', 'Lebron', 'Julien', '06 66 84 29 26', 'lebron.pro.77@gmail.com', '2023-03-16 09:21:35'),
(7, 1, '2023-03-16', '2023-03-17', 400, 'Mr', 'dazdaz', 'dazda', '00156151', 'dzadaz@gmail.com', '2023-03-16 09:23:26'),
(8, 1, '2023-03-17', '2023-03-19', 800, 'Mr', 'dzadza', 'dazda', '012561051', 'lebron.pro.77@gmail.com', '2023-03-16 09:26:30'),
(9, 1, '2023-03-16', '2023-03-17', 400, 'Mr', 'dazd', 'dza', 'dzadaz', 'dazd@gmail.com', '2023-03-16 09:27:37'),
(10, 6, '2023-03-16', '2023-03-17', 600, 'Mr', 'Bito', 'Marc', '0666842926', 'bito-marc@gmail.com', '2023-03-16 11:45:18'),
(11, 8, '2023-03-16', '2023-03-17', 670, 'Mr', 'Lebron', 'Julien', '0666842926', 'lebron@gmail.com', '2023-03-16 16:54:00');

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id`, `title`, `description`, `content`, `image`, `price`, `created_at`, `updated_at`, `capacity`, `area`, `category`) VALUES
(1, 'Classique', 'En plein cœur de Paris, profitez de l\'atmosphère chaleureuse qu\'offrent nos chambres Classique.', 'Élégamment décorées dans un style classique, les chambres Classiques sont claires et lumineuses pour un séjour reposant au cœur de la Ville Lumière. Vous pourrez profiter de tous les services de notre Boutique-Urban-Resort : piscine, hammam et salle de sport.', 'chambre-classique-640b3a4905e33359794851.webp', 400, '2023-03-10 15:10:16', '2023-03-10 15:10:16', 2, 25, 'Chambre'),
(3, 'Supérieur', 'Spacieuses et accueillantes, profitez en toute sérénité de tous les services de notre boutique-urban-resort dans nos chambre supérieures.', 'Claires et lumineuses, nos grandes chambres Supérieures sont décorées dans un style classique et disposent d’un beau volume. Vous avez accès à tous les services du Majestic Hotel-Spa : piscine, hammam et salle de sport.', 'chambre-superieur-640b3bd24764e587782215.webp', 430, '2023-03-10 15:16:50', '2023-03-10 15:16:50', 2, 30, 'Chambre'),
(4, 'Grande Deluxe', 'Reflets d\'espace et de bien-être, les chambres Grande Deluxe du Majestic Hôtel-SPA témoignent avec subtilité du luxe contemporain', 'Les chambres Grande Deluxe vous accueillent avec une décoration contemporaine et un design dans l’écrin d’une architecture typiquement parisienne avec de grandes hauteurs sous plafond, des moulures et un parquet en chêne. Leurs kitchenettes sont la touche finale du confort contemporain. Accès à tous les services de notre Boutique-Urban-Resort : piscine, hammam et salle de sport.', 'chambre-grande-deluxe-640b3c2578b7e501895249.webp', 480, '2023-03-10 15:18:13', '2023-03-10 15:18:13', 2, 35, 'Chambre'),
(5, 'Premium', 'En plein cœur de Paris, profitez de nos chambres Premiums recemment rénovées.', 'Élégamment rénovées en 2021 dans un style classique, les chambres Prémium sont claires et lumineuses pour un séjour reposant au cœur de la Ville Lumière. La salle de bain avec baignoire et douche à l\'italienne vous séduira.\r\n\r\nLe point de départ ideal pour un séjour au coeur des Champs-Elysées.', 'chambre-premium-640b3c6dc5280737661011.webp', 530, '2023-03-10 15:19:25', '2023-03-10 15:19:25', 2, 43, 'Chambre'),
(6, 'Junior', 'Avec leur grand espace salon, les suites junior offrent le confort idéal pour un excellent séjour à Paris. profitez de tous les services détente de notre boutique-urban-resort.', 'Véritable lieu de vie à la décoration contemporaine et design, les Suites Junior vous accueillent dans l’écrin d’une architecture typiquement parisienne avec de grandes hauteurs sous plafond, des moulures et un parquet en chêne. Grâce à leur kitchenette, vous vous sentirez assurément comme chez vous. Accès à tous les services de notre Boutique-Urban-Resort : piscine, hammam et salle de sport.', 'suite-junior-6412dce1546f0095158433.webp', 600, '2023-03-16 10:09:53', '2023-03-16 10:09:53', 4, 55, 'Suite'),
(7, 'Famille', 'Profitez de vos vacances à Paris dans nos spacieuses suites familiales.', 'Rénovées en 2021, décorées dans un style classique, les Suites Familles, claires et lumineuses, disposent de deux grandes chambres communicantes et de deux salles de bains rénovées avec baignoire et douche à l\'italienne. Le tout offrant un espace confortable et rare au cœur de Paris Après la découverte de Paris, vous pourrez profiter d’un moment de détente en famille.', 'suite-famille-6412dd2cc64ba233501325.webp', 630, '2023-03-16 10:11:08', '2023-03-16 10:11:08', 4, 85, 'Suite'),
(8, 'Prestige', 'Véritable appartement parisien au charme chic et élégant à deux pas des Champs-Élysées dans le très raffiné 16e arrondissement de paris.', 'Avec leurs hauts plafonds, leurs moulures et leurs parquets en chêne, les Suites Prestiges sont décorées dans un style typiquement parisien. Composées d\'une grande chambre, d\'un grand salon et d\'une kitchenette, elles ont la singularité de disposer d\'une cheminée. Accédez à tous les services de notre Boutique Urban Resort : piscine, hammam et salle de sport.', 'suite-prestige-6412dd62d8ea3213969145.webp', 670, '2023-03-16 10:12:02', '2023-03-16 10:12:02', 4, 85, 'Suite'),
(9, 'Terrasse', 'Faites une pause sur votre terrasse privative tout en profitant du confort d\'une suite 5 étoiles.', 'Composées d\'un grand salon s\'ouvrant sur une magnifique terrasse meublée, les Suites Terrasse disposent d\'une grande chambre et d\'une cuisine qui en font le parfait pied à terre à Paris. C’est aussi l’occasion de profiter de tous les services de notre Boutique-Urban-Resort : piscine, hammam et salle de sport.', 'suite-terrace-6412ddaf08718571625666.webp', 720, '2023-03-16 10:13:18', '2023-03-16 10:13:18', 4, 80, 'Suite'),
(10, 'Panoramique', 'Le parfait appartemment parisien avec terrasse composée de 2 chambres à deux pas des Champs-Élysée', 'La Suite Panoramique est une suite de 2 chambres et de deux salles de bain avec un grand salon et une véritable cuisine équipée, le tout ouvert sur une magnifique terrasse. La suite est décorée dans un style contemporain, avec de grandes hauteurs sous plafond, des moulures et un parquet en chêne. Accédez à tous les services de notre Boutique Urban Resort : piscine, hammam et salle de sport.', 'suite-panoramique-6412dde44b125524838357.webp', 770, '2023-03-16 10:14:12', '2023-03-16 10:14:12', 6, 105, 'Suite'),
(11, 'Majestic', 'Véritable penthouse à deux pas de l’Arc de Triomphe et des Champs-Élysées.', 'D’une superficie de 130 m2 à la décoration classique, la Suite Majestic possède les atouts et le charme d’un véritable appartement parisien composé de 2 chambres avec leur salle de bain indépendante, d’un grand salon et d’un bureau séparé, d’une cuisine équipée et de deux superbes terrasses aménagées. Accès à tous les services de notre Boutique-Urban-Resort : piscine, hammam et salle de sport.', 'suite-majestic2-6412de19db30b410690832.webp', 850, '2023-03-16 10:15:05', '2023-03-16 10:15:05', 6, 130, 'Suite');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`, `civility`, `birthday`, `created_at`) VALUES
(1, 'lebron.pro.77@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$PnmFf8QqThpDk/Si1YldYOG0jMfbFa//j0moP6opQB6KRqF71rUEq', 'Lebron', 'John', 'Homme', '1989-06-28 00:00:00', '2023-03-11 11:53:38'),
(2, 'david@gmail.com', '[]', '$2y$13$qA8tf5VChIVrKMrF0j.KL.AMZJLP0U7Rb7I1JaNBL97M9v3Uewg9m', 'Lebron', 'David', 'Homme', '1991-03-23 00:00:00', '2023-03-11 15:03:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F52993988E2368AB` (`rooms_id`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F52993988E2368AB` FOREIGN KEY (`rooms_id`) REFERENCES `room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
