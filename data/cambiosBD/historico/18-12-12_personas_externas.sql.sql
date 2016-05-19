ALTER TABLE organismos.persona_telefono ADD COLUMN updated_at timestamp;
ALTER TABLE organismos.persona_cargo ADD COLUMN status varchar(1);
update organismos.persona_cargo set status = 'A';
