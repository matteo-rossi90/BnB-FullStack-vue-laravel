<script>

export default {
  name: "CreateApartment",
  data() {
    return {
         apartment:{
             title:""
         },
        errors: {},
    };
  },
  methods: {

    // submit() {
    //   axios
    //     .post("api/user/utente/dashboard", this.apartment)
    //     .then(() => {
    //       this.$router.push({ name: "dashboard" });
    //     })
    //     .catch((err) => {
    //       this.errors = err.response.data.errors;
    //     });
  //}
},
}

</script>
<template>
  <div class="container-fluid p-5 d-flex justify-content-center gap-2">
    <div class="row">
        <div class="col-12">
            <h1>Inserisci un appartamento</h1>
        </div>
        <div class="col-12 col-sm-6">

            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">diventa Host di BolBnB</button>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                    </div>
                </div>
                </div>
        </div>
        <div class="col-12 col-sm-6">
            <img class="img-fluid" src="../../../../public/img/bed_and_breakfast_image.jpg" alt="imgBnB">
        </div>
    </div>

  </div>

</template>
<style lang='scss' scoped>
img{
    max-height: 500px;
}
</style>
