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

const componeUrlString = (objAdress) =>{


        let arrElement = []
        for (let key in objAdress.address) {
            arrElement.push(objAdress.address[key])
          }
        //   only data object
          arrElement = arrElement.slice(0, 5)
        //   at the 6 and 7 position we have cordinate
          arrElement.push(objAdress.position.lon)
          arrElement.push(objAdress.position.lat)
          arrElement.push(20)

        // lo ciclo per formare una stringa con dei trattini in mezzo
          let UrlString = arrElement.join(' ').split(' ').join('-')



        return UrlString


}

const updateUrl = (stringUrl, distance) =>{
    let arr = stringUrl.split('-').slice(0, -1)
    arr.push(distance)
    let newUrlString = arr.join('-')
    return newUrlString
}
const createPageWithUrl = (urlCripted, distance) =>{
    const stringUrl = urlCripted
    const arrUrl = urlCripted.split('-').slice(-3);
    console.log(arrUrl)
    findZone(arrUrl[0], arrUrl[1], distance)
    return updateUrl(stringUrl, distance)
}



export {store, checkAdress, findZone, filterApartment, componeUrlString, createPageWithUrl};
