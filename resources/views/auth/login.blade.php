<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaPlay - Login</title>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body>

    <div class="auth-card">
        <div class="auth-logo">Arena<span>Play.</span></div>
        <p class="auth-subtitle">Masuk untuk melanjutkan booking lapangan</p>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Masuk</button>

            <p class="auth-footer">Belum punya akun? <a href="{{ route('register.form') }}">Daftar di sini</a></p>
            <p class="back-link"><a href="/">← Kembali ke Beranda</a></p>
        </form>
    </div>

</body>
</html>
