# PT Caturmala – Aluminium Sales & Order Management System

Internal Sales & Order Management System untuk perusahaan distribusi aluminium, dibangun menggunakan Laravel dan Livewire.

Project ini dirancang untuk membantu pengelolaan produk, stok, dan pesanan secara terstruktur dengan tampilan modern bertema navy-metal yang profesional.

---

## 📌 Overview

PT Caturmala WebStore adalah sistem internal yang mendukung operasional penjualan dan manajemen inventori aluminium.

Sistem ini memungkinkan:
- Pengelolaan katalog produk
- Kontrol stok otomatis
- Proses pemesanan pelanggan
- Riwayat dan tracking pesanan
- Role management (Admin & User)

Project ini lebih dekat ke kategori **Sales & Order Management System / Mini ERP**, dan dapat dikembangkan lebih lanjut menjadi sistem CRM penuh.

---

## 🚀 Features

### 🔐 Authentication & Role
- Login & Register
- Role-based access (Admin & Customer)
- Admin dashboard
- User profile integration

### 📦 Product Management
- CRUD produk (Admin)
- Upload gambar produk
- Informasi harga & stok
- Detail produk dengan tampilan premium
- Stock validation saat checkout

### 🛒 Cart System
- Tambah produk ke keranjang
- Update quantity
- Hapus item
- Validasi stok real-time

### 🧾 Checkout & Order
- Data penerima otomatis dari akun
- Pembuatan order dengan transaksi database
- Pengurangan stok otomatis
- Riwayat pesanan user
- Manajemen pesanan oleh admin

### 🎨 UI & UX
- Navy-metal theme
- Responsive layout
- Premium product showcase
- Trust indicators (material verified, corrosion resistant, etc.)
- Clean & modern interface

---

## 🏗 Tech Stack

- Laravel 12
- Livewire 3
- TailwindCSS
- MySQL
- Vite
- PHP 8.3+

---

## 📂 Project Structure (Simplified)


app/
├── Livewire/
│ ├── Produk/
│ ├── Keranjang/
│ ├── Checkout/
│ └── Admin/
├── Models/
│ ├── Product
│ ├── Order
│ ├── OrderItem
│ ├── Cart
│ └── CartItem

resources/views/
├── livewire/
├── layouts/
└── welcome.blade.php


---

## ⚙ Installation Guide

### 1️⃣ Clone Repository

```bash
git clone https://github.com/USERNAME/REPOSITORY.git
cd REPOSITORY
