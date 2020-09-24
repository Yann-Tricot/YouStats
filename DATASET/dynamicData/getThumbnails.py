import requests

API_KEY = 'AIzaSyDn3jBs7OUSc0HaAzj23ee8fVdexO06kpg'
VIDEO_ID = '13ihIPmtWcA'

URL = f"https://www.googleapis.com/youtube/v3/videos?part=snippet&id={VIDEO_ID}&key={API_KEY}"

response = requests.get(URL).json();

thumbnailHd = response.get("items")[0].get("snippet").get("thumbnails").get("standard").get("url")