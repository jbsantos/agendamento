<?php
    session_start();
    if(isset($_SESSION['login_user'])){
        header("location: ../");
        exit;
    }

    // Carregar configurações de customização
    $customizacao = json_decode(file_get_contents(__DIR__ . '/../customizacao.json'), true);

    // Verificar se a logo URL está definida e acessível
    $logo_url = isset($customizacao['logo_url']) ? $customizacao['logo_url'] : 'https://i.postimg.cc/sgz8DC6V/login.png';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Agendamentos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Incluindo Bootstrap da CDN para a estrutura básica -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <style>
        /* Estilo personalizado para o formulário de login */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: <?php echo isset($customizacao['primary_color']) ? $customizacao['primary_color'] : '#0042DA'; ?>;
        }
        .login-form {
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: <?php echo isset($customizacao['navbar_color']) ? $customizacao['navbar_color'] : '#007BFF'; ?>;
            color: #fff; /* Texto branco para contraste */
        }
        .login-form h3 {
            color: <?php echo isset($customizacao['primary_color']) ? $customizacao['primary_color'] : '#0042DA'; ?>;
            text-align: center;
        }
        .login-form img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .form-control {
            background-color: #fff; /* Fundo branco para inputs */
            color: #000; /* Texto preto para inputs */
        }
        .form-control::placeholder {
            color: rgba(0, 0, 0, 0.5); /* Placeholder cinza */
        }
        #mobile-warning {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            font-size: 1.5rem;
            text-align: center;
            padding: 20px;
        }
        #blur-overlay {
            transition: filter 0.3s;
        }
        #blur-overlay.blurred {
            filter: blur(10px);
        }
    </style>
    <script>
        // Verifica se o dispositivo é móvel
        function checkIfMobile() {
            if (window.innerWidth <= 768) {
                document.getElementById('mobile-warning').style.display = 'flex';
                document.getElementById('blur-overlay').classList.add('blurred');
            }
        }
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('mobile-warning').style.display = 'flex';
                document.getElementById('blur-overlay').classList.add('blurred');
            } else {
                document.getElementById('mobile-warning').style.display = 'none';
                document.getElementById('blur-overlay').classList.remove('blurred');
            }
        });
    </script>
</head>
<body onload="checkIfMobile()">
    <div class="container">
        <div id="blur-overlay">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-4 col-md-6">
                    <div class="login-form">
                        <?php if (@file_get_contents($logo_url) !== false): ?>
                            <img src="<?php echo htmlentities($logo_url); ?>" alt="Logo" class="logo"><br>
                        <?php else: ?>
                            <p class="text-danger text-center">Logo não pôde ser carregada. Verifique a URL.</p>
                        <?php endif; ?>
                        
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username" style="color: #fff;">Usuário</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" style="color: #fff;">Senha</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div><br>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-block" style="background-color: <?php echo isset($customizacao['primary_color']) ? $customizacao['primary_color'] : '#0042DA'; ?>;">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mobile-warning">
    A resolução do seu dispositivo não é suportada. Recomendamos o uso de um PC para acessar esta aplicação.
    </div>

    <!-- Incluindo Bootstrap JS da CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
