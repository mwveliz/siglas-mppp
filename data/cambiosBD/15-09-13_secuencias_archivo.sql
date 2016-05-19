SELECT setval('archivo.serie_documental_id_seq', (SELECT MAX(id)+1 FROM archivo.serie_documental));
SELECT setval('archivo.clasificador_id_seq', (SELECT MAX(id)+1 FROM archivo.clasificador));
SELECT setval('archivo.tipologia_documental_id_seq', (SELECT MAX(id)+1 FROM archivo.tipologia_documental));
SELECT setval('archivo.etiqueta_id_seq', (SELECT MAX(id)+1 FROM archivo.etiqueta));
SELECT setval('archivo.cuerpo_documental_id_seq', (SELECT MAX(id)+1 FROM archivo.cuerpo_documental));
