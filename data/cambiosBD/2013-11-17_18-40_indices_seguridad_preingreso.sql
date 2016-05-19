ALTER TABLE seguridad.preingreso
  ADD COLUMN indices character varying;
ALTER TABLE seguridad.preingreso
  DROP CONSTRAINT funcionario_a_preingreso;
ALTER TABLE seguridad.preingreso
  DROP CONSTRAINT motivo_a_preingreso;
ALTER TABLE seguridad.preingreso
  DROP CONSTRAINT unidad_a_preingreso;
ALTER TABLE seguridad.preingreso
  ADD CONSTRAINT funcionario_a_preingreso FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE seguridad.preingreso
  ADD CONSTRAINT motivo_a_preingreso FOREIGN KEY (motivo_id)
      REFERENCES seguridad.motivo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE seguridad.preingreso
  ADD CONSTRAINT unidad_a_preingreso FOREIGN KEY (unidad_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
