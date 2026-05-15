/**
 * ================================================
 * AUTHENTICATION SYSTEM - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Gestisce login e registrazione per studenti e insegnanti.
 * Implementa validazione client-side e comunicazione con i server API.
 * Supporta interfaccia con tab per passare tra login e registrazione.
 * 
 * FUNZIONAMENTO:
 * 1. Rileva il ruolo (studente o insegnante) da data-role nel body
 * 2. Configura i tab e i form per passare tra login/registrazione
 * 3. Valida email, password e, per studenti, codice classe
 * 4. Invia le credenziali al server per autenticazione/registrazione
 * 5. Salva i dati di sessione in localStorage
 * 6. Mostra messaggio di successo o errore
 * 
 * DATI GLOBALI:
 * - Auth.role: 'teacher' o 'student' (determinato da HTML)
 */

/**
 * Funzione di utilità per prevenire XSS sfuggendo ai caratteri HTML speciali
 */
function escapeHTML(str) {
    if (str == null) return '';
    return String(str).replace(/[&<>'"]/g, tag => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        "'": '&#39;',
        '"': '&quot;'
    }[tag] || tag));
}

const Auth = {
    /**
     * INIZIALIZZAZIONE
     * Eseguita al caricamento della pagina
     */
    init() {
        // Legge il ruolo dal data-role dell'elemento body
        this.role = document.body.dataset.role; // 'teacher' o 'student'
        this.setupTabs();
        this.setupForms();
    },

    /**
     * CONFIGURAZIONE TAB
     * Configura i tab per passare tra login e registrazione
     * Ogni tab mostra/nasconde il form corrispondente
     */
    setupTabs() {
        document.querySelectorAll('.login-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Rimuove la classe 'active' da tutti i tab
                document.querySelectorAll('.login-tab').forEach(t => t.classList.remove('active'));
                // Aggiunge 'active' al tab cliccato
                tab.classList.add('active');
                
                // Ottiene il valore del data-tab (login o register)
                const mode = tab.dataset.tab;
                
                // Mostra/nasconde i form di conseguenza
                document.getElementById('form-login').classList.toggle('hidden', mode !== 'login');
                document.getElementById('form-register').classList.toggle('hidden', mode !== 'register');
                
                // Pulisce i messaggi di errore precedenti
                document.querySelectorAll('.form-error').forEach(e => e.textContent = '');
            });
        });
    },

    /**
     * CONFIGURAZIONE FORM
     * Collega gli handler agli eventi di submit dei form
     */
    setupForms() {
        document.getElementById('form-login').addEventListener('submit', (e) => this.handleLogin(e));
        document.getElementById('form-register').addEventListener('submit', (e) => this.handleRegister(e));
    },

    /**
     * VALIDAZIONE
     * Valida i dati inseriti dall'utente lato client
     * Effettua controlli su email, password e codice classe
     * 
     * @param {String} email - Email dell'utente
     * @param {String} pass - Password
     * @param {String} pass2 - Conferma password (opzionale)
     * @param {String} classCode - Codice classe per studenti (opzionale)
     * @returns {String} Messaggio di errore, stringa vuota se valido
     */
    validate(email, pass, pass2 = null, classCode = null) {
        let error = '';
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Controlla il formato dell'email
        if (!emailRegex.test(email)) {
            error = 'Inserisci un indirizzo email valido';
        } 
        // Controlla la lunghezza minima della password
        else if (pass.length < 6) {
            error = 'La password deve contenere almeno 6 caratteri';
        } 
        // Per registrazione, verifica che le password corrispondano
        else if (pass2 !== null && pass !== pass2) {
            error = 'Le password non corrispondono';
        } 
        // Per studenti, verifica il codice classe
        else if (this.role === 'student' && classCode !== null && classCode.length < 5) {
            error = 'Il codice classe non è valido';
        }

        return error;
    },

    /**
     * GESTIONE LOGIN
     * Effettua il login inviando email e password al server
     * Se succede, salva i dati di sessione e reindirizza
     * 
     * @param {Event} e - Evento submit del form
     */
    async handleLogin(e) {
        e.preventDefault();
        const btn = document.getElementById('login-btn');
        const err = document.getElementById('login-error');
        const email = document.getElementById('login-email').value.trim();
        const pass = document.getElementById('login-pass').value;

        // Validazione client-side
        const clientError = this.validate(email, pass);

        if (clientError) {
            err.textContent = clientError;
        } else {
            // Disabilita il bottone durante la trasmissione
            btn.disabled = true;
            btn.textContent = 'CONNECTING...';
            err.textContent = '';

            try {
                // Chiama l'endpoint appropriato (student_login.php o teacher_login.php)
                const endpoint = `php/api/${this.role}_login.php`;
                const res = await fetch(endpoint, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password: pass })
                });
                const data = await res.json();

                if (data.success) {
                    // Salva i dati di sessione
                    this.saveSession(data);
                    
                    // Per studenti, recupera e aggiorna i progressi dal DB
                    if (this.role === 'student') {
                        await this.updateStudentProgress(data.studentId);
                    }
                    
                    // Reindirizza
                    window.location.href = this.role === 'teacher' ? 'teacher_dashboard.html' : 'game.html';
                } else {
                    // Mostra il messaggio di errore dal server
                    err.textContent = data.message || 'Accesso negato';
                    btn.disabled = false;
                    btn.textContent = this.role === 'teacher' ? 'ACCESS PANEL' : 'ENTER CYBERSPACE';
                }
            } catch (error) {
                // Errore di rete
                err.textContent = 'Errore di sistema. Riprova più tardi.';
                btn.disabled = false;
                btn.textContent = 'ACCESS PANEL';
            }
        }
    },

    /**
     * GESTIONE REGISTRAZIONE
     * Effettua la registrazione inviando i dati al server
     * Se succede, mostra un messaggio di successo con codice classe (se docente)
     * 
     * @param {Event} e - Evento submit del form
     */
    async handleRegister(e) {
        e.preventDefault();
        const btn = document.getElementById('reg-btn');
        const err = document.getElementById('reg-error');
        const name = document.getElementById('reg-name').value.trim();
        const email = document.getElementById('reg-email').value.trim();
        const pass = document.getElementById('reg-pass').value;
        const pass2 = document.getElementById('reg-pass2').value;
        // Per studenti, leggi il codice classe; per docenti, è null
        const classCode = this.role === 'student' ? document.getElementById('reg-class-code').value.trim() : null;

        // Validazione client-side
        const clientError = this.validate(email, pass, pass2, classCode);

        if (clientError) {
            err.textContent = clientError;
        } else {
            // Disabilita il bottone durante la trasmissione
            btn.disabled = true;
            btn.textContent = 'TRANSMITTING...';
            err.textContent = '';

            try {
                // Chiama l'endpoint appropriato (student_register.php o teacher_register.php)
                const endpoint = `php/api/${this.role}_register.php`;
                const body = { name, email, password: pass };
                // Aggiungi il codice classe se è uno studente
                if (this.role === 'student') body.classCode = classCode;

                const res = await fetch(endpoint, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(body)
                });
                const data = await res.json();

                if (data.success) {
                    // Mostra il messaggio di successo (con codice classe se docente)
                    this.showSuccess(data);
                } else {
                    // Mostra il messaggio di errore dal server
                    err.textContent = data.message || 'Registrazione fallita';
                    btn.disabled = false;
                    btn.textContent = 'CREATE ACCOUNT';
                }
            } catch (error) {
                // Errore di rete
                err.textContent = 'Errore di sistema. Riprova più tardi.';
                btn.disabled = false;
                btn.textContent = 'CREATE ACCOUNT';
            }
        }
    },

    /**
     * SALVA SESSIONE
     * Salva i dati dell'utente in localStorage per mantenerli tra le pagine
     * 
     * @param {Object} data - Dati ricevuti dal server dopo login/registrazione
     */
    saveSession(data) {
        localStorage.setItem('cq_role', this.role);
        if (this.role === 'teacher') {
            // Per insegnanti
            localStorage.setItem('cq_teacher_id', data.teacherId);
            localStorage.setItem('cq_teacher_name', data.name);
        } else {
            // Per studenti
            localStorage.setItem('cq_student_id', data.studentId);
            localStorage.setItem('cq_student_name', data.name);
            localStorage.setItem('cq_student_xp', data.xp || 0);
        }
    },

    /**
     * AGGIORNA PROGRESSI STUDENTE
     * Recupera i progressi più recenti dal DB e li salva nel localStorage
     * 
     * @param {String} studentId - ID dello studente
     */
    async updateStudentProgress(studentId) {
        try {
            console.log('[AUTH] Fetching progress for studentId:', studentId);
            const res = await fetch('php/api/get_student_progress.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ studentId })
            });
            const data = await res.json();
            console.log('[AUTH] Progress API response:', data);
            
            if (data.success && data.progress) {
                // Salva i progressi nel localStorage con chiave specifica per il gioco
                const saveData = {
                    ...data.progress,
                    timestamp: Date.now()
                };
                localStorage.setItem('cq_save_data', JSON.stringify(saveData));
                console.log('[AUTH] Progress saved to localStorage:', saveData);
            } else {
                console.warn('[AUTH] API success false or no progress data:', data);
            }
        } catch (error) {
            console.error('[AUTH] Failed to update student progress:', error);
        }
    },

    showSuccess(data) {
        const overlay = document.createElement('div');
        overlay.className = 'success-overlay';

        let content = '';
        if (this.role === 'teacher') {
            content = `
                <h3>ACCOUNT CREATED</h3>
                <p>Benvenuto, ${escapeHTML(data.name)}!</p>
                <div class="class-code-display">
                    <div class="label">IL TUO CLASS CODE</div>
                    <div class="code">${escapeHTML(data.classCode)}</div>
                    <div class="label">Condividi questo codice con gli studenti</div>
                </div>
                <button class="btn-submit" onclick="window.location.href='teacher_dashboard.html'">GO TO DASHBOARD</button>
            `;
        } else {
            content = `
                <h3>ENROLLMENT COMPLETE</h3>
                <p>Benvenuto nel programma, ${escapeHTML(data.name)}!</p>
                <p>Il tuo account è stato creato con successo.</p>
                <button class="btn-submit" onclick="window.location.href='student_login.html'">PROCEED TO LOGIN</button>
            `;
        }

        overlay.innerHTML = `<div class="success-card">${content}</div>`;
        document.body.appendChild(overlay);
    }
};

// Inizializza il sistema di autenticazione al caricamento della pagina
Auth.init();
