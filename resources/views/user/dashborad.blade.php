<!DOCTYPE html>
<html>
<head>
<title>Dashboard User</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<div class="bg-blue-600 text-white p-4">
<h1 class="text-xl font-bold">Dashboard User </h1>
</div>

<div class="p-6">

<h2 class="text-xl font-bold mb-4">DATA PRODUK</h2>

<div class="grid grid-cols-4 gap-4">

@foreach($fotos as $foto)

<div class="bg-white p-3 rounded shadow">

<img src="/foto/{{ $foto->gambar }}" class="mb-2">

<p class="font-bold text-center">{{ $foto->judul }}</p>

<form action="/komentar/store" method="POST" class="mt-2">
@csrf

<input type="hidden" name="foto_id" value="{{ $foto->id }}">

<input type="text" name="nama" placeholder="Nama"
class="border p-1 w-full mb-1">

<textarea name="komentar" placeholder="Komentar"
class="border p-1 w-full mb-1"></textarea>

<button class="bg-blue-500 text-white px-3 py-1 rounded">
Kirim
</button>

</form>

</div>

@endforeach

</div>

</div>

</body>
</html>
