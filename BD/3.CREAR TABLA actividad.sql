CREATE TABLE IF NOT EXISTS actividades.actividad ( codigo_actividad character varying(50)  NOT NULL, nombre_actividad character varying(50)  NOT NULL,fecha_registro date NOT NULL,dep_emisor character varying(50)  NOT NULL,dep_receptor character varying(50)  NOT NULL,nom_atendido character varying(50)  NOT NULL, ape_atendido character varying(50)  NOT NULL,ced_atendido character varying(15)  NOT NULL,observacion character varying(512)  NOT NULL,estado_actividad character varying(50)  NOT NULL,id_tipo_actividad integer NOT NULL,informe character varying(512)  NOT NULL,evidencia character varying(512)  NOT NULL,id_usuario_responsable integer NOT NULL, CONSTRAINT "codigo_UNI" UNIQUE (codigo_actividad),CONSTRAINT actividad_id_tipo_fkey FOREIGN KEY (id_tipo_actividad) REFERENCES actividades.tipo_actividad (id_tipo) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION, CONSTRAINT actividad_id_usuario_fkey FOREIGN KEY (id_usuario_responsable) REFERENCES actividades.usuario (id_usuario));