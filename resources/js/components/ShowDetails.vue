<template>
    <div class="my-3">
        <a class="btn btn-light border-secondary mb-2" data-toggle="collapse" href="#collapseParent" role="button" aria-expanded="false" aria-controls="collapseParent" @click="toggleButton">Show Details
        <i class="fas" :class="getButtonClass"></i></a>

        <div class="collapse multi-collapse" id="collapseParent">
          <div class="card card-body" style="padding: 0">
            <div class="accordion" :id="'details-parent-' + index" v-for="(detail, index) in details">
          <div class="card">
                <div class="card-header" :id="'heading-details-' + index">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" :class="{ 'text-danger' : ! detail.isTrue, 'text-success': detail.isTrue }" type="button" data-toggle="collapse" 
                :data-target="'#detail-' + index" aria-expanded="true" :aria-controls="'detail-' + index">
                <span v-html="detail.question"></span>
                  <span class="float-right" v-if="detail.expired" >
                      <i class="fas fa-clock text-danger"></i>
                  </span>
                  <span class="float-right" v-else-if="! detail.isTrue">
                      <i  class="fas fa-times text-danger"></i>
                  </span>
                  <span class="float-right" v-else-if="detail.isTrue">
                      <i class="fas fa-check text-success"></i>
                  </span>
                </button>
              </h2>
            </div>

    <div :id="'detail-' + index" class="collapse" :class="{ 'show': index == 0 }" 
    :aria-labelledby="'heading-details-' + index" 
    :data-parent="'#details-parent-' + index">
      <div class="card-body">
            <div v-if="detail.expired">
                <p class="text-danger">The question was expired!
                    <span class="float-right">
                        <i class="far fa-clock text-danger"></i>
                    </span></p>
               <span class="text-dark"> Correct Answer: </span><br />
                <span class="text-info">{{ detail.correct }}</span>
            </div>
            <div class="" v-else-if="detail.isTrue">
                <p class="text-success">
                    <span class="text-dark">Correct Answer:</span><br />
                    {{ detail.correct }}
                    <span class="float-right">
                        <i class="fas fa-check text-success"></i>
                    </span>
                </p>
            </div>
            <div class="" v-else-if="! detail.isTrue">
                <p class="text-danger">
                    You Choosed: <br />
                    {{ detail.chosen }}
                    <span class="float-right">
                        <i class="fas fa-times text-danger"></i>
                    </span>
                </p>
                <p class="text-info">
                    Correct Answer: <br />
                    {{ detail.correct }}
                </p>
            </div>
      </div>
    </div>
    </div>
    </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'details'
        ],
        created() {
            
        },
        data () {
            return {
                button: {
                    clicked: false,

                }
            }
        },
        methods: {
            toggleButton() {
                if (this.button.clicked) {
                    this.button.clicked = false;
                    return;
                }
                this.button.clicked = true;
            }
        },
        computed: {
            getButtonClass() {
                return this.button.clicked ? 'fa-chevron-up': 'fa-chevron-down';
            }
        }
    }
</script>
<style scoped="">
    
</style>
