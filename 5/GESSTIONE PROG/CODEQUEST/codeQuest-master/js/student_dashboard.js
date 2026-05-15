/**
 * ================================================
 * STUDENT DASHBOARD - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Gestisce la dashboard dello studente. Visualizza il profilo, il progresso totale,
 * e una tabella con lo stato di completamento dei 5 capitoli e delle relative missioni.
 * Consente allo studente di avviare il gioco da un pulsante nell'header.
 * 
 * FUNZIONAMENTO:
 * 1. Al caricamento, verifica se lo studente è autenticato (controllo localStorage)
 * 2. Carica i nomi dei capitoli dai file JSON
 * 3. Recupera i dati di progresso dal server tramite API
 * 4. Renderizza il profilo, il riassunto e la tabella con i progressi
 * 5. Consente di cliccare il bottone GIOCA per avviare il capitolo
 * 
 * DATI GLOBALI:
 * - studentId: ID dello studente da localStorage
 * - CHAPTER_NAMES: Map dei titoli dei capitoli caricati da JSON
 */

const studentId = localStorage.getItem('cq_student_id');

// Variabile globale per i nomi dei capitoli (caricati da file JSON)
let CHAPTER_NAMES = {};

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

/**
 * INIZIALIZZAZIONE
 * Questa funzione viene eseguita al caricamento della pagina
 */
async function init() {
    // Controllo autenticazione: se lo studente non è loggato, reindirizza al login
    if (!studentId) {
        window.location.href = 'student_login.html';
        return;
    }

    // Carica i nomi statici dei capitoli da file JSON
    await loadChapterNames();

    // Carica i dati di progresso dal server
    await loadProgress();
}

/**
 * CARICAMENTO NOMI CAPITOLI
 * Legge i file JSON dei 5 capitoli e popola la mappa CHAPTER_NAMES
 * Se c'è un errore, usa nomi di fallback generici
 */
async function loadChapterNames() {
    try {
        const chapters = [1, 2, 3, 4, 5];
        // Fetch parallelo di tutti i file JSON
        const promises = chapters.map(id => fetch(`js/data/chapters/chapter${id}.json`).then(r => r.json()));
        const data = await Promise.all(promises);
        // Popola la mappa con id come chiave e titolo come valore
        data.forEach(ch => {
            CHAPTER_NAMES[ch.id] = ch.title;
        });
    } catch (err) {
        console.error("Errore caricamento nomi capitoli:", err);
        // Fallback: usa nomi generici se il caricamento fallisce
        CHAPTER_NAMES = { 1: "Cap. 1", 2: "Cap. 2", 3: "Cap. 3", 4: "Cap. 4", 5: "Cap. 5" };
    }
}

/**
 * CARICAMENTO PROGRESSI
 * Effettua una richiesta al server per ottenere i dati del profilo e del progresso
 * dello studente attualmente loggato
 */
async function loadProgress() {
    try {
        const res = await fetch(`php/api/get_student_detail.php?studentId=${studentId}`);
        const data = await res.json();
        
        // Se la risposta è positiva, renderizza la dashboard
        if (data.success) {
            renderDashboard(data);
        }
    } catch (err) { console.error(err); }
}

/**
 * RENDERING DASHBOARD
 * Popola gli elementi HTML con i dati ricevuti dal server:
 * - Nome dello studente nell'header
 * - Informazioni di profilo (email, classe)
 * - Tabella con lo stato di avanzamento nei capitoli
 * - Conteggio totale missioni completate
 * 
 * @param {Object} data - Oggetto con proprietà 'student', 'progress'
 */
function renderDashboard(data) {
    const s = data.student;
    // Ottieni riferimenti agli elementi DOM
    const nameEl = document.getElementById('student-name');
    const profileEl = document.getElementById('profile-info');
    const tableEl = document.getElementById('progress-table');
    const summaryEl = document.getElementById('progress-summary');

    // Aggiorna il nome dello studente nell'header
    if (nameEl) nameEl.textContent = `Studente: ${s.nome} ${s.cognome}`;
    
    // Compila la sezione profilo con email e classe in modo sicuro
    if (profileEl) {
        profileEl.innerHTML = `
            <div class="profile-info-grid">
                <div class="profile-field">
                    <label>Email</label>
                    <span>${escapeHTML(s.email)}</span>
                </div>
                <div class="profile-field">
                    <label>Classe</label>
                    <span>${escapeHTML(s.class_name || 'Nessuna')}</span>
                </div>
            </div>
        `;
    }

    // Genera le righe della tabella, una per ogni capitolo
    let totalCompleted = 0;
    const rows = Array(5).fill(null).map((_, i) => {
        const chapterId = i + 1;
        // Trova i dati di progresso per questo capitolo
        const c = data.progress.find(p => p.chapter_id === chapterId);
        const title = CHAPTER_NAMES[chapterId] || `Capitolo ${chapterId}`;
        
        // Estrai lo stato di completamento di ogni missione (1 = completata, 0 = non completata)
        const m1 = c?.mission_1_completed == 1;
        const m2 = c?.mission_2_completed == 1;
        const m3 = c?.mission_3_completed == 1;
        const m4 = c?.mission_4_completed == 1;
        const boss = c?.boss_completed == 1;

        // Conta le missioni completate per il riassunto
        totalCompleted += [m1, m2, m3, m4, boss].filter(v => v).length;

        // Genera la riga HTML con i puntini di stato
        return `
            <tr>
                <td style="color: var(--accent-cyan); font-weight: bold;">${escapeHTML(title)}</td>
                <td><div class="mission-status">${renderDot(m1)}</div></td>
                <td><div class="mission-status">${renderDot(m2)}</div></td>
                <td><div class="mission-status">${renderDot(m3)}</div></td>
                <td><div class="mission-status">${renderDot(m4)}</div></td>
                <td><div class="mission-status">${renderDot(boss, true)}</div></td>
            </tr>
        `;
    });

    // Aggiorna gli elementi DOM
    if (tableEl) tableEl.innerHTML = rows.join('');
    // Mostra il conteggio totale (es: "12 / 25")
    if (summaryEl) summaryEl.textContent = `${totalCompleted} / 25`;
}

/**
 * RENDERING PUNTINO STATO MISSIONE
 * Genera un elemento HTML che rappresenta lo stato di una missione
 * I boss sono colorati diversamente dalle missioni normali
 * 
 * @param {Boolean} val - true se completata, false altrimenti
 * @param {Boolean} isBoss - true se è il boss finale
 * @returns {String} HTML del puntino
 */
function renderDot(val, isBoss = false) {
    const cls = val ? (isBoss ? 'dot completed boss' : 'dot completed') : 'dot';
    return `<div class="${cls}"></div>`;
}

/**
 * AVVIA UN CAPITOLO SPECIFICO
 * Salva l'ID del capitolo target in localStorage e reindirizza a game.html
 * 
 * @param {Number} id - ID del capitolo (1-5)
 */
window.playChapter = function(id) {
    localStorage.setItem('cq_target_chapter', id);
    window.location.href = 'game.html';
};

/**
 * AVVIA IL PRIMO CAPITOLO
 * Scorciatoia per avviare il capitolo 1 dal pulsante GIOCA nell'header
 */
window.playFirstAvailable = function() {
    localStorage.setItem('cq_target_chapter', 1);
    window.location.href = 'game.html';
};

/**
 * LOGOUT
 * Pulisce localStorage e reindirizza al login
 */
window.logout = function() {
    localStorage.clear();
    window.location.href = 'student_login.html';
};

// Avvia l'applicazione al caricamento della pagina
init();
