TYPE=VIEW
query=select `l`.`titre_livre` AS `titre_livre`,`l`.`resume` AS `resume`,`l`.`nombre_page` AS `nombre_page`,`l`.`image` AS `image`,`e`.`nom_e` AS `nom_e`,`e`.`adresse_e` AS `adresse_e`,`g`.`nom_genre` AS `nom_genre`,`a`.`nom_a` AS `nom_a`,`a`.`prenom` AS `prenom`,`v`.`code_postal` AS `code_postal`,`v`.`ville` AS `ville`,`ex`.`integrite_du_livre` AS `integrite_du_livre`,`u`.`pseudo` AS `pseudo`,`u`.`email` AS `email` from ((((((((`filrougev3`.`livre` `l` join `filrougev3`.`editeur` `e` on((`l`.`id_editeur` = `e`.`id_editeur`))) join `filrougev3`.`genre` `g` on((`g`.`id_genre` = `l`.`id_genre`))) join `filrougev3`.`ecrit` `ec` on((`ec`.`isbn` = `l`.`isbn`))) join `filrougev3`.`auteur` `a` on((`a`.`id_auteur` = `ec`.`id_auteur`))) join `filrougev3`.`exemplaire` `ex` on((`ex`.`isbn` = `l`.`isbn`))) join `filrougev3`.`posseder` `p` on((`p`.`id_exemplaire` = `ex`.`id_exemplaire`))) join `filrougev3`.`users` `u` on((`u`.`id` = `p`.`id`))) join `filrougev3`.`ville` `v` on((`u`.`id_ville` = `v`.`id_ville`)))
md5=2a88f6dee5e17f17e32f427757510b07
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2021-05-19 09:59:54
create-version=1
source=SELECT l.titre_livre, l.resume, l.nombre_page, l.image, e.nom_e, e.adresse_e, g.nom_genre, a.nom_a, a.prenom, v.code_postal, v.ville, ex.integrite_du_livre, u.pseudo, u.email FROM livre l JOIN editeur  e ON l.id_editeur = e.id_editeur
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `l`.`titre_livre` AS `titre_livre`,`l`.`resume` AS `resume`,`l`.`nombre_page` AS `nombre_page`,`l`.`image` AS `image`,`e`.`nom_e` AS `nom_e`,`e`.`adresse_e` AS `adresse_e`,`g`.`nom_genre` AS `nom_genre`,`a`.`nom_a` AS `nom_a`,`a`.`prenom` AS `prenom`,`v`.`code_postal` AS `code_postal`,`v`.`ville` AS `ville`,`ex`.`integrite_du_livre` AS `integrite_du_livre`,`u`.`pseudo` AS `pseudo`,`u`.`email` AS `email` from ((((((((`filrougev3`.`livre` `l` join `filrougev3`.`editeur` `e` on((`l`.`id_editeur` = `e`.`id_editeur`))) join `filrougev3`.`genre` `g` on((`g`.`id_genre` = `l`.`id_genre`))) join `filrougev3`.`ecrit` `ec` on((`ec`.`isbn` = `l`.`isbn`))) join `filrougev3`.`auteur` `a` on((`a`.`id_auteur` = `ec`.`id_auteur`))) join `filrougev3`.`exemplaire` `ex` on((`ex`.`isbn` = `l`.`isbn`))) join `filrougev3`.`posseder` `p` on((`p`.`id_exemplaire` = `ex`.`id_exemplaire`))) join `filrougev3`.`users` `u` on((`u`.`id` = `p`.`id`))) join `filrougev3`.`ville` `v` on((`u`.`id_ville` = `v`.`id_ville`)))