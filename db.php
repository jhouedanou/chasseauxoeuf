<?php
/**
 * Gestionnaire de base de données SQLite pour le jeu Chasse aux Oeufs
 * Remplace l'intégration Supabase par une solution locale
 */

class Database {
    private $db;
    private static $instance = null;

    // Constructeur privé (pattern Singleton)
    private function __construct() {
        $dbPath = __DIR__ . '/data/chasseauxoeuf.db';
        
        // Créer le répertoire data s'il n'existe pas
        if (!file_exists(__DIR__ . '/data')) {
            mkdir(__DIR__ . '/data', 0777, true);
        }
        
        // Connexion à la base SQLite
        $this->db = new SQLite3($dbPath);
        
        // Création de la table joueurs si elle n'existe pas
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS joueurs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL,
                email TEXT NOT NULL,
                date TEXT NOT NULL,
                ip TEXT,
                score INTEGER DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ');
        
        // Créer un index sur email et date pour les recherches
        $this->db->exec('
            CREATE INDEX IF NOT EXISTS idx_email_date ON joueurs(email, date)
        ');
    }
    
    // Méthode pour obtenir l'instance unique de la base de données
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Vérifie si un joueur existe déjà pour la date spécifiée
     */
    public function playerExists($email, $date) {
        $stmt = $this->db->prepare('
            SELECT COUNT(*) as count 
            FROM joueurs 
            WHERE email = :email AND date = :date
        ');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':date', $date, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        
        return $result['count'] > 0;
    }
    
    /**
     * Ajoute un nouveau joueur à la base de données
     */
    public function addPlayer($username, $email, $date, $ip) {
        $stmt = $this->db->prepare('
            INSERT INTO joueurs (username, email, date, ip)
            VALUES (:username, :email, :date, :ip)
        ');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':date', $date, SQLITE3_TEXT);
        $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
        
        return $stmt->execute();
    }
    
    /**
     * Met à jour le score d'un joueur
     */
    public function updateScore($email, $date, $score) {
        $stmt = $this->db->prepare('
            UPDATE joueurs 
            SET score = :score 
            WHERE email = :email AND date = :date
        ');
        $stmt->bindValue(':score', $score, SQLITE3_INTEGER);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':date', $date, SQLITE3_TEXT);
        
        return $stmt->execute();
    }
    
    /**
     * Récupère les meilleurs scores (optionnel pour une future fonctionnalité)
     */
    public function getTopScores($limit = 10) {
        $stmt = $this->db->prepare('
            SELECT username, score, date
            FROM joueurs
            ORDER BY score DESC
            LIMIT :limit
        ');
        $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
        
        $result = $stmt->execute();
        $scores = [];
        
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $scores[] = $row;
        }
        
        return $scores;
    }
}
?>
