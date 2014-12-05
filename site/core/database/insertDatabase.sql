-- -----------------------------------------------------
-- Data for table `Nuitdelinfo2014`.`Type`
-- -----------------------------------------------------
START TRANSACTION;
USE `Nuitdelinfo2014`;
INSERT INTO `Nuitdelinfo2014`.`Type` (`idType`, `libelle`) VALUES (0, 'Public');
INSERT INTO `Nuitdelinfo2014`.`Type` (`idType`, `libelle`) VALUES (1, 'ONG');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Nuitdelinfo2014`.`Refuge`
-- -----------------------------------------------------
START TRANSACTION;
USE `Nuitdelinfo2014`;
INSERT INTO `Nuitdelinfo2014`.`Refuge` (`idRefuge`, `GPS`) VALUES (1,'N48 51.39827 E2 21.13445');
INSERT INTO `Nuitdelinfo2014`.`Refuge` (`idRefuge`, `GPS`) VALUES (2,'N50 51.02621 E4 21.10164');
INSERT INTO `Nuitdelinfo2014`.`Refuge` (`idRefuge`, `GPS`) VALUES (3,'N35 41.39639 E139 41.50199');
INSERT INTO `Nuitdelinfo2014`.`Refuge` (`idRefuge`, `GPS`) VALUES (4,'S8 24.56255 E115 11.33387');
INSERT INTO `Nuitdelinfo2014`.`Refuge` (`idRefuge`, `GPS`) VALUES (5,'S2 52.30332 E23 31.96289');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Nuitdelinfo2014`.`User`
-- -----------------------------------------------------
START TRANSACTION;
USE `Nuitdelinfo2014`;
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (1,'Haddock', sha1('haddock'),'c.haddock@br.br',NULL,0);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (2,'Hiromu', sha1('hiromu'),'h@japan.jp',NULL,0);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (3,'Naruto',sha1('naruto'),'naruto@japan.jp',NULL,0);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (4,'ONGParis',sha1('paris'),'p@p.paris',1,1);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (5,'ONGBruxelles',sha1('bruxelles'),'b@b.bruxelles',2,1);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (6,'ONGTokyo',sha1('tokyo'),'t@t.tokyo',3,1);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (7,'ONGKonoha',sha1('konoha'),'k@k.konoha',4,1);
INSERT INTO `Nuitdelinfo2014`.`User` (`idUser`, `login`, `pwd`, `email`, `Refuge_idRefuge`, `Type_idType`) VALUES (8,'ONGBali',sha1('bali'),'bali@balo.lol',5,1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `Nuitdelinfo2014`.`Profil`
-- -----------------------------------------------------
START TRANSACTION;
USE `Nuitdelinfo2014`;
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (1, 'Jean', 'Valjean', 'roux 63kg 1m60 ', 'paris', '0606060606', 1, NULL);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (2, 'Eugène', 'Rastignac', '60kg 1m73 brun yeux bleu', 'paris', '0607080910', 1, NULL);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (3, 'Tintin', 'Milou', '1m02 112kg blanc houpette roux', 'bruxelles', '0611223344', 2, NULL);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (4, 'Capitaine', 'Haddock', 'juron barbe brun grand marin', 'bruxelles', NULL, 2, 1);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (5, 'Professeur', 'Tournesol', 'fou petit taré cintré', 'bruxelles', '0512131415', 2, NULL);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (6, 'Hiromu', 'Arakawa', 'japonaise matte brune bridée mangaka', 'tokyo', NULL, 3, 2);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (7, 'Masashi', 'Kishimoto', 'japonais mangaka naruto blond moustache', 'tokyo', '0699887766', 3, NULL);
INSERT INTO `Nuitdelinfo2014`.`Profil` (`idProfil`, `nom`, `prenom`, `descPhysique`, `localisation`, `telephone`, `Refuge_idRefuge`, `User_idUser`) VALUES (8, 'Naruto', 'Uzumaki', 'japonais kyubi rasengan megafort', 'konoha', '0111111111', 4, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Nuitdelinfo2014`.`Recherche`
-- -----------------------------------------------------
START TRANSACTION;
USE `Nuitdelinfo2014`;
INSERT INTO `Nuitdelinfo2014`.`Recherche` (`idRecherche`, `keywordDesc`, `keywordLoc`, `nom`, `prenom`, `User_idUser`) VALUES (1,'roux','paris tokyo bruxelles', NULL, NULL,1);
INSERT INTO `Nuitdelinfo2014`.`Recherche` (`idRecherche`, `keywordDesc`, `keywordLoc`, `nom`, `prenom`, `User_idUser`) VALUES (2,'megafort',NULL, NULL, NULL,2);
INSERT INTO `Nuitdelinfo2014`.`Recherche` (`idRecherche`, `keywordDesc`, `keywordLoc`, `nom`, `prenom`, `User_idUser`) VALUES (3,NULL,NULL, 'Masashi', 'Kishimoto',3);
INSERT INTO `Nuitdelinfo2014`.`Recherche` (`idRecherche`, `keywordDesc`, `keywordLoc`, `nom`, `prenom`, `User_idUser`) VALUES (4,'blond',NULL, NULL, NULL,8);

COMMIT;
