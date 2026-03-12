<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-96">

<h2 class="text-2xl font-bold text-center mb-6">Register</h2>

<form action="/register" method="POST">
@csrf

<input type="text" name="name" placeholder="Nama"
class="border p-2 w-full mb-3 rounded">

<input type="email" name="email" placeholder="Email"
class="border p-2 w-full mb-3 rounded">

<input type="password" name="password" placeholder="Password"
class="border p-2 w-full mb-3 rounded">

<button class="bg-blue-600 text-white w-full py-2 rounded">
Register
</button>

</form>

<p class="text-center mt-4">
Sudah punya akun?
<a href="/login" class="text-blue-600">Login</a>
</p>

</div>

</body>
</html>