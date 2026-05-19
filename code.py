import csv
import pandas as pd
from sqlalchemy import create_engine

# Charger les datasets
df1 = pd.read_csv("cs_student_clean_with_job_id.csv")
df2 = pd.read_csv("dataset_with_job_id.csv")
df3 = pd.read_csv("mldata_with_job_id.csv")
# Harmoniser les colonnes
df1.columns = df1.columns.str.strip().str.lower()
df2.columns = df2.columns.str.strip().str.lower()
df3.columns = df3.columns.str.strip().str.lower().str.replace(" ", "_").str.replace("?", "")

# Fusionner les datasets
fusion_outer_1 = pd.merge(df1, df3, on='job_id', how='outer')
fusion_outer_2 = pd.merge(fusion_outer_1, df2, on='job_id', how='outer')

# Export CSV
fusion_outer_2.to_csv('fusion_outer.csv', index=False)

# Connexion MySQL
username = "root"
password = ""
host = "localhost"
database = "bd_stage"

engine = create_engine(f"mysql+pymysql://{username}:{password}@{host}/{database}")

# Export vers SQL
df1.to_sql(name="cs_students", con=engine, index=False, if_exists="replace")
df2.to_sql(name="dataset", con=engine, index=False, if_exists="replace")
df3.to_sql(name="mldata", con=engine, index=False, if_exists="replace")
print("✅ Datasets créés dans MySQL avec succès !")

