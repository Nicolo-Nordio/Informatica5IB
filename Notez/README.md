# **APP NOTEZ**

### **0\. Struttura del progetto**

```
src/
├── main.js
├── App.vue
├── stores/
│   ├── notes.js
│   └── tags.js
├── components/
│   ├── NoteCard.vue
│   ├── NoteEditor.vue
│   ├── TagChip.vue
│   └── NotesGrid.vue
├── views/
│   ├── HomeView.vue
│   ├── TagManager.vue
│   └── NoteView.vue
├── utils/
│   └── db.js
```

### **1\. Struttura del Database (IndexedDB)**

#### `src/utils/db.js`

**Responsabilità**: Configurazione e gestione del database IndexedDB.  
 

**Funzionalità**:

*   Crea e inizializza il database `notezDB` con due "object store":
    *   `notes`: Contiene tutte le note con i relativi metadati (titolo, contenuto, tag, date).
    *   `tags`: Memorizza i tag con nome e colore.
*   Offre metodi CRUD standard (`getAll`, `get`, `add`, `put`, `delete`) per interagire con IndexedDB.  
    **Perché è importante**: Astrae la complessità di IndexedDB, fornendo un'interfaccia semplice per gli store Pinia.

---

### **2\. Store Pinia (Gestione Stato)**

#### `src/stores/notes.js`

**Responsabilità**: Gestisce lo stato e la logica delle note.  
 

**Funzionalità**:

*   **Stato**: Mantiene la lista delle note, lo stato di caricamento e eventuali errori.
*   **Azioni**:
    *   `loadNotes`: Carica tutte le note dal DB e le ordina per data.
    *   `addNote`/`updateNote`/`deleteNote`: CRUD base per le note.
    *   `addTagToNote`/`removeTagFromNote`: Collegamento tra note e tag.
*   **Getters**:
    *   `getNoteById`: Trova una nota per ID.
    *   `getNotesByTag`: Filtra note per tag.  
        **Perché è importante**: Centralizza la logica delle note e si integra con il DB.

#### `src/stores/tags.js`

**Responsabilità**: Gestisce lo stato e la logica dei tag.  
 

**Funzionalità**:

*   **Stato**: Lista dei tag, caricamento ed errori.
*   **Azioni**: CRUD per i tag (`addTag`, `updateTag`, `deleteTag`).
*   **Getters**: Ricerca tag per ID o nome.  
    **Perché è importante**: Gestisce i dati dei tag e garantisce l'unicità dei nomi.

---

### **3\. Componenti UI**

#### `src/components/TagChip.vue`

**Responsabilità**: Visualizza un singolo tag come chip interattivo.  
 

**Funzionalità**:

*   Mostra il nome del tag con colore personalizzato.
*   Supporta dimensioni (`small`/`default`) e icone opzionali.
*   Emette eventi per click e rimozione.  
    **Perché è importante**: Riutilizzabile in tutta l'app (es. note, filtri, editor).

#### `src/components/NoteCard.vue`

**Responsabilità**: Mostra l'anteprima di una nota in una card.  
 

**Funzionalità**:

*   Visualizza titolo, contenuto troncato, tag e data.
*   Emette eventi per apertura modifica ed eliminazione.  
    **Perché è importante**: Fornisce una vista compatta delle note nella griglia.

#### `src/components/NoteEditor.vue`

**Responsabilità**: Editor per creare/modificare note.  
 

**Funzionalità**:

*   Campi per titolo e contenuto.
*   Selezione tag con `v-combobox`.
*   Gestisce il salvataggio e l'annullamento.  
    **Perché è importante**: Riutilizzabile sia per nuove note che per modifiche.

#### `src/components/NotesGrid.vue`

**Responsabilità**: Griglia responsive con filtri per le note.  
 

**Funzionalità**:

*   **Ricerca full-text** nel titolo e contenuto.
*   **Filtro per tag multipli** (usando `v-select`).
*   Mostra una lista di `NoteCard` o un messaggio se non ci sono note.  
    **Perché è importante**: Riunisce tutte le funzionalità di visualizzazione e filtro delle note.

---

### **4\. View (Pagine)**

#### `src/views/HomeView.vue`

**Responsabilità**: Pagina principale con la lista delle note.  
 

**Funzionalità**:

*   Utilizza `NotesGrid` per mostrare le note.
*   Gestisce la logica di apertura/modifica/eliminazione.
*   Mostra un dialog con `NoteEditor` per modificare le note.  
    **Perché è importante**: Coordina i componenti e gli store per la vista principale.

#### `src/views/TagManager.vue`

**Responsabilità**: Pagina di gestione dei tag.  
 

**Funzionalità**:

*   Form per creare nuovi tag con selettore colore (`v-color-picker`).
*   Lista dei tag esistenti con opzione di eliminazione.  
    **Perché è importante**: Permette all'utente di organizzare i tag.

---

### **5\. Configurazione App**

#### `src/App.vue`

**Responsabilità**: Layout principale dell'app.  
 

**Funzionalità**:

*   Barra di navigazione con menu laterale.
*   Contenitore per le view (`router-view`).  
    **Perché è importante**: Definisce la struttura UI comune a tutte le pagine.

#### `src/main.js`

**Responsabilità**: Inizializza Vue e i plugin.  
 

**Configura**:

*   Pinia per lo stato globale.
*   Vuetify per il design.
*   Router per la navigazione.  
    **Perché è importante**: Punto di ingresso dell'applicazione.

---

### **Flusso dei Dati**

1.  **Lettura**: Gli store (`notes.js`, `tags.js`) caricano i dati da IndexedDB al mount.
2.  **Visualizzazione**: Le view (`HomeView`, `TagManager`) accedono agli store e passano i dati ai componenti UI.
3.  **Modifica**: I componenti (es. `NoteEditor`) emettono eventi che gli store usano per aggiornare IndexedDB.
4.  **Reattività**: Pinia aggiorna automaticamente i componenti quando lo stato cambia.

---

### **Vantaggi dell'Architettura**

*   **Separazione dei compiti**: Ogni classe ha un ruolo ben definito.
*   **Riutilizzo**: Componenti come `TagChip` o `NoteEditor` sono usati in più contesti.
*   **Manutenibilità**: Modifiche al DB o allo stato richiedono interventi localizzati.
*   **Testabilità**: Gli store e i componenti possono essere testati in isolamento.
