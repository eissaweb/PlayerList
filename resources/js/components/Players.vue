<template>
    <div class="">
        <h3 class="display-4 text-center">Football Players</h3>
        <hr />
        <div class="alert alert-info" v-if="status">{{ msg }}</div>
        <div class="row justify-content-between">
            <div class="col-md-6">
                <!-- Adding a new Player -->
                <h4 class="">Add new Player</h4>
                <div class="alert alert-warning" v-if="editState">Editing current Player</div>
                <form @submit.prevent="addPlayer">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Player Name" 
                        v-model="player.name" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Age" v-model="player.age" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Save it</button>
                </form>
                <!-- End Adding new player -->
            </div>
            <div class="w-100"></div>
            <hr />
            <div class="col-md-12">
            <!-- Search Box -->
            <div class="row justify-content-between">
                <div class="col-md-4 mb-2">
                    <form @submit.prevent="fetchPlayers(q)">
                        <!-- with adding form submit event we can easily change the search way from / to live or after submitting -->
                            <input type="text" class="form-control w-75 d-inline"  placeholder="Search for a Player by name or age"
                            @input="fetchPlayers(q)" v-model="q">
                            <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                            </button>
                    </form>
                </div>
                <!-- End Search Box -->
                <!-- Data(Players) -->
                <div class="col-md-8">
                    <table class="table">
                        <thead class="thead-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="player in players" :key="player.id">
                                <td>#{{ player.id }}</td>
                                <td>{{ player.name }}</td>
                                <td>{{ player.age }}</td>
                                <td>
                                    <button @click="editPlayer(player)" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button @click="deletePlayer(player.id)" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                     <!-- Table info -->
                    <div v-if="players.length == 0" class="alert alert-info">
                        {{ q ? `No Player with the name or age of  "${q}"`: fetched ? 'No Data': 'Fetching Data...' }}
                    </div>     
                    <!-- End table info  -->
                </div>
                <!-- End data -->
            </div>
        </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        data () {
            return {
                players: [],
                player: {
                    name: '',
                    age: ''
                },
                player_id: null,
                editState: false,
                status: false,
                msg: '',
                q: '',
                fetched: false
            }
        },
       created() {
            // if the application runs successfully then run fetchPlayers method
            this.fetchPlayers();
       },
       methods: {
        fetchPlayers(q = '') {
            // also used for the search functionality if the q(query) is not empty
            // make a get request using axios
            axios('api/players/' + q)
            .then(res => {
                this.players = res.data.data;
                this.fetched = true;
            }).catch (e => console.log(e))
        },
        deletePlayer(player_id) {
            if (confirm('are you sure want to delete this player ?')) {
                axios.delete('api/player/' + player_id)
                .then(res => {
                    this.putMessage('Player has been deleted.');
                    this.fetchPlayers();
                }).catch (e => console.log(e));
            }
        },
        addPlayer() {
            // check if its a new Player or editing current one
            if (! this.editState) {
                // create new player
                axios.post('api/player', this.player)
                .then (res => {
                    console.log(res.data);
                    this.putMessage('New player added.');
                    this.fetchPlayers();
                }).catch (e => console.log('eror'));
                return;
            } 

            // update current one
            axios.put('api/player', {
                name: this.player.name,
                age: this.player.age,
                player_id: this.player_id
            })
            .then (res => {
                // reset the edit state
                this.editState = false;
                this.player_id = ''
                this.putMessage('Player has been updated.');
                this.fetchPlayers()
            }).catch(e => alert('Error while updating: ' + e));

        },
        editPlayer(player) {
            // prepare for editing player
            this.editState = true;
            this.player_id = player.id;
            this.player.name = player.name;
            this.player.age = player.age;
        },
        putMessage(msg) {
            // set messages for 2 seconds and will be gone.
            this.status = true;
            this.msg = msg;

            setTimeout(() => {
                this.status = false
            }, 2000)
        }
       }
    }
</script>
