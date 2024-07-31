<?php
session_start();
require __DIR__ . '/../app/includes/header.php'; // Sayfa başlığı ve menü çubuğu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Örnek kullanıcı doğrulaması (gerçek bir uygulamada veritabanı kontrolü yapın)
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['user'] = [
            'username' => $username,
            'role' => 'admin'
        ];
        header('Location: /?path=Home');
        exit;
    } else {
        $error = 'Geçersiz kullanıcı adı veya şifre';
    }
}
?>

<!DOCTYPE html>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>Giriş Yap</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="login.php" id="loginForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Şifre</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
                            <button type="button" class="btn btn-secondary w-100 mt-2" onclick="autoFill()">Örnek Girişi Bilgilerini Otomatik Doldur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function autoFill() {
            document.getElementById('username').value = 'admin';
            document.getElementById('password').value = 'password';
        }
    </script>
</html>
