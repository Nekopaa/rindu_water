# TODO - Admin Dashboard & Role-based Registration

- [x] Update form register untuk pilihan daftar sebagai admin/pelanggan + input kode perusahaan (wajib untuk admin)
- [x] Update `RegisteredUserController@store` untuk validasi kode perusahaan `PRIMA` dan menyimpan `users.role`
- [x] (Opsional) Cek/adjust redirect login/dashboard agar admin diarahkan ke `/admin/dashboard` dan pelanggan ke `/dashboard`
- [ ] Jalankan test manual:
  - [ ] Register sebagai pelanggan → login → masuk dashboard pelanggan
  - [ ] Register sebagai admin dengan kode salah → harus gagal
  - [ ] Register sebagai admin dengan kode `PRIMA` → login → masuk dashboard admin

