const API_KEY = 'AIzaSyDn3jBs7OUSc0HaAzj23ee8fVdexO06kpg'
const REGION_CODE = 'US'

const URL = `https://www.googleapis.com/youtube/v3/videoCategories?part=snippet&regionCode=${REGION_CODE}&key=${API_KEY}`

const CATEGORIES_ARRAY = []

async function getCategories(){
    const response = await fetch(URL)
    const data = await response.json()
    const CATEGORIES_DATA = data
    return CATEGORIES_DATA
}

//ASYNC FUNCTION CALL
getCategories().then((CATEGORIES_DATA) => {
    CATEGORIES_ARRAY.push(CATEGORIES_DATA.items)
})

// yes