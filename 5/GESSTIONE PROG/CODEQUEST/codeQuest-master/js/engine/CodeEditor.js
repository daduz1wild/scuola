/**
 * CodeEditor - CodeQuest
 * Refactored for Style Separation and Single Return Compliance
 */

export const CodeEditor = {
    active: false,
    scene: null,
    challenge: null,
    onSuccess: null,
    onHint: null,
    onClose: null,
    hintCount: 0,
    container: null,
    textarea: null,
    highlightPre: null,
    lineNumbers: null,
    terminalBody: null,
    statusBarCursor: null,

    init(scene) {
        this.scene = scene;
        this._loadStyles();
        return this;
    },

    open(challenge, onSuccess, onHint, onClose) {
        if (!this.active) {
            this.active = true;
            this.challenge = challenge;
            this.onSuccess = onSuccess;
            this.onHint = onHint;
            this.onClose = onClose;
            this.hintCount = 0;

            if (this.scene?.input?.keyboard) {
                this.scene.input.keyboard.enabled = false;
                this.scene.input.keyboard.resetKeys();
            }

            this._buildUI();
            this._setupListeners();
            this.updateLineNumbers();
            this._updateCursor();

            requestAnimationFrame(() => {
                if (this.textarea) {
                    this.textarea.focus();
                    this._log('[SYS] CodeQuest Terminal v2.0', 't-info');
                    this._log('[CMD] Challenge: ' + (challenge.title || 'Unknown'), 't-cmd');
                    if (challenge.description) this._log('[INF] ' + challenge.description, 't-info');
                    this._log('────────────────────────────────────────', 't-info');
                }
            });
        }
    },

    close() {
        if (this.active) {
            this.active = false;
            if (this._focusGuard) { 
                clearInterval(this._focusGuard); 
                this._focusGuard = null; 
            }
            if (this.container) { 
                this.container.remove(); 
                this.container = null; 
            }
            if (this.scene?.input?.keyboard) {
                this.scene.input.keyboard.enabled = true;
            }
            if (this.onClose) {
                this.onClose();
            }
        }
    },

    _buildUI() {
        const el = document.createElement('div');
        el.className = 'cq-overlay';
        const starter = this.challenge?.initialCode || '// Write your code here\n';

        el.innerHTML = `
            <div class="cq-header">
                <div class="cq-title">
                    <span class="cq-logo">&lt;/&gt;</span>
                    <span class="cq-label">CODEQUEST <span class="cq-sep">//</span> TERMINAL</span>
                </div>
            </div>

            <div class="cq-body">
                <div class="cq-editor-wrap">
                    <div class="cq-line-numbers" id="cq-ln"></div>
                    <div class="cq-scroll-area">
                        <pre class="cq-highlight" id="cq-hl"></pre>
                        <textarea class="cq-ta" id="cq-ta" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off">${starter}</textarea>
                    </div>
                </div>

                <div class="cq-terminal">
                    <div class="cq-terminal-header">
                        <span class="cq-terminal-title">OUTPUT</span>
                        <div class="cq-terminal-actions">
                            <button class="cq-btn-sm" id="cq-t-clear">CLEAR</button>
                        </div>
                    </div>
                    <div class="cq-terminal-body" id="cq-t-body"></div>
                </div>
            </div>

            <div class="cq-footer">
                <div class="cq-btns">
                    <button class="cq-btn cq-btn-run" id="cq-run">▶ EXECUTE</button>
                    <button class="cq-btn cq-btn-hint" id="cq-hint">◈ HINT</button>
                    <button class="cq-btn cq-btn-close" id="cq-close">✕ CLOSE</button>
                </div>
                <div class="cq-status">
                    <span id="cq-cursor">LN 1 COL 1</span>
                    <span class="cq-sep">│</span>
                    <span>UTF-8</span>
                    <span class="cq-sep">│</span>
                    <span>JAVASCRIPT</span>
                </div>
            </div>
        `;

        document.body.appendChild(el);
        this.container = el;
        this.textarea = el.querySelector('#cq-ta');
        this.highlightPre = el.querySelector('#cq-hl');
        this.lineNumbers = el.querySelector('#cq-ln');
        this.terminalBody = el.querySelector('#cq-t-body');
        this.statusBarCursor = el.querySelector('#cq-cursor');
        
        this.updateHighlight();
        this.updateLineNumbers();
    },

    _setupListeners() {
        const ta = this.textarea;

        this._focusGuard = setInterval(() => {
            if (this.active && this.container && this.container.contains(document.activeElement) && document.activeElement !== ta) {
                ta.focus();
            }
        }, 100);

        this.container.addEventListener('mousedown', (e) => {
            e.stopPropagation();
            if (e.target !== ta && !e.target.classList.contains('cq-btn') && !e.target.classList.contains('cq-btn-sm')) {
                ta.focus();
            }
        }, true);

        ta.addEventListener('scroll', () => {
            if (this.highlightPre) {
                this.highlightPre.scrollTop = ta.scrollTop;
                this.highlightPre.scrollLeft = ta.scrollLeft;
            }
            if (this.lineNumbers) {
                this.lineNumbers.scrollTop = ta.scrollTop;
            }
        });

        ta.addEventListener('input', () => {
            this.updateHighlight();
            this.updateLineNumbers();
        });

        ta.addEventListener('keyup', () => this._updateCursor());
        ta.addEventListener('click', () => this._updateCursor());

        ta.addEventListener('keydown', (e) => {
            e.stopPropagation();
            e.stopImmediatePropagation();

            if (e.key === 'Tab' && !e.shiftKey) {
                e.preventDefault();
                this._insert('    ');
            } else if (e.key === 'Tab' && e.shiftKey) {
                e.preventDefault();
                this._outdent();
            } else if (e.key === 'Enter') {
                e.preventDefault();
                const start = ta.selectionStart;
                const val = ta.value;
                const lineStart = val.lastIndexOf('\n', start - 1) + 1;
                const currentLine = val.substring(lineStart, start);
                const indent = currentLine.match(/^\s*/)[0];
                const extra = (val[start - 1] === '{' || val[start - 1] === '(') ? '    ' : '';
                this._insert('\n' + indent + extra);
            } else if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                this.runCode();
            }
        }, true);

        this.container.addEventListener('keyup', (e) => {
            e.stopPropagation();
            e.stopImmediatePropagation();
        }, true);

        this.container.querySelector('#cq-run').addEventListener('click', (e) => { e.stopPropagation(); this.runCode(); });
        this.container.querySelector('#cq-hint').addEventListener('click', (e) => { e.stopPropagation(); this.requestHint(); });
        this.container.querySelector('#cq-close').addEventListener('click', (e) => { e.stopPropagation(); this.close(); });
        this.container.querySelector('#cq-t-clear').addEventListener('click', (e) => {
            e.stopPropagation();
            this.terminalBody.innerHTML = '';
            this._log('[SYS] Terminal cleared', 't-info');
        });
    },

    _insert(text) {
        const ta = this.textarea;
        const start = ta.selectionStart;
        ta.value = ta.value.substring(0, start) + text + ta.value.substring(ta.selectionEnd);
        ta.selectionStart = ta.selectionEnd = start + text.length;
        this.updateHighlight();
        this.updateLineNumbers();
        this._updateCursor();
    },

    _outdent() {
        const ta = this.textarea;
        const start = ta.selectionStart;
        const val = ta.value;
        const lineStart = val.lastIndexOf('\n', start - 1) + 1;
        const beforeCursor = val.substring(lineStart, start);
        const match = beforeCursor.match(/( {1,4}|\t)$/);

        if (match) {
            const removeLen = match[0].length;
            const removeStart = start - removeLen;
            ta.value = val.substring(0, removeStart) + val.substring(start);
            ta.selectionStart = ta.selectionEnd = removeStart;
            this.updateHighlight();
            this.updateLineNumbers();
            this._updateCursor();
        }
    },

    _updateCursor() {
        if (this.textarea) {
            const pos = this.textarea.selectionStart;
            const lines = this.textarea.value.substring(0, pos).split('\n');
            const ln = lines.length;
            const col = lines[lines.length - 1].length + 1;
            if (this.statusBarCursor) {
                this.statusBarCursor.textContent = 'LN ' + ln + ' COL ' + col;
            }
        }
    },

    updateLineNumbers() {
        if (this.textarea && this.lineNumbers) {
            const count = this.textarea.value.split('\n').length;
            let nums = '';
            for (let i = 1; i <= count; i++) {
                nums += i + '\n';
            }
            this.lineNumbers.textContent = nums;
        }
    },

    updateHighlight() {
        if (this.textarea && this.highlightPre) {
            let code = this.textarea.value
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');

            code = code.replace(/(`(?:[^`\\]|\\.)*`)/g, '<span class="syn-str">$1</span>');
            code = code.replace(/("(?:[^"\\]|\\.)*")/g, '<span class="syn-str">$1</span>');
            code = code.replace(/('(?:[^'\\]|\\.)*')/g, '<span class="syn-str">$1</span>');
            code = code.replace(/(\/\/[^\n]*)/g, '<span class="syn-cm">$1</span>');
            code = code.replace(/(\/\*[\s\S]*?\*\/)/g, '<span class="syn-cm">$1</span>');

            const kws = 'const|let|var|function|return|if|else|for|while|class|extends|new|this|import|export|from|default|async|await|try|catch|finally|throw|typeof|instanceof|switch|case|break|continue|yield|do|in|of|delete|void|super|static|get|set|constructor';
            code = code.replace(new RegExp('\\b(' + kws + ')\\b', 'g'), '<span class="syn-kw">$1</span>');
            code = code.replace(/\b(true|false|null|undefined|NaN|Infinity)\b/g, '<span class="syn-val">$1</span>');
            code = code.replace(/\b(\d+\.?\d*)\b/g, '<span class="syn-num">$1</span>');
            code = code.replace(/(\w+)(?=\()/g, '<span class="syn-fn">$1</span>');

            this.highlightPre.innerHTML = code + '\n';
        }
    },

    async runCode() {
        const code = this.textarea.value;
        const id = this.challenge?.id || 'challenge';
        const studentId = localStorage.getItem('cq_student_id');
        
        this._log('[CMD] Running...', 't-cmd');

        if (studentId) {
            const isBoss = !!this.challenge?.isBoss;
            const chapter = this.scene?.chapterIndex ?? this.challenge?.chapter ?? 0;
            try {
                const res = await fetch('php/api/validate_puzzle.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ 
                        studentId, 
                        puzzleId: id, 
                        chapter, 
                        code, 
                        isBoss,
                        validation: this.challenge.validation
                    })
                });
                const data = await res.json();
                this._handleValidationResult(data);
            } catch (e) {
                this._log('[ERR] Connection to validation server failed', 't-err');
                this._log('[INF] Check that XAMPP is running', 't-info');
                if (this.onSuccess) this.onSuccess({ success: false });
            }
        } else {
            this._log('[ERR] Login required to submit code', 't-err');
            this._log('[INF] Please login at student_login.html', 't-info');
            if (this.onSuccess) this.onSuccess({ success: false });
        }
    },

    _handleValidationResult(data) {
        try {
            if (data.success) {
                this._log('[OK] Validation passed', 't-ok');
                if (this.onSuccess) this.onSuccess({ success: true });
            } else {
                this._log('[ERR] Validation failed', 't-err');
                if (data.errors && data.errors.length > 0) {
                    data.errors.forEach(e => this._log('[ERR] ' + e, 't-err'));
                } else if (data.message) {
                    this._log('[ERR] ' + data.message, 't-err');
                }
                if (this.onSuccess) this.onSuccess({ success: false });
            }
        } catch (err) {
            console.error("Callback error:", err);
            this._log('[ERR] Internal game error: ' + err.message, 't-err');
        }
    },

    requestHint() {
        this.hintCount++;
        if (this.onHint) {
            this.onHint(this.hintCount);
        }
        if (!this.challenge?.hints?.[this.hintCount - 1]) {
            this._log('[SYS] No more hints available', 't-info');
        }
    },

    showHint(text) {
        this._log('[HNT] ' + text, 't-cmd');
    },

    _log(text, cls) {
        if (this.terminalBody) {
            const d = document.createElement('div');
            d.className = cls || '';
            d.textContent = text;
            this.terminalBody.appendChild(d);
            this.terminalBody.scrollTop = this.terminalBody.scrollHeight;
        }
    },

    _loadStyles() {
        if (!document.getElementById('cq-editor-styles')) {
            const link = document.createElement('link');
            link.id = 'cq-editor-styles';
            link.rel = 'stylesheet';
            link.href = 'css/code-editor.css';
            document.head.appendChild(link);
        }
    }
};
