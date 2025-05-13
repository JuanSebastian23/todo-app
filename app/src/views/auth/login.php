<?php
// Archivo donde se define la ruta de la vista de inicio de sesión
include_once __DIR__ . '/../../../routes/dirs.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo CSS_URL; ?>/auth/viewLogin.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="auth-container">
        <div class="auth-wrapper">
            <div class="auth-content">
                <div class="glassmorphism">
                    <div class="auth-tabs">
                        <div class="tab-buttons">
                            <button class="tab-btn active" data-tab="login">Iniciar Sesión</button>
                            <button class="tab-btn" data-tab="register">Registro</button>
                            <button class="tab-btn" data-tab="forgot">Recuperar</button>
                        </div>

                        <!-- Formulario de Inicio de Sesión -->
                        <div class="tab-content active" id="login">
                            <form action="/auth/login" method="POST" class="needs-validation" novalidate>
                                <div class="mb-4">
                                    <label class="form-label">Correo electrónico</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope-fill"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email" placeholder="ejemplo@correo.com" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" class="form-control password-input" name="password" placeholder="••••••••" required>
                                        <span class="input-group-text password-toggle" style="cursor:pointer;">
                                            <i class="bi bi-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember">
                                        <label class="form-check-label" for="remember">Recordarme</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-3 mb-4">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                                </button>

                                <div class="divider">
                                    <span class="divider-text">o continúa con</span>
                                </div>

                                <div class="social-buttons">
                                    <button type="button" class="btn btn-social btn-google w-100">
                                        <i class="bi bi-google"></i>
                                        <span>Google</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Formulario de Registro -->
                        <div class="tab-content" id="register">
                            <form action="/auth/register" method="POST" class="needs-validation" novalidate id="registerForm">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-fill"></i>
                                        </span>
                                        <input type="text" class="form-control" name="first_name" placeholder="Tu nombre" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Apellido</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-fill"></i>
                                        </span>
                                        <input type="text" class="form-control" name="last_name" placeholder="Tu apellido" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Correo electrónico</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope-fill"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email" placeholder="ejemplo@correo.com" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" class="form-control password-input" name="password" id="registerPassword" placeholder="••••••••" required>
                                        <span class="input-group-text password-toggle" style="cursor:pointer;">
                                            <i class="bi bi-eye-slash"></i>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback d-block" id="passwordError" style="display:none;"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirmar contraseña</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" class="form-control password-input" name="password_confirmation" id="registerPasswordConfirm" placeholder="••••••••" required>
                                        <span class="input-group-text password-toggle" style="cursor:pointer;">
                                            <i class="bi bi-eye-slash"></i>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback d-block" id="confirmError" style="display:none;"></div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                    <i class="bi bi-person-plus-fill me-2"></i>Registrarse
                                </button>

                                <div class="divider">
                                    <span class="divider-text">o regístrate con</span>
                                </div>

                                <div class="social-buttons">
                                    <button type="button" class="btn btn-social btn-google w-100">
                                        <i class="bi bi-google"></i>
                                        <span>Google</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Formulario de Recuperación de Contraseña -->
                        <div class="tab-content" id="forgot">
                            <form action="/auth/forgot-password" method="POST" class="needs-validation" novalidate>
                                <div class="mb-4">
                                    <label class="form-label">Correo electrónico</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope-fill"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email" placeholder="ejemplo@correo.com" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-3 mb-4">
                                    <i class="bi bi-send-fill me-2"></i>Enviar
                                </button>
                                <div class="text-center">
                                    <p class="mb-0">Te enviaremos un enlace para restablecer tu contraseña</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth-image">
                <div class="image-overlay"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo JS_URL; ?>/auth/scriptLogin.js"></script>
</body>

</html>