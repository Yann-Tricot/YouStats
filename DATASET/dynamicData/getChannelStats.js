const API_KEY = 'AIzaSyDn3jBs7OUSc0HaAzj23ee8fVdexO06kpg'
const CHANNEL_ID = 'UCcpxvJLWnMj5c70D984Bd-Q'

async function getChannelStats(){
    const response = await fetch(`https://www.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails%2Cstatistics&id=${CHANNEL_ID}&key=${API_KEY}`)
    const data = await response.json()
    console.log('DATA: ', data)
}

//ASYNC FUNCTION CALL
getChannelStats()
