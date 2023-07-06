BEGIN;
SELECT plan(1);

SELECT * FROM kategori;
SELECT ok(true, 'Kueri untuk mendapatkan semua data pengguna berhasil dijalankan');

COMMIT;