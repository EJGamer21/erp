<div id="vueapp" v-cloak>
    <div class="card my-2">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img :src="user.image" alt="broken image :(">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">
                        <span>{{ user.firstname + ' ' + user.lastname}}
                        <span class="badge badge-light">{{ user.rol }}</span
                    </h3>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const userId = <?= $userId ?>;
    const app = new Vue({
        el: '#vueapp',
        data() {
            return {
                user: {},
            }
        },
        mounted() {
            axios.get('/users/get/' + userId, {
                responseType: 'json'
            })
            .then((response) => {
                const user = response.data.response;
                this.user = user;
            })
            .catch((error) => {
                console.log(error);
            });
        },        
    });
</script>