<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h1>Dashboard Admin</h1>

<a href="{{ route('logout') }}">Logout</a>

<h2>Data Foto</h2>

<a href="{{ route('foto.create') }}">Tambah Foto</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Judul</th>
        <th>Gambar</th>
    </tr>

    @foreach($fotos as $foto)
    <tr>
        <td>{{ $foto->judul }}</td>
        <td>
            <img src="{{ asset('storage/'.$foto->gambar) }}" width="100">
        </td>
        <td>{{ $foto->harga }}</td>
        <td>{{ $foto->rating }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>