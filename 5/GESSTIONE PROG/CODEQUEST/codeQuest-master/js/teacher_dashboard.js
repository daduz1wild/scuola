/**
 * ================================================
 * TEACHER DASHBOARD - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Gestisce la dashboard del docente. Permette di:
 * - Creare e gestire classi con codici univoci
 * - Eliminare classi
 * - Visualizzare il progresso della classe (riepilogo) o del singolo studente (dettagliato)
 * - Monitorare il completamento dei 5 capitoli e delle 5 missioni per studente
 * 
 * FUNZIONAMENTO:
 * 1. Al caricamento, verifica l'autenticazione e carica i capitoli
 * 2. Carica le classi del docente dal server
 * 3. Quando il docente seleziona una classe, carica gli studenti
 * 4. Visualizza la tabella con due modalità: Riepilogo Classe o Singolo Studente
 * 5. Consente creazione e eliminazione di classi
 * 
 * DATI GLOBALI:
 * - teacherId: ID del docente da localStorage
 * - teacherName: Nome del docente da localStorage
 * - CHAPTER_NAMES: Map dei titoli dei capitoli
 * - currentClassData: Dati degli studenti e loro progressi per la classe selezionata
 */

// Riferimenti agli elementi del DOM
let CHAPTER_NAMES = {};
const teacherId = localStorage.getItem('cq_teacher_id');
const teacherName = localStorage.getItem('cq_teacher_name') || 'Admin';

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

// Riferimenti agli elementi del DOM
const teacherNameEl = document.getElementById('teacher-name');
const classSelect = document.getElementById('class-select');
const viewMode = document.getElementById('view-mode');
const studentSelectGroup = document.getElementById('student-select-group');
const studentSelect = document.getElementById('student-select');
const tableBody = document.getElementById('table-body');
const tableHead = document.getElementById('table-head');
const classesList = document.getElementById('classes-list');
const newClassNameInput = document.getElementById('new-class-name');
const deleteClassSelect = document.getElementById('delete-class-select');

/**
 * INIZIALIZZAZIONE
 * Eseguita al caricamento della pagina
 */
async function init() {
    // Controllo autenticazione: se il docente non è loggato, reindirizza al login
    if (!teacherId) {
        window.location.href = 'teacher_login.html';
        return;
    }

    // Mostra il nome del docente nell'header
    if (teacherNameEl) {
        teacherNameEl.textContent = "Docente: " + teacherName;
    }

    // Carica i titoli dei capitoli
    await loadChapterNames();
    
    // Configura gli event listener per i controlli
    setupEventListeners();

    // Carica le classi del docente dal server
    await loadClasses();
}

/**
 * CONFIGURAZIONE EVENT LISTENER
 * Associa gli handler agli eventi di cambio della modalità vista e selezione
 */
function setupEventListeners() {
    // Listener per il cambio tra vista di classe e vista di studente singolo
    if (viewMode) {
        viewMode.addEventListener('change', () => {
            if (viewMode.value === 'student') {
                // Mostra il dropdown per selezionare uno studente
                studentSelectGroup.style.display = 'flex';
            } else {
                studentSelectGroup.style.display = 'none';
            }
            updateTable();
        });
    }

    // Listener per il cambio della classe selezionata
    if (classSelect) {
        classSelect.addEventListener('change', async () => {
            if (classSelect.value) {
                // Carica gli studenti della classe selezionata
                await loadStudents(classSelect.value);
                updateTable();
            }
        });
    }

    // Listener per il cambio dello studente (rilevante solo in vista singolo studente)
    if (studentSelect) {
        studentSelect.addEventListener('change', updateTable);
    }
}

/**
 * CARICAMENTO NOMI CAPITOLI
 * Legge i file JSON dei 5 capitoli e popola CHAPTER_NAMES
 */
async function loadChapterNames() {
    try {
        const chapters = [1, 2, 3, 4, 5];
        const promises = chapters.map(id => fetch(`js/data/chapters/chapter${id}.json`).then(r => r.json()));
        const data = await Promise.all(promises);
        data.forEach(ch => {
            CHAPTER_NAMES[ch.id] = ch.title;
        });
    } catch (err) {
        console.error("Errore caricamento nomi capitoli:", err);
        // Fallback se il caricamento fallisce
        CHAPTER_NAMES = { 1: "Cap. 1", 2: "Cap. 2", 3: "Cap. 3", 4: "Cap. 4", 5: "Cap. 5" };
    }
}

/**
 * CARICAMENTO CLASSI DEL DOCENTE
 * Recupera dal server tutte le classi create dal docente corrente
 * Aggiorna i select dropdown e la lista visiva delle classi
 */
