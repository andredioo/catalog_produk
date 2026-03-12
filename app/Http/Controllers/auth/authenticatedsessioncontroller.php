public function store(Request $request): RedirectResponse
public function handle($request, Closure $next)

{
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }
    abort(403);
}
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan']);
    }

    if (!\Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Password salah']);
    }

    auth()->login($user);

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
}