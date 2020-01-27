<template>
    <div>
        <div class="container">
            <div class="my-1 text-center">
                 <span>
                     {{ currentquestion + 1 }} / {{ questions.length }}
                 </span>
            <div class="w-25 bg-dark mx-auto" style="height: 1px;"></div>
            </div>

            <h5 class="question-text" v-html="(currentquestion + 1) + '. ' + question.question"></h5>
            <div class="" style="margin-bottom: 30px !important">
                <span class="float-right" :class="{ 'text-danger': getDuration <= 10 }"
            style="text-decoration: underline;">
                {{ getDuration }}
                <i class="fas fa-stopwatch text-secondary"></i>
            </span>
            </div>
            <div class="px-3 mt-2">
            <div v-for="(option, index) in question.choices">
                <div class="custom-control select-choice custom-radio my-2 py-1 px-2" v-if="index != 'id' && index != 'question'" :class="{ 'selected-choice': answer == index }">
                  <input type="radio" :id="index" :name="question.id" class="custom-control-input" :value="index" v-model="answer">
                  <label class="custom-control-label  d-block cursor-pointer" :for="index">{{ option }}</label>
                </div>
            </div>
            <div class="text-center">
                <button class="btn-success btn text-center mt-3" v-on:click="submitAnswer">     Submit
                <i class="fas fa-forward" v-if="currentquestion + 1 != questions.length"></i>
                <i class="fas fa-check-circle" v-else></i>
            </button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'question',
            'questions',
            'currentquestion'
        ],
        created() {
            //console.log(this.questions);
            this.countDownTimer()
        },
        data () {
            return {
                answer: '',
                time: 10,
                notSetTime: true,
                firstTime: true
            }
        },
        methods: {
            submitAnswer(e, expired = false) {
                if (! this.answer) {
                    alert('please select answer!');
                    return;
                }
                this.notSetTime = true;
                this.$emit('answer', {id: this.question.id, choice: this.answer, expired: expired});
                this.answer = '';
            },
            countDownTimer() {
                if (this.time > 0) {
                    this.time = this.time - 1;
                    setTimeout(this.countDownTimer, 1000);
                } else {
                    this.firstTime = false;
                     var currentExpireAnswer = this.question.id;
                    setTimeout(() => {
                        if (currentExpireAnswer == this.question.id) {
                            this.answer = 'three';
                            this.submitAnswer('', true);
                        }
                    }, 1000);
                }
            }
        },
        computed: {
            getDuration() {
                 if (this.notSetTime) {
                    if (this.question.type == 'seconds') {
                    var duration =  this.question.duration;
                    } else {
                         var duration = (this.question.duration * 60);
                    }
                    this.time = duration;
                    this.notSetTime = false;
                    if (! this.firstTime) {
                        this.countDownTimer();                        
                    }
                } 
                return this.time;
            }
        }
    }
</script>
<style>
    .question-text {
        font-weight: 300;
    }
    .selected-choice {
        background: #26a;
        color: white;
        border-radius: 5px;
    }
    .select-choice {
        
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .select-choice.selected-choice:hover {
        background: #26a !important
    }
    .select-choice:hover {
        background: #f5f5f560;
    }
</style>
