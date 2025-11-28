-- Créer la base de données tpFinal
USE tpFinal;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Structure de la table `publication`
--
DROP TABLE publication;
CREATE TABLE publication (
  id int(11) NOT NULL,
  title varchar(100) NOT NULL,
  picture varchar(255) NOT NULL,
  description text,
  datetime varchar(30) NOT NULL,
  is_published tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


