-- Créer la base de données tpFinal
USE tpFinal;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Structure de la table `publication`
--
CREATE TABLE publication (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    picture VARCHAR(255) NOT NULL,
    description TEXT,
    datetime VARCHAR(30) NOT NULL,
    is_published BOOLEAN NOT NULL
);


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


