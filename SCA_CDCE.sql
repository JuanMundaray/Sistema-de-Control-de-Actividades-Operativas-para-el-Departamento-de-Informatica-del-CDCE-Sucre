PGDMP                      |           sca_cdce    16.1    16.1 B               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    107198    sca_cdce    DATABASE        CREATE DATABASE sca_cdce WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Venezuela.1252';
    DROP DATABASE sca_cdce;
                postgres    false                        2615    107302    actividades    SCHEMA        CREATE SCHEMA actividades;
    DROP SCHEMA actividades;
                postgres    false            �            1259    107372 	   actividad    TABLE     3  CREATE TABLE actividades.actividad (
    codigo_actividad character varying(50) NOT NULL,
    nombre_actividad character varying(100) NOT NULL,
    fecha_registro timestamp without time zone NOT NULL,
    dep_emisor character varying(50) NOT NULL,
    dep_receptor character varying(50) NOT NULL,
    nom_atendido character varying(50) NOT NULL,
    ape_atendido character varying(50) NOT NULL,
    ced_atendido character varying(8) NOT NULL,
    observacion character varying(512) NOT NULL,
    id_tipo_actividad integer NOT NULL,
    informe character varying(512) NOT NULL,
    evidencia character varying(512) NOT NULL,
    id_usuario_responsable integer NOT NULL,
    estado_actividad integer DEFAULT 1 NOT NULL,
    ultima_modificacion timestamp without time zone,
    fecha_inicio timestamp without time zone
);
 "   DROP TABLE actividades.actividad;
       actividades         heap    postgres    false    6            �            1259    107322    departamentos    TABLE     �   CREATE TABLE actividades.departamentos (
    nombre_departamento character varying(50) NOT NULL,
    id_departamento integer NOT NULL
);
 &   DROP TABLE actividades.departamentos;
       actividades         heap    postgres    false    6            �            1259    107321 !   departamentos_id_departamento_seq    SEQUENCE     �   CREATE SEQUENCE actividades.departamentos_id_departamento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE actividades.departamentos_id_departamento_seq;
       actividades          postgres    false    217    6                       0    0 !   departamentos_id_departamento_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE actividades.departamentos_id_departamento_seq OWNED BY actividades.departamentos.id_departamento;
          actividades          postgres    false    216            �            1259    107331    estado_actividad    TABLE     �   CREATE TABLE actividades.estado_actividad (
    id_estado_actividad integer NOT NULL,
    nombre_estado_actividad character varying(20) NOT NULL
);
 )   DROP TABLE actividades.estado_actividad;
       actividades         heap    postgres    false    6            �            1259    107330 (   estado_actividad_id_estado_actividad_seq    SEQUENCE     �   CREATE SEQUENCE actividades.estado_actividad_id_estado_actividad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 D   DROP SEQUENCE actividades.estado_actividad_id_estado_actividad_seq;
       actividades          postgres    false    219    6                       0    0 (   estado_actividad_id_estado_actividad_seq    SEQUENCE OWNED BY        ALTER SEQUENCE actividades.estado_actividad_id_estado_actividad_seq OWNED BY actividades.estado_actividad.id_estado_actividad;
          actividades          postgres    false    218            �            1259    107338    estado_peticion    TABLE     �   CREATE TABLE actividades.estado_peticion (
    id_estado_peticion integer NOT NULL,
    nombre_estado_peticion character varying(20) NOT NULL
);
 (   DROP TABLE actividades.estado_peticion;
       actividades         heap    postgres    false    6            �            1259    107337 &   estado_peticion_id_estado_peticion_seq    SEQUENCE     �   CREATE SEQUENCE actividades.estado_peticion_id_estado_peticion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 B   DROP SEQUENCE actividades.estado_peticion_id_estado_peticion_seq;
       actividades          postgres    false    221    6                       0    0 &   estado_peticion_id_estado_peticion_seq    SEQUENCE OWNED BY     {   ALTER SEQUENCE actividades.estado_peticion_id_estado_peticion_seq OWNED BY actividades.estado_peticion.id_estado_peticion;
          actividades          postgres    false    220            �            1259    107403 
   peticiones    TABLE     �  CREATE TABLE actividades.peticiones (
    id_peticion integer NOT NULL,
    nombre_peticion character varying(50) NOT NULL,
    departamento_peticion integer NOT NULL,
    detalles_peticion character varying(512) NOT NULL,
    fecha_registro timestamp without time zone NOT NULL,
    id_usuario integer NOT NULL,
    tipo_actividad integer,
    actividad_originada character varying(50),
    estado_peticion integer DEFAULT 1 NOT NULL
);
 #   DROP TABLE actividades.peticiones;
       actividades         heap    postgres    false    6            �            1259    107402    peticiones_id_peticion_seq    SEQUENCE     �   CREATE SEQUENCE actividades.peticiones_id_peticion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE actividades.peticiones_id_peticion_seq;
       actividades          postgres    false    230    6                       0    0    peticiones_id_peticion_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE actividades.peticiones_id_peticion_seq OWNED BY actividades.peticiones.id_peticion;
          actividades          postgres    false    229            �            1259    107391 !   registro_modificaciones_actividad    TABLE     '  CREATE TABLE actividades.registro_modificaciones_actividad (
    fecha_modificacion date NOT NULL,
    estado_modificado character varying(20) NOT NULL,
    codigo_actividad character varying(50) NOT NULL,
    id_modifiacion_act integer NOT NULL,
    hora_modificacion time without time zone
);
 :   DROP TABLE actividades.registro_modificaciones_actividad;
       actividades         heap    postgres    false    6            �            1259    107390 8   registro_modificaciones_actividad_id_modifiacion_act_seq    SEQUENCE     �   CREATE SEQUENCE actividades.registro_modificaciones_actividad_id_modifiacion_act_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 T   DROP SEQUENCE actividades.registro_modificaciones_actividad_id_modifiacion_act_seq;
       actividades          postgres    false    6    228            	           0    0 8   registro_modificaciones_actividad_id_modifiacion_act_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE actividades.registro_modificaciones_actividad_id_modifiacion_act_seq OWNED BY actividades.registro_modificaciones_actividad.id_modifiacion_act;
          actividades          postgres    false    227            �            1259    107345    tipo_actividad    TABLE     z   CREATE TABLE actividades.tipo_actividad (
    id_tipo integer NOT NULL,
    nombre_tipo character varying(50) NOT NULL
);
 '   DROP TABLE actividades.tipo_actividad;
       actividades         heap    postgres    false    6            �            1259    107344    tipo_actividad_id_tipo_seq    SEQUENCE     �   CREATE SEQUENCE actividades.tipo_actividad_id_tipo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE actividades.tipo_actividad_id_tipo_seq;
       actividades          postgres    false    6    223            
           0    0    tipo_actividad_id_tipo_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE actividades.tipo_actividad_id_tipo_seq OWNED BY actividades.tipo_actividad.id_tipo;
          actividades          postgres    false    222            �            1259    107359    usuario    TABLE     �  CREATE TABLE actividades.usuario (
    id_usuario integer NOT NULL,
    nombre_usuario character varying(50),
    nombre_personal character varying(50),
    cedula character varying(9),
    contrasena character varying(72),
    tipo_usuario character varying(50),
    fecha_creacion date NOT NULL,
    departamento_usuario integer NOT NULL,
    apellido_personal character varying(50),
    marca_existencia boolean NOT NULL
);
     DROP TABLE actividades.usuario;
       actividades         heap    postgres    false    6            �            1259    107358    usuario_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE actividades.usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE actividades.usuario_id_usuario_seq;
       actividades          postgres    false    225    6                       0    0    usuario_id_usuario_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE actividades.usuario_id_usuario_seq OWNED BY actividades.usuario.id_usuario;
          actividades          postgres    false    224            =           2604    107325    departamentos id_departamento    DEFAULT     �   ALTER TABLE ONLY actividades.departamentos ALTER COLUMN id_departamento SET DEFAULT nextval('actividades.departamentos_id_departamento_seq'::regclass);
 Q   ALTER TABLE actividades.departamentos ALTER COLUMN id_departamento DROP DEFAULT;
       actividades          postgres    false    217    216    217            >           2604    107334 $   estado_actividad id_estado_actividad    DEFAULT     �   ALTER TABLE ONLY actividades.estado_actividad ALTER COLUMN id_estado_actividad SET DEFAULT nextval('actividades.estado_actividad_id_estado_actividad_seq'::regclass);
 X   ALTER TABLE actividades.estado_actividad ALTER COLUMN id_estado_actividad DROP DEFAULT;
       actividades          postgres    false    218    219    219            ?           2604    107341 "   estado_peticion id_estado_peticion    DEFAULT     �   ALTER TABLE ONLY actividades.estado_peticion ALTER COLUMN id_estado_peticion SET DEFAULT nextval('actividades.estado_peticion_id_estado_peticion_seq'::regclass);
 V   ALTER TABLE actividades.estado_peticion ALTER COLUMN id_estado_peticion DROP DEFAULT;
       actividades          postgres    false    220    221    221            D           2604    107406    peticiones id_peticion    DEFAULT     �   ALTER TABLE ONLY actividades.peticiones ALTER COLUMN id_peticion SET DEFAULT nextval('actividades.peticiones_id_peticion_seq'::regclass);
 J   ALTER TABLE actividades.peticiones ALTER COLUMN id_peticion DROP DEFAULT;
       actividades          postgres    false    229    230    230            C           2604    107394 4   registro_modificaciones_actividad id_modifiacion_act    DEFAULT     �   ALTER TABLE ONLY actividades.registro_modificaciones_actividad ALTER COLUMN id_modifiacion_act SET DEFAULT nextval('actividades.registro_modificaciones_actividad_id_modifiacion_act_seq'::regclass);
 h   ALTER TABLE actividades.registro_modificaciones_actividad ALTER COLUMN id_modifiacion_act DROP DEFAULT;
       actividades          postgres    false    228    227    228            @           2604    107348    tipo_actividad id_tipo    DEFAULT     �   ALTER TABLE ONLY actividades.tipo_actividad ALTER COLUMN id_tipo SET DEFAULT nextval('actividades.tipo_actividad_id_tipo_seq'::regclass);
 J   ALTER TABLE actividades.tipo_actividad ALTER COLUMN id_tipo DROP DEFAULT;
       actividades          postgres    false    222    223    223            A           2604    107362    usuario id_usuario    DEFAULT     �   ALTER TABLE ONLY actividades.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('actividades.usuario_id_usuario_seq'::regclass);
 F   ALTER TABLE actividades.usuario ALTER COLUMN id_usuario DROP DEFAULT;
       actividades          postgres    false    224    225    225            �          0    107372 	   actividad 
   TABLE DATA           !  COPY actividades.actividad (codigo_actividad, nombre_actividad, fecha_registro, dep_emisor, dep_receptor, nom_atendido, ape_atendido, ced_atendido, observacion, id_tipo_actividad, informe, evidencia, id_usuario_responsable, estado_actividad, ultima_modificacion, fecha_inicio) FROM stdin;
    actividades          postgres    false    226   �]       �          0    107322    departamentos 
   TABLE DATA           R   COPY actividades.departamentos (nombre_departamento, id_departamento) FROM stdin;
    actividades          postgres    false    217   +`       �          0    107331    estado_actividad 
   TABLE DATA           ]   COPY actividades.estado_actividad (id_estado_actividad, nombre_estado_actividad) FROM stdin;
    actividades          postgres    false    219   y`       �          0    107338    estado_peticion 
   TABLE DATA           Z   COPY actividades.estado_peticion (id_estado_peticion, nombre_estado_peticion) FROM stdin;
    actividades          postgres    false    221   �`       �          0    107403 
   peticiones 
   TABLE DATA           �   COPY actividades.peticiones (id_peticion, nombre_peticion, departamento_peticion, detalles_peticion, fecha_registro, id_usuario, tipo_actividad, actividad_originada, estado_peticion) FROM stdin;
    actividades          postgres    false    230   a       �          0    107391 !   registro_modificaciones_actividad 
   TABLE DATA           �   COPY actividades.registro_modificaciones_actividad (fecha_modificacion, estado_modificado, codigo_actividad, id_modifiacion_act, hora_modificacion) FROM stdin;
    actividades          postgres    false    228   eb       �          0    107345    tipo_actividad 
   TABLE DATA           C   COPY actividades.tipo_actividad (id_tipo, nombre_tipo) FROM stdin;
    actividades          postgres    false    223   
c       �          0    107359    usuario 
   TABLE DATA           �   COPY actividades.usuario (id_usuario, nombre_usuario, nombre_personal, cedula, contrasena, tipo_usuario, fecha_creacion, departamento_usuario, apellido_personal, marca_existencia) FROM stdin;
    actividades          postgres    false    225   ec                  0    0 !   departamentos_id_departamento_seq    SEQUENCE SET     T   SELECT pg_catalog.setval('actividades.departamentos_id_departamento_seq', 6, true);
          actividades          postgres    false    216                       0    0 (   estado_actividad_id_estado_actividad_seq    SEQUENCE SET     [   SELECT pg_catalog.setval('actividades.estado_actividad_id_estado_actividad_seq', 5, true);
          actividades          postgres    false    218                       0    0 &   estado_peticion_id_estado_peticion_seq    SEQUENCE SET     Y   SELECT pg_catalog.setval('actividades.estado_peticion_id_estado_peticion_seq', 3, true);
          actividades          postgres    false    220                       0    0    peticiones_id_peticion_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('actividades.peticiones_id_peticion_seq', 2, true);
          actividades          postgres    false    229                       0    0 8   registro_modificaciones_actividad_id_modifiacion_act_seq    SEQUENCE SET     k   SELECT pg_catalog.setval('actividades.registro_modificaciones_actividad_id_modifiacion_act_seq', 7, true);
          actividades          postgres    false    227                       0    0    tipo_actividad_id_tipo_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('actividades.tipo_actividad_id_tipo_seq', 4, true);
          actividades          postgres    false    222                       0    0    usuario_id_usuario_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('actividades.usuario_id_usuario_seq', 35, true);
          actividades          postgres    false    224            U           2606    107379    actividad actividad_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_pkey PRIMARY KEY (codigo_actividad);
 G   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_pkey;
       actividades            postgres    false    226            G           2606    107327     departamentos departamentos_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY actividades.departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id_departamento);
 O   ALTER TABLE ONLY actividades.departamentos DROP CONSTRAINT departamentos_pkey;
       actividades            postgres    false    217            K           2606    107336 &   estado_actividad estado_actividad_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY actividades.estado_actividad
    ADD CONSTRAINT estado_actividad_pkey PRIMARY KEY (id_estado_actividad);
 U   ALTER TABLE ONLY actividades.estado_actividad DROP CONSTRAINT estado_actividad_pkey;
       actividades            postgres    false    219            M           2606    107343 $   estado_peticion estado_peticion_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY actividades.estado_peticion
    ADD CONSTRAINT estado_peticion_pkey PRIMARY KEY (id_estado_peticion);
 S   ALTER TABLE ONLY actividades.estado_peticion DROP CONSTRAINT estado_peticion_pkey;
       actividades            postgres    false    221            I           2606    107329    departamentos nombre_UNI 
   CONSTRAINT     i   ALTER TABLE ONLY actividades.departamentos
    ADD CONSTRAINT "nombre_UNI" UNIQUE (nombre_departamento);
 I   ALTER TABLE ONLY actividades.departamentos DROP CONSTRAINT "nombre_UNI";
       actividades            postgres    false    217            Q           2606    107366    usuario nombre_usuariouni 
   CONSTRAINT     c   ALTER TABLE ONLY actividades.usuario
    ADD CONSTRAINT nombre_usuariouni UNIQUE (nombre_usuario);
 H   ALTER TABLE ONLY actividades.usuario DROP CONSTRAINT nombre_usuariouni;
       actividades            postgres    false    225            Y           2606    107411    peticiones peticiones_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_pkey PRIMARY KEY (id_peticion);
 I   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_pkey;
       actividades            postgres    false    230            W           2606    107396 H   registro_modificaciones_actividad registro_modificaciones_actividad_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY actividades.registro_modificaciones_actividad
    ADD CONSTRAINT registro_modificaciones_actividad_pkey PRIMARY KEY (id_modifiacion_act);
 w   ALTER TABLE ONLY actividades.registro_modificaciones_actividad DROP CONSTRAINT registro_modificaciones_actividad_pkey;
       actividades            postgres    false    228            O           2606    107350 "   tipo_actividad tipo_actividad_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY actividades.tipo_actividad
    ADD CONSTRAINT tipo_actividad_pkey PRIMARY KEY (id_tipo);
 Q   ALTER TABLE ONLY actividades.tipo_actividad DROP CONSTRAINT tipo_actividad_pkey;
       actividades            postgres    false    223            S           2606    107364    usuario usuario_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY actividades.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);
 C   ALTER TABLE ONLY actividades.usuario DROP CONSTRAINT usuario_pkey;
       actividades            postgres    false    225            [           2606    107380 )   actividad actividad_estado_actividad_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_estado_actividad_fkey FOREIGN KEY (estado_actividad) REFERENCES actividades.estado_actividad(id_estado_actividad);
 X   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_estado_actividad_fkey;
       actividades          postgres    false    226    4683    219            \           2606    107385     actividad actividad_id_tipo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_id_tipo_fkey FOREIGN KEY (id_tipo_actividad) REFERENCES actividades.tipo_actividad(id_tipo);
 O   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_id_tipo_fkey;
       actividades          postgres    false    223    226    4687            ^           2606    107412 .   peticiones peticiones_actividad_originada_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_actividad_originada_fkey FOREIGN KEY (actividad_originada) REFERENCES actividades.actividad(codigo_actividad) ON DELETE SET NULL;
 ]   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_actividad_originada_fkey;
       actividades          postgres    false    226    4693    230            _           2606    107417 0   peticiones peticiones_departamento_peticion_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_departamento_peticion_fkey FOREIGN KEY (departamento_peticion) REFERENCES actividades.departamentos(id_departamento);
 _   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_departamento_peticion_fkey;
       actividades          postgres    false    230    4679    217            `           2606    107422 )   peticiones peticiones_tipo_actividad_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_tipo_actividad_fkey FOREIGN KEY (tipo_actividad) REFERENCES actividades.tipo_actividad(id_tipo);
 X   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_tipo_actividad_fkey;
       actividades          postgres    false    230    4687    223            ]           2606    107397 <   registro_modificaciones_actividad registro_modificacion_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.registro_modificaciones_actividad
    ADD CONSTRAINT registro_modificacion_fkey FOREIGN KEY (codigo_actividad) REFERENCES actividades.actividad(codigo_actividad) ON DELETE CASCADE;
 k   ALTER TABLE ONLY actividades.registro_modificaciones_actividad DROP CONSTRAINT registro_modificacion_fkey;
       actividades          postgres    false    226    4693    228            Z           2606    107367 $   usuario usuario_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.usuario
    ADD CONSTRAINT usuario_id_departamento_fkey FOREIGN KEY (departamento_usuario) REFERENCES actividades.departamentos(id_departamento);
 S   ALTER TABLE ONLY actividades.usuario DROP CONSTRAINT usuario_id_departamento_fkey;
       actividades          postgres    false    4679    225    217            �     x���Mn�0���S� �!����ME6�!�.)�MP�p� A�.b��2g��:Tܸ�� ��)��7oWW��_�����}�,l��e�0mC�ӽwD"�8��\1��|Z&9��������V�Ι7ڄӛ��Ԏ�\00��i��#�Y�*% p�NU�g/I���v�w�<�>G��=�������^�]l�'lzj���=2l�A�i�gY�O�?�z���Iz~��2�C��&w"��i0>zsF?lw�A�2M `����n�����f��5���}����	�<�� �܀<j`Z䗹�ʵ���w�s��#ā��J�_"^`m�uq~[1"ln�%O�T	����tQ�3ʑG=�57�DP�$P�,�U��Z6�C
