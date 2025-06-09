import sqlite3

class Database:
    def __init__(self, db_path):
        """Initialise la connexion à la base de données SQLite."""
        self.db_path = db_path
        self.conn = None
        self.cursor = None

    def connect(self):
        """Établit la connexion à la base de données."""
        self.conn = sqlite3.connect(self.db_path)
        self.cursor = self.conn.cursor()

    def execute_query(self, query, params=None):
        """Exécute une requête (SELECT, INSERT, UPDATE, etc.)."""
        if self.conn is None:
            self.connect()
        try:
            if params:
                self.cursor.execute(query, params)
            else:
                self.cursor.execute(query)
            self.conn.commit()
            return self.cursor.fetchall()
        except sqlite3.Error as e:
            print(f"Erreur SQLite : {e}")
            return None

    def close(self):
        """Ferme la connexion proprement."""
        if self.cursor:
            self.cursor.close()
        if self.conn:
            self.conn.close()
            self.conn = None
            self.cursor = None
            
# # Création de l'objet gestionnaire
# db = db("ma_base.db")

# # Créer une table
# db.execute_query("""
#     CREATE TABLE IF NOT EXISTS utilisateurs (
#         id INTEGER PRIMARY KEY AUTOINCREMENT,
#         nom TEXT,
#         age INTEGER
#     )
# """)

# # Insérer des données
# db.execute_query("INSERT INTO utilisateurs (nom, age) VALUES (?, ?)", ("Alice", 30))
# db.execute_query("INSERT INTO utilisateurs (nom, age) VALUES (?, ?)", ("Bob", 25))

# # Lire des données
# resultats = db.execute_query("SELECT * FROM utilisateurs")
# for ligne in resultats:
#     print(ligne)

# # Fermer la connexion
# db.close()
