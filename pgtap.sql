PGDMP     *                    {            iclop    12.16    12.16     j           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            k           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            l           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            m           1262    24928    iclop    DATABASE     �   CREATE DATABASE iclop WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Indonesian_Indonesia.1252' LC_CTYPE = 'Indonesian_Indonesia.1252';
    DROP DATABASE iclop;
                postgres    false                        3079    31793    pgtap 	   EXTENSION     9   CREATE EXTENSION IF NOT EXISTS pgtap WITH SCHEMA public;
    DROP EXTENSION pgtap;
                   false            n           0    0    EXTENSION pgtap    COMMENT     =   COMMENT ON EXTENSION pgtap IS 'Unit testing for PostgreSQL';
                        false    2                       1255    32883    testschema()    FUNCTION       CREATE FUNCTION public.testschema() RETURNS SETOF text
    LANGUAGE plpgsql
    AS $$ 
BEGIN 
RETURN NEXT 
results_eq( 
'SELECT * FROM customerss', 
'SELECT * FROM customers', 
'Query should return student ordered by grade where grade is higher than 70' 
); 
END; 
$$;
 #   DROP FUNCTION public.testschema();
       public          postgres    false            �            1259    25214 	   customers    TABLE     +  CREATE TABLE public.customers (
    id integer NOT NULL,
    nama_awal character varying(45),
    nama_akhir character varying(45),
    email character varying(45),
    nik character varying(45),
    no_hp character varying(15),
    provinsi character varying(45),
    kota character varying(45)
);
    DROP TABLE public.customers;
       public         heap    postgres    false            �            1259    25194    kategori    TABLE     �   CREATE TABLE public.kategori (
    kat_id integer NOT NULL,
    jen_mobil character varying(45),
    kat_desk character varying(255)
);
    DROP TABLE public.kategori;
       public         heap    postgres    false            �            1259    25209    lokasi    TABLE     �   CREATE TABLE public.lokasi (
    lok_id integer NOT NULL,
    jalan character varying(45),
    no_jalan character varying(10),
    kota1 character varying(45),
    provinsi1 character varying(45)
);
    DROP TABLE public.lokasi;
       public         heap    postgres    false            �            1259    25199    mobil    TABLE     �   CREATE TABLE public.mobil (
    vin character varying(7) NOT NULL,
    warna character varying(45),
    model character varying(45),
    merk character varying(45),
    kat_id integer,
    tgl_pembelian date
);
    DROP TABLE public.mobil;
       public         heap    postgres    false            �            1259    25219 	   pemesanan    TABLE     *  CREATE TABLE public.pemesanan (
    id_pemesanan integer NOT NULL,
    jumlah numeric,
    lokasi_pengambilan integer NOT NULL,
    lokasi_pengembalian integer NOT NULL,
    tgl_pengambilan date,
    tgl_pengembalian date,
    customer_id integer NOT NULL,
    vin character varying(7) NOT NULL
);
    DROP TABLE public.pemesanan;
       public         heap    postgres    false            f          0    25214 	   customers 
   TABLE DATA           a   COPY public.customers (id, nama_awal, nama_akhir, email, nik, no_hp, provinsi, kota) FROM stdin;
    public          postgres    false    210   �        c          0    25194    kategori 
   TABLE DATA           ?   COPY public.kategori (kat_id, jen_mobil, kat_desk) FROM stdin;
    public          postgres    false    207   �"       e          0    25209    lokasi 
   TABLE DATA           K   COPY public.lokasi (lok_id, jalan, no_jalan, kota1, provinsi1) FROM stdin;
    public          postgres    false    209   �#       d          0    25199    mobil 
   TABLE DATA           O   COPY public.mobil (vin, warna, model, merk, kat_id, tgl_pembelian) FROM stdin;
    public          postgres    false    208   W$       g          0    25219 	   pemesanan 
   TABLE DATA           �   COPY public.pemesanan (id_pemesanan, jumlah, lokasi_pengambilan, lokasi_pengembalian, tgl_pengambilan, tgl_pengembalian, customer_id, vin) FROM stdin;
    public          postgres    false    211   \%       �           2606    25218    customers customers_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.customers DROP CONSTRAINT customers_pkey;
       public            postgres    false    210            �           2606    25198    kategori kategori_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT kategori_pkey PRIMARY KEY (kat_id);
 @   ALTER TABLE ONLY public.kategori DROP CONSTRAINT kategori_pkey;
       public            postgres    false    207            �           2606    25213    lokasi lokasi_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.lokasi
    ADD CONSTRAINT lokasi_pkey PRIMARY KEY (lok_id);
 <   ALTER TABLE ONLY public.lokasi DROP CONSTRAINT lokasi_pkey;
       public            postgres    false    209            �           2606    25203    mobil mobil_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.mobil
    ADD CONSTRAINT mobil_pkey PRIMARY KEY (vin);
 :   ALTER TABLE ONLY public.mobil DROP CONSTRAINT mobil_pkey;
       public            postgres    false    208            �           2606    25226    pemesanan pemesanan_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.pemesanan
    ADD CONSTRAINT pemesanan_pkey PRIMARY KEY (id_pemesanan);
 B   ALTER TABLE ONLY public.pemesanan DROP CONSTRAINT pemesanan_pkey;
       public            postgres    false    211            �           2606    25204    mobil mobil_kat_id_fkey    FK CONSTRAINT     |   ALTER TABLE ONLY public.mobil
    ADD CONSTRAINT mobil_kat_id_fkey FOREIGN KEY (kat_id) REFERENCES public.kategori(kat_id);
 A   ALTER TABLE ONLY public.mobil DROP CONSTRAINT mobil_kat_id_fkey;
       public          postgres    false    207    208    3797            �           2606    25232 $   pemesanan pemesanan_customer_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pemesanan
    ADD CONSTRAINT pemesanan_customer_id_fkey FOREIGN KEY (customer_id) REFERENCES public.customers(id);
 N   ALTER TABLE ONLY public.pemesanan DROP CONSTRAINT pemesanan_customer_id_fkey;
       public          postgres    false    3803    210    211            �           2606    25237 +   pemesanan pemesanan_lokasi_pengambilan_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pemesanan
    ADD CONSTRAINT pemesanan_lokasi_pengambilan_fkey FOREIGN KEY (lokasi_pengambilan) REFERENCES public.lokasi(lok_id);
 U   ALTER TABLE ONLY public.pemesanan DROP CONSTRAINT pemesanan_lokasi_pengambilan_fkey;
       public          postgres    false    3801    211    209            �           2606    25242 ,   pemesanan pemesanan_lokasi_pengembalian_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pemesanan
    ADD CONSTRAINT pemesanan_lokasi_pengembalian_fkey FOREIGN KEY (lokasi_pengembalian) REFERENCES public.lokasi(lok_id);
 V   ALTER TABLE ONLY public.pemesanan DROP CONSTRAINT pemesanan_lokasi_pengembalian_fkey;
       public          postgres    false    3801    209    211            �           2606    25227    pemesanan pemesanan_vin_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY public.pemesanan
    ADD CONSTRAINT pemesanan_vin_fkey FOREIGN KEY (vin) REFERENCES public.mobil(vin);
 F   ALTER TABLE ONLY public.pemesanan DROP CONSTRAINT pemesanan_vin_fkey;
       public          postgres    false    211    3799    208            f   �  x�m�ݎ�0��'O�O�����w��u[����j��1$ve�E��w��_.�;�t|�C���?����Ê`ߚM��v=�L0z����"�&y!����郇�w+��4.P�=j���j�����+�-vQ���'�H:��F�F"jv�_J3q������ѣm�J�	t���{<���>�k�`�q~t@d�wJ���w&�@F��L�c��0��ű7�n�%*INO�*�����6P6�6�c��d�F*�)�\���+.y?B���@3�d�nM<~�hZQw�R)v�!sy���5ܢ0�0����à=�ʝY�%�F�e'��)�_ں~�*J��8x�8��9�-���;��/�R=�g07��-�#Ա�?�;���8+�D���N��n�v.�ʮ���ܾ�bA^��xǸ���Ec�׌�ƯB�B����/���$x�u���{bQ�_D�;�������}N��?r7�      c   �   x�]��N�0���S�
��vAӐ*����M���K��F��q�r�Y����1�|*�ؼ�.�����cO�ײ����f��ʡ�<28-_<d𡓈��쉊���1'��ք��|<^Ռ�ޙ��H�Vt�i��3�@V�5����ZЋv11V���oPVn���\�J�13�{��:t+%�c����BI4e/�~���i��R���ި�@F�(���I�y�h?������y�      e   �   x�U��j�0���+��q�@�!�`�p!z�P�ȶv�J������0��~�݇E�yQ�vC'��́����bQ�V{�7�=-5��ŋ�G�T���ѱ=�G��vM����=�fS�{Iv(��$�tԋ1A3���!����[r�蹡���q����+~�Fж����B�;(��Xcn��R�      d   �   x�e��J�0E�7_�T�^����B�)�
Bqg"�F�v��z�i)���8�s�LN���gQ�K���wt�M��,�.���Uc�҉�'P&=��3hBt"i�DјT����[�z��قm�b�V�}��Ў�S�	�����W�4�3�|o?���t�����)�r���B{��q;�V��ъ�bfx������/�s�8Q�h+�֋������jR��4*e<�?��g-*�u��f'��
!~�o\�      g   �   x�MR;�� ������mɼ�����k�4PdI��� �˙sʜ����9T��U�E�������;X�..����Ҽq����[X��sr�(@g���+Ss��X]>n����E9m�@���%<�彌Ũ=k�>�l+�K��M�D- �״6���i��tw�9:��{_ͽ-;c�Μ��ifHn����ٯ#��Os;���Z,����S�P�4_k{ A
�V.�g�+o� ����A0m�     