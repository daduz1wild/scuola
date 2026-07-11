<?php
require_once 'php/session.php';
requirePageRole('student');
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | CodeQuest</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <script>
        window.CQ_USER = <?php echo json_encode($user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <header>
        <div class="logo">CodeQuest Student</div>
        <div class="user-info" id="student-name">Studente: <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div class="header-buttons">
            <button class="btn-play" onclick="playFirstAvailable()">GIOCA</button>
            <button onclick="logout()">Esci</button>
        </div>
    </header>

    <main class="container">
        <section class="profile-grid">
            <div class="card" id="profile-card">
                <h2>Profilo</h2>
                <div id="profile-info">Caricamento...</div>
            </div>
            <div class="card" id="summary-card">
                <h2>Progresso Totale</h2>
                <div id="progress-summary" class="summary-value">
                    0 / 25
                <h2>Inizia Missione</h2>
                <button onclick="playFirstAvailable()" style="width: 100%; margin-top: 1rem;">GIOCA</button>
            </div>
        </section>

        <h2 style="margin: 2rem 0 1rem; font-family: 'Orbitron'; color: var(--accent-cyan);">I Tuoi Capitoli</h2>
        
        <section class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Capitolo</th>
                        <th>Missione 1</th>
                        <th>Missione 2</th>
                        <th>Missione 3</th>
                        <th>Missione 4</th>
                        <th>Boss Finale</th>
                    </tr>
                </thead>
                <tbody id="progress-table">
                    <!-- Dynamic Content -->
                </tbody>
            </table>
        </section>
    </main>

    <script src="js/student_dashboard.js"></script>
</body>
</html>
