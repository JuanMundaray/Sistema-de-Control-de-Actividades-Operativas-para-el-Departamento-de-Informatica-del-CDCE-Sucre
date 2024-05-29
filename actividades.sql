PGDMP  %                    |           sca_cdce    16.1    16.1 E               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    49172    sca_cdce    DATABASE        CREATE DATABASE sca_cdce WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Venezuela.1252';
    DROP DATABASE sca_cdce;
                postgres    false                        2615    49342    actividades    SCHEMA        CREATE SCHEMA actividades;
    DROP SCHEMA actividades;
                postgres    false            �            1259    74153 	   actividad    TABLE     �  CREATE TABLE actividades.actividad (
    codigo_actividad character varying(50) NOT NULL,
    nombre_actividad character varying(100) NOT NULL,
    fecha_registro date NOT NULL,
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
    estado_actividad integer DEFAULT 6 NOT NULL,
    ultima_modificacion date NOT NULL
);
 "   DROP TABLE actividades.actividad;
       actividades         heap    postgres    false    6            �            1259    65840    departamentos    TABLE     �   CREATE TABLE actividades.departamentos (
    nombre_departamento character varying(50) NOT NULL,
    id_departamento integer NOT NULL
);
 &   DROP TABLE actividades.departamentos;
       actividades         heap    postgres    false    6            �            1259    65839 !   departamentos_id_departamento_seq    SEQUENCE     �   CREATE SEQUENCE actividades.departamentos_id_departamento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE actividades.departamentos_id_departamento_seq;
       actividades          postgres    false    219    6            	           0    0 !   departamentos_id_departamento_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE actividades.departamentos_id_departamento_seq OWNED BY actividades.departamentos.id_departamento;
          actividades          postgres    false    218            �            1259    90761    estado_actividad    TABLE     �   CREATE TABLE actividades.estado_actividad (
    id_estado_actividad integer NOT NULL,
    nombre_estado_actividad character varying(20) NOT NULL
);
 )   DROP TABLE actividades.estado_actividad;
       actividades         heap    postgres    false    6            �            1259    90760 (   estado_actividad_id_estado_actividad_seq    SEQUENCE     �   CREATE SEQUENCE actividades.estado_actividad_id_estado_actividad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 D   DROP SEQUENCE actividades.estado_actividad_id_estado_actividad_seq;
       actividades          postgres    false    6    228            
           0    0 (   estado_actividad_id_estado_actividad_seq    SEQUENCE OWNED BY        ALTER SEQUENCE actividades.estado_actividad_id_estado_actividad_seq OWNED BY actividades.estado_actividad.id_estado_actividad;
          actividades          postgres    false    227            �            1259    90774    estado_peticion    TABLE     �   CREATE TABLE actividades.estado_peticion (
    id_estado_peticion integer NOT NULL,
    nombre_estado_peticion character varying(20) NOT NULL
);
 (   DROP TABLE actividades.estado_peticion;
       actividades         heap    postgres    false    6            �            1259    90773 &   estado_peticion_id_estado_peticion_seq    SEQUENCE     �   CREATE SEQUENCE actividades.estado_peticion_id_estado_peticion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 B   DROP SEQUENCE actividades.estado_peticion_id_estado_peticion_seq;
       actividades          postgres    false    6    230                       0    0 &   estado_peticion_id_estado_peticion_seq    SEQUENCE OWNED BY     {   ALTER SEQUENCE actividades.estado_peticion_id_estado_peticion_seq OWNED BY actividades.estado_peticion.id_estado_peticion;
          actividades          postgres    false    229            �            1259    74114 
   peticiones    TABLE     �  CREATE TABLE actividades.peticiones (
    id_peticion integer NOT NULL,
    nombre_peticion character varying(50) NOT NULL,
    departamento_peticion integer NOT NULL,
    detalles_peticion character varying(512) NOT NULL,
    fecha_peticion date NOT NULL,
    id_usuario integer NOT NULL,
    tipo_actividad integer,
    actividad_originada character varying(50),
    estado_peticion integer DEFAULT 1 NOT NULL
);
 #   DROP TABLE actividades.peticiones;
       actividades         heap    postgres    false    6            �            1259    74113    peticiones_id_peticion_seq    SEQUENCE     �   CREATE SEQUENCE actividades.peticiones_id_peticion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE actividades.peticiones_id_peticion_seq;
       actividades          postgres    false    6    221                       0    0    peticiones_id_peticion_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE actividades.peticiones_id_peticion_seq OWNED BY actividades.peticiones.id_peticion;
          actividades          postgres    false    220            �            1259    90706 !   registro_modificaciones_actividad    TABLE     '  CREATE TABLE actividades.registro_modificaciones_actividad (
    fecha_modificacion date NOT NULL,
    estado_modificado character varying(20) NOT NULL,
    codigo_actividad character varying(50) NOT NULL,
    id_modifiacion_act integer NOT NULL,
    hora_modificacion time without time zone
);
 :   DROP TABLE actividades.registro_modificaciones_actividad;
       actividades         heap    postgres    false    6            �            1259    90714 8   registro_modificaciones_actividad_id_modifiacion_act_seq    SEQUENCE     �   CREATE SEQUENCE actividades.registro_modificaciones_actividad_id_modifiacion_act_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 T   DROP SEQUENCE actividades.registro_modificaciones_actividad_id_modifiacion_act_seq;
       actividades          postgres    false    6    225                       0    0 8   registro_modificaciones_actividad_id_modifiacion_act_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE actividades.registro_modificaciones_actividad_id_modifiacion_act_seq OWNED BY actividades.registro_modificaciones_actividad.id_modifiacion_act;
          actividades          postgres    false    226            �            1259    74146    tipo_actividad    TABLE     z   CREATE TABLE actividades.tipo_actividad (
    id_tipo integer NOT NULL,
    nombre_tipo character varying(50) NOT NULL
);
 '   DROP TABLE actividades.tipo_actividad;
       actividades         heap    postgres    false    6            �            1259    74145    tipo_actividad_id_tipo_seq    SEQUENCE     �   CREATE SEQUENCE actividades.tipo_actividad_id_tipo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE actividades.tipo_actividad_id_tipo_seq;
       actividades          postgres    false    6    223                       0    0    tipo_actividad_id_tipo_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE actividades.tipo_actividad_id_tipo_seq OWNED BY actividades.tipo_actividad.id_tipo;
          actividades          postgres    false    222            �            1259    65815    usuario    TABLE     �  CREATE TABLE actividades.usuario (
    id_usuario integer NOT NULL,
    nombre_usuario character varying(50) NOT NULL,
    nombre_personal character varying(50) NOT NULL,
    cedula character varying(8) NOT NULL,
    contrasena character varying(50) NOT NULL,
    tipo_usuario character varying(50) NOT NULL,
    fecha_creacion date NOT NULL,
    departamento_usuario integer NOT NULL,
    apellido_personal character varying(50) NOT NULL,
    marca_existencia boolean NOT NULL
);
     DROP TABLE actividades.usuario;
       actividades         heap    postgres    false    6            �            1259    65814    usuario_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE actividades.usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE actividades.usuario_id_usuario_seq;
       actividades          postgres    false    217    6                       0    0    usuario_id_usuario_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE actividades.usuario_id_usuario_seq OWNED BY actividades.usuario.id_usuario;
          actividades          postgres    false    216            >           2604    65843    departamentos id_departamento    DEFAULT     �   ALTER TABLE ONLY actividades.departamentos ALTER COLUMN id_departamento SET DEFAULT nextval('actividades.departamentos_id_departamento_seq'::regclass);
 Q   ALTER TABLE actividades.departamentos ALTER COLUMN id_departamento DROP DEFAULT;
       actividades          postgres    false    218    219    219            D           2604    90764 $   estado_actividad id_estado_actividad    DEFAULT     �   ALTER TABLE ONLY actividades.estado_actividad ALTER COLUMN id_estado_actividad SET DEFAULT nextval('actividades.estado_actividad_id_estado_actividad_seq'::regclass);
 X   ALTER TABLE actividades.estado_actividad ALTER COLUMN id_estado_actividad DROP DEFAULT;
       actividades          postgres    false    227    228    228            E           2604    90777 "   estado_peticion id_estado_peticion    DEFAULT     �   ALTER TABLE ONLY actividades.estado_peticion ALTER COLUMN id_estado_peticion SET DEFAULT nextval('actividades.estado_peticion_id_estado_peticion_seq'::regclass);
 V   ALTER TABLE actividades.estado_peticion ALTER COLUMN id_estado_peticion DROP DEFAULT;
       actividades          postgres    false    229    230    230            ?           2604    74117    peticiones id_peticion    DEFAULT     �   ALTER TABLE ONLY actividades.peticiones ALTER COLUMN id_peticion SET DEFAULT nextval('actividades.peticiones_id_peticion_seq'::regclass);
 J   ALTER TABLE actividades.peticiones ALTER COLUMN id_peticion DROP DEFAULT;
       actividades          postgres    false    221    220    221            C           2604    90715 4   registro_modificaciones_actividad id_modifiacion_act    DEFAULT     �   ALTER TABLE ONLY actividades.registro_modificaciones_actividad ALTER COLUMN id_modifiacion_act SET DEFAULT nextval('actividades.registro_modificaciones_actividad_id_modifiacion_act_seq'::regclass);
 h   ALTER TABLE actividades.registro_modificaciones_actividad ALTER COLUMN id_modifiacion_act DROP DEFAULT;
       actividades          postgres    false    226    225            A           2604    74149    tipo_actividad id_tipo    DEFAULT     �   ALTER TABLE ONLY actividades.tipo_actividad ALTER COLUMN id_tipo SET DEFAULT nextval('actividades.tipo_actividad_id_tipo_seq'::regclass);
 J   ALTER TABLE actividades.tipo_actividad ALTER COLUMN id_tipo DROP DEFAULT;
       actividades          postgres    false    223    222    223            =           2604    65818    usuario id_usuario    DEFAULT     �   ALTER TABLE ONLY actividades.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('actividades.usuario_id_usuario_seq'::regclass);
 F   ALTER TABLE actividades.usuario ALTER COLUMN id_usuario DROP DEFAULT;
       actividades          postgres    false    217    216    217            �          0    74153 	   actividad 
   TABLE DATA             COPY actividades.actividad (codigo_actividad, nombre_actividad, fecha_registro, dep_emisor, dep_receptor, nom_atendido, ape_atendido, ced_atendido, observacion, id_tipo_actividad, informe, evidencia, id_usuario_responsable, estado_actividad, ultima_modificacion) FROM stdin;
    actividades          postgres    false    224   |b       �          0    65840    departamentos 
   TABLE DATA           R   COPY actividades.departamentos (nombre_departamento, id_departamento) FROM stdin;
    actividades          postgres    false    219   �c                  0    90761    estado_actividad 
   TABLE DATA           ]   COPY actividades.estado_actividad (id_estado_actividad, nombre_estado_actividad) FROM stdin;
    actividades          postgres    false    228   �c                 0    90774    estado_peticion 
   TABLE DATA           Z   COPY actividades.estado_peticion (id_estado_peticion, nombre_estado_peticion) FROM stdin;
    actividades          postgres    false    230   <d       �          0    74114 
   peticiones 
   TABLE DATA           �   COPY actividades.peticiones (id_peticion, nombre_peticion, departamento_peticion, detalles_peticion, fecha_peticion, id_usuario, tipo_actividad, actividad_originada, estado_peticion) FROM stdin;
    actividades          postgres    false    221   vd       �          0    90706 !   registro_modificaciones_actividad 
   TABLE DATA           �   COPY actividades.registro_modificaciones_actividad (fecha_modificacion, estado_modificado, codigo_actividad, id_modifiacion_act, hora_modificacion) FROM stdin;
    actividades          postgres    false    225   +e       �          0    74146    tipo_actividad 
   TABLE DATA           C   COPY actividades.tipo_actividad (id_tipo, nombre_tipo) FROM stdin;
    actividades          postgres    false    223   �e       �          0    65815    usuario 
   TABLE DATA           �   COPY actividades.usuario (id_usuario, nombre_usuario, nombre_personal, cedula, contrasena, tipo_usuario, fecha_creacion, departamento_usuario, apellido_personal, marca_existencia) FROM stdin;
    actividades          postgres    false    217   f                  0    0 !   departamentos_id_departamento_seq    SEQUENCE SET     T   SELECT pg_catalog.setval('actividades.departamentos_id_departamento_seq', 4, true);
          actividades          postgres    false    218                       0    0 (   estado_actividad_id_estado_actividad_seq    SEQUENCE SET     [   SELECT pg_catalog.setval('actividades.estado_actividad_id_estado_actividad_seq', 6, true);
          actividades          postgres    false    227                       0    0 &   estado_peticion_id_estado_peticion_seq    SEQUENCE SET     Y   SELECT pg_catalog.setval('actividades.estado_peticion_id_estado_peticion_seq', 3, true);
          actividades          postgres    false    229                       0    0    peticiones_id_peticion_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('actividades.peticiones_id_peticion_seq', 24, true);
          actividades          postgres    false    220                       0    0 8   registro_modificaciones_actividad_id_modifiacion_act_seq    SEQUENCE SET     l   SELECT pg_catalog.setval('actividades.registro_modificaciones_actividad_id_modifiacion_act_seq', 20, true);
          actividades          postgres    false    226                       0    0    tipo_actividad_id_tipo_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('actividades.tipo_actividad_id_tipo_seq', 4, true);
          actividades          postgres    false    222                       0    0    usuario_id_usuario_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('actividades.usuario_id_usuario_seq', 38, true);
          actividades          postgres    false    216            S           2606    90754    actividad actividad_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_pkey PRIMARY KEY (codigo_actividad);
 G   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_pkey;
       actividades            postgres    false    224            U           2606    90633    actividad codigo_UNI 
   CONSTRAINT     b   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT "codigo_UNI" UNIQUE (codigo_actividad);
 E   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT "codigo_UNI";
       actividades            postgres    false    224            K           2606    65845     departamentos departamentos_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY actividades.departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id_departamento);
 O   ALTER TABLE ONLY actividades.departamentos DROP CONSTRAINT departamentos_pkey;
       actividades            postgres    false    219            Y           2606    90766 &   estado_actividad estado_actividad_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY actividades.estado_actividad
    ADD CONSTRAINT estado_actividad_pkey PRIMARY KEY (id_estado_actividad);
 U   ALTER TABLE ONLY actividades.estado_actividad DROP CONSTRAINT estado_actividad_pkey;
       actividades            postgres    false    228            [           2606    90779 $   estado_peticion estado_peticion_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY actividades.estado_peticion
    ADD CONSTRAINT estado_peticion_pkey PRIMARY KEY (id_estado_peticion);
 S   ALTER TABLE ONLY actividades.estado_peticion DROP CONSTRAINT estado_peticion_pkey;
       actividades            postgres    false    230            M           2606    90695    departamentos nombre_UNI 
   CONSTRAINT     i   ALTER TABLE ONLY actividades.departamentos
    ADD CONSTRAINT "nombre_UNI" UNIQUE (nombre_departamento);
 I   ALTER TABLE ONLY actividades.departamentos DROP CONSTRAINT "nombre_UNI";
       actividades            postgres    false    219            G           2606    90553    usuario nombre_usuariouni 
   CONSTRAINT     c   ALTER TABLE ONLY actividades.usuario
    ADD CONSTRAINT nombre_usuariouni UNIQUE (nombre_usuario);
 H   ALTER TABLE ONLY actividades.usuario DROP CONSTRAINT nombre_usuariouni;
       actividades            postgres    false    217            O           2606    74121    peticiones peticiones_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_pkey PRIMARY KEY (id_peticion);
 I   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_pkey;
       actividades            postgres    false    221            W           2606    90720 H   registro_modificaciones_actividad registro_modificaciones_actividad_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY actividades.registro_modificaciones_actividad
    ADD CONSTRAINT registro_modificaciones_actividad_pkey PRIMARY KEY (id_modifiacion_act);
 w   ALTER TABLE ONLY actividades.registro_modificaciones_actividad DROP CONSTRAINT registro_modificaciones_actividad_pkey;
       actividades            postgres    false    225            Q           2606    74151 "   tipo_actividad tipo_actividad_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY actividades.tipo_actividad
    ADD CONSTRAINT tipo_actividad_pkey PRIMARY KEY (id_tipo);
 Q   ALTER TABLE ONLY actividades.tipo_actividad DROP CONSTRAINT tipo_actividad_pkey;
       actividades            postgres    false    223            I           2606    65820    usuario usuario_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY actividades.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);
 C   ALTER TABLE ONLY actividades.usuario DROP CONSTRAINT usuario_pkey;
       actividades            postgres    false    217            a           2606    90767 )   actividad actividad_estado_actividad_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_estado_actividad_fkey FOREIGN KEY (estado_actividad) REFERENCES actividades.estado_actividad(id_estado_actividad) NOT VALID;
 X   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_estado_actividad_fkey;
       actividades          postgres    false    4697    228    224            b           2606    74168     actividad actividad_id_tipo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_id_tipo_fkey FOREIGN KEY (id_tipo_actividad) REFERENCES actividades.tipo_actividad(id_tipo);
 O   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_id_tipo_fkey;
       actividades          postgres    false    224    223    4689            c           2606    74163 #   actividad actividad_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.actividad
    ADD CONSTRAINT actividad_id_usuario_fkey FOREIGN KEY (id_usuario_responsable) REFERENCES actividades.usuario(id_usuario) ON DELETE SET NULL;
 R   ALTER TABLE ONLY actividades.actividad DROP CONSTRAINT actividad_id_usuario_fkey;
       actividades          postgres    false    224    4681    217            ]           2606    90634 .   peticiones peticiones_actividad_originada_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_actividad_originada_fkey FOREIGN KEY (actividad_originada) REFERENCES actividades.actividad(codigo_actividad) ON DELETE SET NULL NOT VALID;
 ]   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_actividad_originada_fkey;
       actividades          postgres    false    221    224    4693            ^           2606    74127 0   peticiones peticiones_departamento_peticion_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_departamento_peticion_fkey FOREIGN KEY (departamento_peticion) REFERENCES actividades.departamentos(id_departamento);
 _   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_departamento_peticion_fkey;
       actividades          postgres    false    4683    221    219            _           2606    74122 %   peticiones peticiones_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES actividades.usuario(id_usuario) ON DELETE CASCADE;
 T   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_id_usuario_fkey;
       actividades          postgres    false    217    4681    221            `           2606    82264 )   peticiones peticiones_tipo_actividad_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.peticiones
    ADD CONSTRAINT peticiones_tipo_actividad_fkey FOREIGN KEY (tipo_actividad) REFERENCES actividades.tipo_actividad(id_tipo);
 X   ALTER TABLE ONLY actividades.peticiones DROP CONSTRAINT peticiones_tipo_actividad_fkey;
       actividades          postgres    false    223    4689    221            d           2606    90733 <   registro_modificaciones_actividad registro_modificacion_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.registro_modificaciones_actividad
    ADD CONSTRAINT registro_modificacion_fkey FOREIGN KEY (codigo_actividad) REFERENCES actividades.actividad(codigo_actividad) ON DELETE CASCADE NOT VALID;
 k   ALTER TABLE ONLY actividades.registro_modificaciones_actividad DROP CONSTRAINT registro_modificacion_fkey;
       actividades          postgres    false    225    224    4693            \           2606    74133 $   usuario usuario_id_departamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY actividades.usuario
    ADD CONSTRAINT usuario_id_departamento_fkey FOREIGN KEY (departamento_usuario) REFERENCES actividades.departamentos(id_departamento);
 S   ALTER TABLE ONLY actividades.usuario DROP CONSTRAINT usuario_id_departamento_fkey;
       actividades          postgres    false    4683    219    217            �   �   x��=N1�k�)r�m~��$�$�$�҂VP��9c!A�la�����*�������n��C�u(!E�Y<���*��j��~�V�+�k����~LC�)�/�5X��Cv�
�����g�6��Z+�5� ��|	k��ǻ�V|�s��)i��7�Lv�%v>�S��s�)�&��ke��5��C��(RF��݊��	�=�{n� ,ο�?�(�#����c�nn�G%?��e�4�+�\i�      �   R   x�sqp
q�u��WpqU��s��=�����i��&����i�!����������i�1�5�ӄ+F��� c          H   x����0E��0�r��@�����s$�ޱBMYK-�!�����M��!V��Ҵ��q��Lx"� y��         *   x�3�tpr�2�ttvqtq�2�ru�p��c���� ���      �   �   x�Eͱ�0@���+�`�`dmh��Ҵo B(��-������)4�.Q�u�R�,ۢF�hjHA�h���h�uFڼ�e�I�x̳(>G�x�54~���������Y��m�d��X'n��`p�VG�lR �W�'r>Ȅ�w��̠� a��1�/u6@      �   p   x�3202�50�54�trutq�LNIN�)O,-���3��Z��Y�p!�z�y:{bQmUmd�����,#SCNCK�ZSd�FF����>�!�fpXZW� K-�      �   I   x�3��wr�ut����2��u�q����t��Wp�
ru���2F�
r2@R&�@�g0Ȁ=... �u�      �   �   x�}����@D�5����g�K��ds��K r0B~��	��P��ޫ&B�^�8��� Y�`"�q��,;�ͥ��8��u�M�[%����s��	�m����YI� �]��Xn]"��"�(�8�E�߻Q�K�C9Mx���Q�����Mj�n�%O�NͰ(%����fa�y:�'�y#���uz���tR�����5���|Zc~�\�     