import sqlite3
class db :
    def __init__(self, db_file):
        self.db_file = db_file

    def connect(self):
        """Établit une connexion à la base de données SQLite."""
        try:
            self.conn = sqlite3.connect(self.db_file)
            print(f"Connexion à la base de données '{self.db_file}' établie.")
            return self.conn
        except sqlite3.Error as e:
            print(f"Une erreur SQLite est survenue : {e}")
            return None
        
    def close(self):
        """Ferme la connexion à la base de données SQLite."""
        if self.conn:
            self.conn.close()
            print(f"Connexion à la base de données '{self.db_file}' fermée.")
        else:
            print("Aucune connexion à fermer.")
            
    def execute_query(self, query, params=None):
        """Exécute une requête SQL sur la base de données."""
        if not self.conn:
            print("Aucune connexion à la base de données. Veuillez d'abord appeler connect().")
            return None
        try:
            cursor = self.conn.cursor()
            if params:
                cursor.execute(query, params)
            else:
                cursor.execute(query)
            self.conn.commit()
            print("Requête exécutée avec succès.")
            return cursor
        except sqlite3.Error as e:
            print(f"Une erreur SQLite est survenue lors de l'exécution de la requête : {e}")
            return None
        
    def fetch_all(self, cursor):
        """Récupère tous les résultats d'un curseur."""
        if cursor:
            try:
                results = cursor.fetchall()
                print(f"{len(results)} enregistrements récupérés.")
                return results
            except sqlite3.Error as e:
                print(f"Une erreur SQLite est survenue lors de la récupération des résultats : {e}")
                return None
        else:
            print("Aucun curseur fourni pour récupérer les résultats.")
            return None
        
    def fetch_one(self, cursor):
        """Récupère un seul résultat d'un curseur."""
        if cursor:
            try:
                result = cursor.fetchone()
                if result:
                    print("Un enregistrement récupéré.")
                else:
                    print("Aucun enregistrement trouvé.")
                return result
            except sqlite3.Error as e:
                print(f"Une erreur SQLite est survenue lors de la récupération du résultat : {e}")
                return None
        else:
            print("Aucun curseur fourni pour récupérer le résultat.")
            return None
    