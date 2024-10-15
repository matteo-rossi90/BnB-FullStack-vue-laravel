import {reactive} from 'vue';


const store = reactive({
    // data of user
    user:{},
    // is logged user boolean

    get is_logged() {
        // Controlla se l'oggetto user ha delle proprietà
        return Object.keys(this.user).length > 0;
    },
    // boolean for dropdown menu of header
    is_open: false,

    allApartment:[]
})


export {store};
