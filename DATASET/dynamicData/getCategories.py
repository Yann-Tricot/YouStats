import requests

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