async function loadClasses() {
    try {
        const res = await fetch(`php/api/get_teacher_classes.php?teacherId=${teacherId}`);
        const data = await res.json();
        if (data.success) {
            // Aggiorna i dropdown select
            const options = '<option value="">-- Seleziona --</option>' + 
                data.classes.map(c => `<option value="${escapeHTML(c.class_id)}">${escapeHTML(c.class_name)} (${escapeHTML(c.class_code)})</option>`).join('');
            
            if (classSelect) classSelect.innerHTML = options;
            if (deleteClassSelect) deleteClassSelect.innerHTML = options;

            // Aggiorna la lista visiva delle classi con i codici
            if (classesList) {
                if (data.classes.length === 0) {
                    classesList.innerHTML = '<p style="color: var(--text-secondary);">Nessuna classe creata.</p>';
                } else {
                    classesList.innerHTML = data.classes.map(c => `
                        <div class="class-item" style="display: flex; justify-content: space-between; align-items: center; padding: 0.8rem; border-bottom: 1px solid rgba(0,212,255,0.1);">
                            <span style="font-weight: bold; color: var(--text-primary);">${escapeHTML(c.class_name)}</span>
                            <span style="font-family: 'Share Tech Mono'; color: var(--accent-cyan); background: rgba(0,212,255,0.1); padding: 0.2rem 0.5rem; border-radius: 4px; border: 1px solid var(--border-glow);">${escapeHTML(c.class_code)}</span>
                        </div>
                    `).join('');
                }
            }
        }
    } catch (err) { console.error(err); }
}

/**
 * CREAZIONE NUOVA CLASSE
 * Invia una richiesta al server per creare una nuova classe
 * Genera automaticamente un codice classe univoco
 */
window.createClass = async function() {
    const className = newClassNameInput.value.trim();
    if (!className) {
        alert("Inserisci un nome per la classe");
        return;
    }

    try {
        const res = await fetch('php/api/create_class.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                teacherId: teacherId,
                className: className
            })
        });
        const data = await res.json();
        
        if (data.success) {
            newClassNameInput.value = '';
            // Ricarica le classi per aggiornare i dropdown e la lista
            await loadClasses();
            alert("Classe creata con successo! Codice: " + data.classCode);
        } else {
            alert("Errore: " + data.message);
        }
    } catch (err) {
        console.error(err);
        alert("Errore durante la creazione della classe");
    }
}

/**
 * ELIMINAZIONE CLASSE
 * Elimina una classe e rimuove l'associazione dei suoi studenti
 * I dati di progresso degli studenti vengono mantenuti
 */
window.deleteClass = async function() {
    const classId = deleteClassSelect.value;
    if (!classId) {
        alert("Seleziona una classe da eliminare");
        return;
    }

    // Chiedi conferma all'utente
    const confirmDelete = confirm("Sei sicuro di voler eliminare questa classe? Tutti gli studenti perderanno l'associazione (ma non i loro progressi).");
    if (!confirmDelete) return;

    try {
        const res = await fetch('php/api/delete_class.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                teacherId: teacherId,
                classId: classId
            })
        });
        const data = await res.json();
        
        if (data.success) {
            // Ricarica tutto
            await loadClasses();
            alert("Classe eliminata con successo");
        } else {
            alert("Errore: " + data.message);
        }
    } catch (err) {
        console.error(err);
        alert("Errore durante l'eliminazione della classe");
    }
}

/**
 * CARICAMENTO STUDENTI DELLA CLASSE
 * Recupera dal server tutti gli studenti e i loro progressi per la classe selezionata
 * 
 * @param {String} classId - ID della classe
 */
async function loadStudents(classId) {
    try {
        const res = await fetch(`php/api/get_class_progress.php?classId=${classId}&teacherId=${teacherId}`);
        const data = await res.json();
        if (data.success) {
            // Salva i dati in una variabile globale per l'uso nelle funzioni di rendering
            window.currentClassData = data.data;
            // Aggiorna il dropdown degli studenti
            if (studentSelect) {
                studentSelect.innerHTML = '<option value="">-- Tutti gli studenti --</option>' + 
                    data.data.map(s => `<option value="${escapeHTML(s.studentInfo.student_id)}">${escapeHTML(s.studentInfo.cognome)} ${escapeHTML(s.studentInfo.nome)}</option>`).join('');
            }
        }
    } catch (err) { console.error(err); }
}

/**
 * AGGIORNAMENTO TABELLA
 * Renderizza la tabella in base alla modalità vista selezionata
 * - Classe: mostra riepilogo progresso per ogni studente
 * - Studente: mostra dettagli completi per uno studente selezionato
 */
