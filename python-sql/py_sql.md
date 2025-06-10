--  Requêtes de base
--  1.
--  Clients non américains : Fournissez une requête affichant les
--  Clients (leurs noms complets, ID client et pays) qui ne sont pas aux
--  États-Unis
SELECT CustomerId,FirstName, LastName, Country 
FROM customer WHERE country NOT IN("USA");

--  2.  Clients brésiliens : Fournissez une requête affichant uniquement
--  les Clients provenant du Brésil.

SELECT * FROM customer WHERE country IN("Brazil");

--  3. Factures des clients brésiliens : Fournissez une requête affichant
--  les factures des clients qui sont du Brésil.

SELECT * FROM invoice WHERE BillingCountry IN("Brazil");

--  4. Agents de vente : Fournissez une requête affichant uniquement
--  les employés qui sont des Agents de Vente

SELECT * FROM employee WHERE Title LIKE "%Sales%" ;

                   -- ******** Agrégations et relations***********

--  5. Pays uniques dans les factures : Fournissez une requête affichant
--  une liste unique des pays de facturation présents dans la table Invoice.
SELECT  DISTINCT(BillingCountry) FROM invoice;

-- 6. Factures par agent de vente : Fournissez une requête affichant les
--  factures associées à chaque agent de vente.
--  Le tableau résultant doit inclure le nom complet de l'agent de
--  vente.
--1- jouinture naturel
SELECT InvoiceId, BillingCity, BillingAddress , employee.LastName, employee.FirstName 
FROM invoice, customer, employee WHERE invoice.CustomerId = customer.CustomerId AND customer.SupportRepId = employee.EmployeeId ORDER BY InvoiceId ASC

--2- jouinture imbriquer

SELECT InvoiceId, BillingCity, BillingAddress , employee.LastName, employee.FirstName 
FROM (invoice LEFT JOIN customer ON invoice.CustomerId = customer.CustomerId) LEFT JOIN employee ON customer.SupportRepId = employee.EmployeeId 

--  7. Détails des factures : Fournissez une requête affichant le total de
--  chaque facture, le nom du client, le pays et le nom de l'agent de vente

SELECT invoice.Total , customer.FirstName , BillingCountry, BillingAddress , employee.LastName, employee.FirstName 
FROM invoice, customer, employee WHERE invoice.CustomerId = customer.CustomerId AND customer.SupportRepId = employee.EmployeeId ORDER BY Total ASC

              -- ***************Analyse par année et lignes de facture************
							
--  8. Ventes par année : Combien de factures y a-t-il eu en 2009 et
--  2011 ? Quels sont les montants totaux des ventes pour chacune de
--  ces années ?HAVING Annee IN("2009", "2011")
SELECT YEAR(InvoiceDate) as Annee, COUNT(*) as Nombre, SUM(Total) as somme FROM invoice GROUP BY Annee 

--  9. Articles pour une facture donnée : Fournissez une requête
--  comptant le nombre d'articles (line items) pour l'ID de facture 37.

                  -- *************Détails des morceaux ************************
--  11. Nom des morceaux : Fournissez une requête incluant le nom du
--  morceau pour chaque ligne de facture.

SELECT invoice.InvoiceId , track.`Name` as Nom FROM invoice, invoiceline, track 
WHERE  invoice.InvoiceId = invoiceline.InvoiceId AND invoiceline.TrackId = track.TrackId 

--  12. Morceaux et artistes : Fournissez une requête incluant le nom du
--  morceau acheté ET le nom de l'artiste pour chaque ligne de facture.

SELECT track.`Name` as Nom , artist.`Name` as artiste FROM  track, album, artist
WHERE track.AlbumId = album.AlbumId AND album.ArtistId = artist.ArtistId

              -- *************Comptages et regroupements***********************
							
--  13. Nombre de factures par pays : Fournissez une requête affichant
--  le nombre de factures par pays.
-- Astuce : utilisez GROUP BY.
SELECT BillingCountry as Pays, COUNT(*) as Nombre FROM invoice GROUP BY Pays 

