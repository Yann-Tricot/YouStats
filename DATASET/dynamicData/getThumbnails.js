const API_KEY = 'AIzaSyDn3jBs7OUSc0HaAzj23ee8fVdexO06kpg'
const VIDEO_ID = '13ihIPmtWcA'

const URL = `https://www.googleapis.com/youtube/v3/videos?part=snippet&id=${VIDEO_ID}&key=${API_KEY}`

const THUMBNAILS_ARRAY = []

async function getThumbnails(){
    const response = await fetch(URL)
    const data = await response.json()
    const VIDEO_DATA = data
    return VIDEO_DATA
}

//ASYNC FUNCTION CALL
getThumbnails().then((VIDEO_DATA) => {
    THUMBNAILS_ARRAY.push(VIDEO_DATA.items[0].snippet.thumbnails.high)
})