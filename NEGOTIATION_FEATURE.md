# Fitur Negosiasi Harga Ongkir

Fitur ini memungkinkan pengguna untuk menegosiasikan harga ongkir dengan driver sebelum checkout.

## Cara Kerja

1. **Input Harga**: Pengguna dapat memasukkan harga ongkir yang diinginkan dalam field "Negotiate Delivery Fee"
2. **Kirim Negosiasi**: Klik tombol "Negotiate" untuk mengirim permintaan ke driver
3. **Status Pending**: Sistem menampilkan status "Negotiation Pending" sambil menunggu respons driver
4. **Respons Driver**: Driver dapat menerima atau menolak negosiasi
   - **Accepted**: Harga ongkir diubah sesuai permintaan, total order diperbarui
   - **Rejected**: Negosiasi ditolak, harga tetap seperti semula

## Komponen Teknis

### Model Order
- Kolom `delivery_fee`: Harga ongkir standar
- Kolom `negotiated_delivery_fee`: Harga yang dinegosiasikan
- Kolom `negotiation_status`: Status negosiasi (none, pending, accepted, rejected)
- Kolom `negotiation_message`: Pesan negosiasi

### Livewire Component
- `OrderComponent`: Menangani logika order dan negosiasi
- Method `negotiateDeliveryFee()`: Mengirim permintaan negosiasi
- Method `acceptNegotiation()`: Menerima negosiasi
- Method `rejectNegotiation()`: Menolak negosiasi
- Method `simulateDriverResponse()`: Simulasi respons driver (untuk demo)

### UI Elements
- Input field untuk harga ongkir yang diinginkan
- Tombol "Negotiate" untuk mengirim permintaan
- Status indicator untuk menampilkan progress negosiasi
- Tombol simulasi untuk testing (dalam mode development)

## Contoh Penggunaan

1. Harga ongkir standar: 19,000 IDR
2. Pengguna ingin mengurangi menjadi 15,000 IDR
3. Masukkan 15000 di field negosiasi
4. Klik "Negotiate"
5. Sistem menampilkan "Negotiation Pending"
6. Driver menerima → harga berubah menjadi 15,000 IDR
7. Total order diperbarui otomatis

## Pengembangan Lanjutan

Untuk implementasi production:
- Integrasi dengan sistem notifikasi real-time (WebSocket/Pusher)
- API untuk komunikasi dengan aplikasi driver
- Database untuk menyimpan history negosiasi
- Validasi harga minimum/maksimum
- Logging untuk audit trail