���U�2dl�L#��K!_�����V�e;�XG�}9�*���D�C��R��@�d��lH��0FD�$MWƹ�����"�E�0Z�ް�i2�ȝ��4�����7f�˛k�7B��q>Qb"��B\�|u�M�ln����GE�'}�4�F �yR      �   >   x���s��=���������i�����i����������yx��W� ��O      �   B   x�3����t�ttq�2��wv��2�t���q	�p����x9���>���~ �=... ��      �   *   x�3�tpr�2�ttvqtq�2�ru�p��c���� ���      �   P  x�}PAn�0<;��@	�[
VEU�7.K��A�M��*����n@�ZT�`yw�;;3c!��d2�|�r��R���ܨ����%�2S2� ��-5Gt���:t���.wx���#��Y�4?^h�a����*xad�7��;��~ �m�7;�s�'xC}�w>�??,;4��	4ϣ�!�"D��p2M��	��yͣ��b�m*�A(6*�dj���D��Wi!U*H�1�a��7OE�Bҧ����]�ڡ�Ǡ���d�@mZr���xC%yt���H�/���׎�3?,�y�6��5��%r��3-B���:�x޻�E(ʪ$}jf���4a��	���8�X      �   �   x�}α
�0����.��r͵�J�PPS���Vl+����&SQ����D�$g���4���t}w�cq��(�*�d�	<ܞw8xJ���Z��X�\&��<>(��Rr�,��򀵱���zW���5ѲE=�ί�U������FqX!>.�Mv      �   K   x�3��u�q����t��Wp�
ru���2B�
r2@RƜA��A���Ξ�'�q�p���s��qqq �H�      �     x�M��n�@���+X�g���DF������a V��~R��Ĥ�[��s�rߴ�Af�L�<L��y�3`b;P�M��~�E�j �8Sd�����(�<����2a��SױL�u��dG��G�&��U�t����%�����K�(�Ň�g>CR5Q��`��*���N�3�q.|&���(�q$fƥd"���C~�����nŷ��柫����r��f��>�j�h�-Y��ثT�@���0��ߧ�,3S.���	�a�s�Z�     