--  14. Nombre de morceaux par playlist : Fournissez une requête
--  affichant le nombre total de morceaux dans chaque playlist.
--  Le nom de la playlist doit être inclus dans le tableau résultant.
-- SELECT colonne1, fonction_agregat(colonne2)
-- FROM table
-- WHERE condition -- filtre avant le GROUP BY
-- GROUP BY colonne1
-- HAVING condition_sur_agregat -- filtre après le GROUP BY

SELECT  playlist.`Name` as Nom_playlist, COUNT(track.TrackId) as Nombre_morcaux
FROM playlist, playlisttrack, track WHERE playlist.PlaylistId = playlisttrack.PlaylistId AND playlisttrack.TrackId = track.TrackId GROUP BY Nom_playlist

--  15. Liste des morceaux : Fournissez une requête affichant tous les
--  morceaux (Tracks), mais sans afficher les IDs.
--  Le tableau résultant doit inclure le nom de l'album, le type de média
--  et le genre.
 SELECT track.`Name` as morceau, album.Title as Nom_album, mediatype.`Name` as type_media
 FROM track, album, mediatype WHERE track.AlbumId = album.AlbumId AND track.MediaTypeId = mediatype.MediaTypeId
 
 
                  -- *************Analyse des ventes***********************
--  16. Factures et articles : Fournissez une requête affichant toutes les
--  factures, avec le nombre d'articles par facture.


--  17. Ventes par agent de vente : Fournissez une requête affichant les
--  ventes totales réalisées par chaque agent de vente.

SELECT employee.FirstName as agent,  SUM(Invoice.Total) as Total
FROM invoice, customer, employee WHERE invoice.CustomerId = customer.CustomerId AND customer.SupportRepId = employee.EmployeeId GROUP BY agent
 
--  18. Meilleur agent de 2009 : Quel agent de vente a réalisé le plus de
--  ventes en 2009 ?

--  19. Meilleur agent de 2010 : Quel agent de vente a réalisé le plus de
--  ventes en 2010 ?

--  20. Meilleur agent global : Quel agent de vente a réalisé le plus de
--  ventes en tout ? :voire 17

              -- ***********************   Analyse des clients et des pays *****************************
							
--  21. Clients par agent de vente : Fournissez une requête affichant le
--  nombre de clients attribués à chaque agent de vente.
SELECT employee.FirstName as agent, COUNT(customer.FirstName) as nombre_client FROM customer, employee
WHERE customer.SupportRepId = employee.EmployeeId GROUP BY agent

--  22. Ventes totales par pays : Fournissez une requête affichant les
--  ventes totales par pays.
SELECT BillingCountry as pays, SUM(Total) AS total FROM invoice 
GROUP BY pays  
--  Quel pays a dépensé le plus ?
SELECT BillingCountry as pays, SUM(Total) AS total FROM invoice 
GROUP BY pays ORDER BY total DESC LIMIT 1;

                 -- ****************Analyse des morceaux et des artistes********************
--  23. Morceau le plus acheté en 2013 : Fournissez une requête
--  affichant le morceau le plus acheté en 2013.

--  24. Top 5 des morceaux les plus achetés : Fournissez une requête
--  affichant les 5 morceaux les plus achetés en tout.
SELECT track.`Name` as morceau, SUM(invoiceline.UnitPrice) AS somme FROM invoiceline, track
WHERE invoiceline.TrackId = track.TrackId GROUP BY morceau ORDER BY somme DESC LIMIT 5

--  25. Top 3 des artistes les plus vendus : Fournissez une requête
--  affichant les 3 artistes les plus vendus.
SELECT artist.`Name` as artistes , SUM(track.UnitPrice) AS somme FROM  track, album, artist
WHERE track.AlbumId = album.AlbumId AND album.ArtistId = artist.ArtistId GROUP BY artistes ORDER BY somme DESC LIMIT 3

--  26. Type de média le plus acheté : Fournissez une requête affichant
--  le type de média le plus acheté.
SELECT mediatype.`Name` AS type_media ,SUM(track.UnitPrice) AS somme FROM  track, mediatype
WHERE track.MediaTypeId = mediatype.MediaTypeId GROUP BY type_media ORDER BY somme DESC

comment me connecter a un projet GitHub en local