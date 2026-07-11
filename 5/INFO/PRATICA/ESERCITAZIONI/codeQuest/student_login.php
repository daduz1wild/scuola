<?php
require_once 'php/session.php';
if (!empty($_SESSION['role'])) {
    header('Location: ' . ($_SESSION['role'] === 'teacher' ? 'teacher_dashboard.php' : 'student_dashboard.php'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeQuest - Studente Accesso</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="theme-student" data-role="student">
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">&lt;/&gt; CODEQUEST</div>
            <div class="login-subtitle">STUDENT ACCESS TERMINAL</div>
            <div class="login-role">STUDENTE</div>
        </div>

        <div class="login-tabs">
            <div class="login-tab active" data-tab="login">LOGIN</div>
            <div class="login-tab" data-tab="register">REGISTRAZIONE</div>
        </div>

        <div class="login-body">
            <!-- LOGIN FORM -->
            <form id="form-login">
                <div class="form-group">
                    <label for="login-email">Email Studente</label>
                    <input type="email" id="login-email" placeholder="nome.cognome@scuola.it" required>
                </div>
                <div class="form-group">
                    <label for="login-pass">Password</label>
                    <input type="password" id="login-pass" placeholder="••••••••" required minlength="6">
                </div>
                <div class="form-error" id="login-error"></div>
                <button type="submit" class="btn-submit" id="login-btn">ENTER CYBERSPACE</button>
            </form>

            <!-- REGISTER FORM -->
            <form id="form-register" class="hidden">
                <div class="form-group">
                    <label for="reg-name">Nome Completo</label>
                    <input type="text" id="reg-name" placeholder="Mario Rossi" required>
                </div>
                <div class="form-group">
                    <label for="reg-email">Email</label>
                    <input type="email" id="reg-email" placeholder="nome.cognome@scuola.it" required>
                </div>
                <div class="form-group">
                    <label for="reg-class-code">Class Code (Fornito dal Prof)</label>
                    <input type="text" id="reg-class-code" placeholder="ABC-123" required minlength="5">
                </div>
                <div class="form-group">
                    <label for="reg-pass">Password</label>
                    <input type="password" id="reg-pass" placeholder="Min 6 caratteri" required minlength="6">
                </div>
                <div class="form-group">
                    <label for="reg-pass2">Conferma Password</label>
                    <input type="password" id="reg-pass2" placeholder="Ripeti password" required minlength="6">
                </div>
                <div class="form-error" id="reg-error"></div>
                <button type="submit" class="btn-submit" id="reg-btn">ENROLL NOW</button>
            </form>
        </div>

        <div class="login-footer">
            <a href="teacher_login.php">← Teacher Access</a>
            <a href="selection.php">← Back to selection</a>
        </div>
    </div>
    <script src="js/auth/auth.js"></script>
</body>

</html>