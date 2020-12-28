import requests
import pymysql.cursors 
import csv
import sys
import os

try:
    connection = pymysql.connect(host='db5001224558.hosting-data.io',
                                user='dbu1233491',
                                password='368h/xLLU?tN',                             
                                db='dbs1046878',
                                charset='utf8mb4'
                                )
    print("connect successful!!")

except ValueError:
    print("Echec de la connexion au serveur !")

API_KEY = 'AIzaSyDn3jBs7OUSc0HaAzj23ee8fVdexO06kpg'
REGION_CODE = 'US'

URL = f"https://www.googleapis.com/youtube/v3/videoCategories?part=snippet&regionCode={REGION_CODE}&key={API_KEY}"

# Sending a fetch request and extract "items",who contains wanted data, from json response
categoriesFetch = requests.get(URL).json().get("items");
# Initialize a list that will contain the wanted result
# categoriesList example : [ [ID_1, TITLE_1], [ID_2, TITLE_2], ..., [ID_N, TITLE_N] ]
categoriesList = []

# Foreach loop who browse one by one each element in categoriesFetch, extract wanted data (ID & TITLE)
# and put it in categoriesList
for categorie in categoriesFetch:
    subCategorie = []
    subCategorie.append(categorie.get("id"))
    subCategorie.append(categorie.get("snippet").get("title"))
    categoriesList.append(subCategorie)

# Insertion in our MySQL DB
try:
    with connection.cursor() as cursor:
        for categorie in categoriesList:
            categorieID = categorie[0]
            categorieTitle = categorie[1]
            sqlCategories = "INSERT into CATEGORY Values("+categorieID+",'"+categorieTitle+"')"
            cursor.execute(sqlCategories)
    
finally:
    connection.commit()
    # Closez la connexion (Close connection).      
    connection.close()