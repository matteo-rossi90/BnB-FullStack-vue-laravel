<script>
export default {
  name: "IndexApartment",
  data() {
    return {
      name: "",
      apartments:[]
    };
  },
  methods: {},
  mounted() {
    axios
    .get("/api/user")
    .then((res) => {
        // console.log(res);
        this.name = res.data.name;
    })
    .catch((err) => {
        console.log(err);
    });

    axios.get("api/user/utente/dashboard")
    .then((response) =>{
        console.log(response);
        this.apartments = response.data;
    })
    .catch((err) => {
        console.log(err);
    });

  },
};
</script>
<template>
    <div class="wrapper d-flex">
        <aside>
            <ul>
                <li>I miei appartamenti</li>
            </ul>
        </aside>
        <div id="dashboard-box">
            <div class="container my-3">
                <h2>I miei appartamenti</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Message</th>
                        <th scope="col">Luogo</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="apartment in apartments" :key="apartment.id">
                        <td scope="row">
                            {{ apartment.id }}
                        </td>
                        <td scope="row">
                            {{ apartment.title }}
                        </td>
                        <td scope="row">
                                -
                        </td>
                        <td scope="row">
                            {{ apartment.address }}
                        </td>
                        <td scoper="row" class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-warning">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
            </div>

        </div>

    </div>
</template>
<style lang='scss' scoped>

.wrapper{
    height: calc(100vh - 48px);
    width: 100%;
    overflow:hidden
}

aside{
    width: 200px;
    height: 100%;
    background-color: rgb(219, 219, 219);
}

#dashboard-box{
    width: 100%;
}

// @use 'path' as *;
</style>