function updateTable() {
    if (!window.currentClassData) return;

    // Scegli quale vista rendere in base alla modalità selezionata
    if (viewMode.value === 'class') {
        renderClassView(window.currentClassData);
    } else {
        const sid = studentSelect.value;
        if (sid) {
            // Trova i dati dello studente selezionato
            const studentData = window.currentClassData.find(s => s.studentInfo.student_id === sid);
            renderStudentDetailView(studentData);
        } else {
            tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 2rem;">Seleziona uno studente</td></tr>';
        }
    }
}

/**
 * RENDERING VISTA CLASSE
 * Visualizza una riga per ogni studente con puntini di progresso per cada capitolo
 * 
 * @param {Array} data - Array di oggetti studente con i loro dati di progresso
 */
function renderClassView(data) {
    tableHead.innerHTML = `<th>Studente</th><th>Cap. 1</th><th>Cap. 2</th><th>Cap. 3</th><th>Cap. 4</th><th>Cap. 5</th>`;
    tableBody.innerHTML = data.map(s => {
        // Per ogni capitolo, estrai i dati di progresso
        const chapters = Array(5).fill(null).map((_, i) => s.chapters.find(c => c.chapter_id === (i + 1)));
        return `
            <tr>
                <td style="font-weight: 600;">${escapeHTML(s.studentInfo.cognome)} ${escapeHTML(s.studentInfo.nome)}</td>
                ${chapters.map(c => `<td>${renderProgressDots(c)}</td>`).join('')}
            </tr>
        `;
    }).join('');
}

/**
 * RENDERING VISTA STUDENTE DETTAGLIATO
 * Visualizza per lo studente selezionato una riga per ogni capitolo
 * con il dettaglio delle 4 missioni e del boss finale
 * 
 * @param {Object} s - Oggetto con dati dello studente e i suoi progressi
 */
function renderStudentDetailView(s) {
    tableHead.innerHTML = `<th>Capitolo</th><th style="text-align:center">M1</th><th style="text-align:center">M2</th><th style="text-align:center">M3</th><th style="text-align:center">M4</th><th style="text-align:center">Boss</th>`;
    tableBody.innerHTML = Array(5).fill(null).map((_, i) => {
        const chapterId = i + 1;
        // Trova i dati del capitolo
        const c = s.chapters.find(ch => ch.chapter_id === chapterId);
        const title = CHAPTER_NAMES[chapterId] || `Settore ${chapterId}`;
        
        return `
            <tr>
                <td style="color: var(--accent-cyan); font-weight: bold;">${escapeHTML(title)}</td>
                <td style="text-align:center">${renderDot(c?.mission_1_completed)}</td>
                <td style="text-align:center">${renderDot(c?.mission_2_completed)}</td>
                <td style="text-align:center">${renderDot(c?.mission_3_completed)}</td>
                <td style="text-align:center">${renderDot(c?.mission_4_completed)}</td>
                <td style="text-align:center">${renderDot(c?.boss_completed, true)}</td>
            </tr>
        `;
    }).join('');
}

/**
 * RENDERING PUNTINI DI PROGRESSO (VISTA CLASSE)
 * Genera una visualizzazione compatta mostrando 5 puntini e il conteggio
 * 
 * @param {Object} c - Oggetto con dati di progresso del capitolo
 * @returns {String} HTML con i puntini e il conteggio
 */
function renderProgressDots(c) {
    if (!c) return '<span style="opacity:0.3">Nessun dato</span>';
    // Conta il numero di missioni completate
    const count = [c.mission_1_completed, c.mission_2_completed, c.mission_3_completed, c.mission_4_completed, c.boss_completed].filter(v => v == 1).length;
    return `<div class="mission-status">
        ${renderDot(c.mission_1_completed)}
        ${renderDot(c.mission_2_completed)}
        ${renderDot(c.mission_3_completed)}
        ${renderDot(c.mission_4_completed)}
        ${renderDot(c.boss_completed, true)}
        <span style="font-size: 0.7rem; margin-left: 5px;">${count}/5</span>
    </div>`;
}

/**
 * RENDERING PUNTINO SINGOLO
 * Genera un elemento HTML rappresentante lo stato di una missione
 * 
 * @param {Boolean} val - 1 se completata, 0 altrimenti
 * @param {Boolean} isBoss - true se è il boss finale
 * @returns {String} HTML del puntino
 */
function renderDot(val, isBoss = false) {
    const cls = val == 1 ? (isBoss ? 'dot completed boss' : 'dot completed') : 'dot';
    return `<div class="${cls}"></div>`;
}

/**
 * LOGOUT
 * Pulisce localStorage e reindirizza al login del docente
 */
window.logout = function() {
    localStorage.clear();
    window.location.href = 'teacher_login.html';
};

// Avvia l'applicazione al caricamento della pagina
init();
