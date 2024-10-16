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

    allApartment: [],

    allApartmentGlobal: []
})

const checkAdress = (adress) =>{
// trasform adress in array
let stringRequest = adress
// .split(" ")
// .map((world, index, arr) => {
//     if(arr.length - 1 !== index){
//         return world + "%20";
//     }else{
//         return world;
//     }

<<<<<<< HEAD
// })
// .join("").toUpperCase();
let urlRequest = `https://api.tomtom.com/search/2/geocode/${encodeURIComponent(stringRequest)}.json?key=qNjsW3gGJOBNhFoXhBzsGRJAk5RJMJhI`;

return urlRequest
//   array
}
export {store, checkAdress};
=======
export { store };
>>>>>>> 4082605bc74e3c3b4422edf3f505a905a7c20ed7
