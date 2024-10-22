import { reactive } from 'vue';


const store = reactive({
    // data of user
    user: {},
    userName: 'Accedi',
    // is logged user boolean
    is_logged: false,
    have_apartment: false,

    // boolean for dropdown menu of header
    is_open: false,
    // all apartment visible
    allApartments: [],
    // apartment of singol user
    userApartment: [],

    center: [],
    // filtred apartment near of the center of map
    filtredApartment: [],

    minLat: '',
    maxLat: '',
    minLong: '',
    maxLong: '',

    inputValue: '',
    room:'',
    bed:'',
    square:'',
    distance:'',
    lon:'',
    lat:'',
    distance: ''

})

const checkAdress = (adress) =>{
// trasform adress in array
let stringRequest = adress.split(" ").join('%20')

let urlRequest = `https://api.tomtom.com/search/2/geocode/${encodeURIComponent(stringRequest)}%20IT.json?storeResult=false&topLeft=47.25145%2C%202.35341&btmRight=36.08512%2C%20-6.29537&language=it-IT&extendedPostalCodesFor=str&view=Unified&key=qNjsW3gGJOBNhFoXhBzsGRJAk5RJMJhI`;

return urlRequest
//   array
}

// find a square point zone in the center of map
const findZone = (lon, lat, distance = 20) =>{

    let totalGradius = distance * 0.00899

     // Limiti dell'area rettangolare
     store.minLat = Number(lat) - totalGradius;
     store.maxLat = Number(lat) + totalGradius;
     store.minLong = Number(lon) - totalGradius;
     store.maxLong = Number(lon) + totalGradius;

     filterApartment(store.allApartments)
}

const filterApartment = (apartments) => {


    if(apartments.length){
        // apartment filtred near the center of map
        store.filtredApartment = apartments.filter(apartment =>{

            return apartment.lon >= store.minLong && apartment.lon <= store.maxLong && apartment.lat >= store.minLat &&  apartment.lat <= store.maxLat

        })
    }




}

const componeUrlString = (objAdress, inputUser) =>{


    let obj ={
        'input': inputUser,
        'lon': objAdress.position.lon,
        'lat': objAdress.position.lat,
        'room': 0,
        'bed': 0,
        'square': 0,
        'distance': 20
    }
    let stringUrl = "";
    let string = '';
    obj['input'] = obj['input'].split(' ').join('%')
    for(let key in obj){
        string = `${key}=${obj[key]}&`
        stringUrl += string
    }
        return stringUrl
}

const createDataUrl = (stringUrl) =>{
    console.log('stringa url', stringUrl)
    let arr = stringUrl.split('&')
    let objData = {}
    for (let i = 0; i < arr.length; i++) {
        if (arr[i]) {  // Controlla che la stringa non sia vuota
            let arrAll = arr[i].split('=');
            if (arrAll.length === 2) {
                objData[arrAll[0]] = arrAll[1];
            }
        }
    }

    objData['input'] = objData['input'].split('%').join(' ')
    return objData

};
const createPage = (objData) => {
    // object arive
    // let obj ={
    // 'input': ,
    // 'lon': ,
    // 'lat': ,
    // 'room': ,
    // 'bed': ,
    // 'square': ,
    // 'distance':
    store.inputValue = objData["input"];
    store.center = [objData["lon"], objData["lat"]];
    store.room = objData["room"];
    store.bed = objData["bed"];
    store.square = objData["square"];
    store.distance = objData["distance"];
    store.lon = objData['lon'],
    store.lat = objData['lat'],
    store.distance = objData['distance']
    findZone(objData["lon"], objData["lat"], objData["distance"]);
  }
const updateUrl = (oldUrl) =>{
    let newData = {
        'bed': store.bed ? store.bed : 0,
        'distance': store.distance ? store.distance : 0,
        'input': store.inputValue ? store.inputValue : '',
        'lon': store.lon,
        'lat': store.lat,
        'room': store.room ? store.room : 0,
        'square': store.square ? store.square : 0
    }
    let objUpdate = createDataUrl(oldUrl)
    for (const key in newData) {
        // update data
        objUpdate[key] = newData[key]
    }
    // change data in url string
    let stringUrl = "";
    let string = '';
    objUpdate['input'] = objUpdate['input'].split(' ').join('%')
    for(let key in objUpdate){
        string = `${key}=${objUpdate[key]}&`
        stringUrl += string
    }

    // let objData = createDataUrl(stringUrl)
    // createPage(objData);

    return {stringUrl, objUpdate}
}

const filterUserApartment = (filtredApartment, objData) =>{


        store.filtredApartment = filtredApartment.filter(apartment =>{
            return apartment.number_rooms >= objData['room'] || apartment.number_beds >= objData['bed'] || apartment.square_meters >= objData['square']
        })


}

// const createPageWithUrl = (urlCripted, distance) =>{
//     const stringUrl = urlCripted
//     const arrUrl = urlCripted.split('-').slice(-3);

//     findZone(arrUrl[0], arrUrl[1], distance)
//     return updateUrl(stringUrl, distance)
// }



export {store, checkAdress, findZone, filterApartment, componeUrlString, createDataUrl, updateUrl, createPage, filterUserApartment};
