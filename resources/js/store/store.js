import {reactive} from 'vue';


const store = reactive({
    // data of user
    user:{},
    userName: 'Accedi',
    // is logged user boolean
    is_logged: localStorage.getItem('is_logged'),
    have_apartment: false,

    // boolean for dropdown menu of header
    is_open: false,

    allApartment:[]
})


export {store};
