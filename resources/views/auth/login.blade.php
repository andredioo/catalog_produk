<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-purple-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-96">

<h2 class="text-2xl font-bold text-center mb-6">Login</h2>

<form action="/login" method="POST">
@csrf

<input type="email" name="email" placeholder="Email"
class="border p-2 w-full mb-4 rounded">

<input type="password" name="password" placeholder="Password"
class="border p-2 w-full mb-4 rounded">

<button class="bg-purple-600 text-white w-full py-2 rounded">
Login
</button>

</form>

<p class="text-center mt-4">
Belum punya akun?
<a href="/register" class="text-purple-600">Register</a>
</p>

</div>

</body>
</html>