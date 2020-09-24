import requests
import pymysql.cursors 
import csv
import sys

try:
    connection = pymysql.connect(host='localhost',
                                user='root',
                                password='',                             
                                db='youstats',
                                charset='utf8mb4'
                                )
    print("connect successful!!")

except ValueError:
    print("Echec de la connection au serveur !")

API_KEY = 'AIzaSyDn3jBs7OUSc0HaAzj23ee8fVdexO06kpg'
REGION_CODE = 'US'

URL = f"https://www.googleapis.com/youtube/v3/videoCategories?part=snippet&regionCode={REGION_CODE}&key={API_KEY}"

categoriesFetch = requests.get(URL).json().get("items");
categoriesList = []

for categorie in categoriesFetch:
    subCategorie = []
    subCategorie.append(categorie.get("id"))
    subCategorie.append(categorie.get("snippet").get("title"))
    categoriesList.append(subCategorie)

try:
    for categorie in categoriesList:
        categorieID = categorie[0]
        categorieTitle = categorie[1]
        sqlCategories = "INSERT into Category Values({categorieID},'{categorieTitle}')"
        cursor.execute(sqlCategories)
    
finally:
    connection.commit()
    # Closez la connexion (Close connection).      
    connection.close()