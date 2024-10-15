import {reactive} from 'vue';


const store = reactive({
    // is logged user boolean
    is_logged: false,
    // boolean for dropdown menu of header
    is_open: false,
    // data of user
    user:{},
})


export {store};
