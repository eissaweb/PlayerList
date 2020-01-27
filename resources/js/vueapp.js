Vue.component('question', require('./components/Question.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);
Vue.component('show-details', require('./components/ShowDetails.vue').default);
Vue.component('show-result-info', require('./components/ShowResultInfo.vue').default);
const app = new Vue({
    el: '#app',
    data() {
    	return {
    		currentQuestion: 0,
    		started: false,
    		resultPage: false,
    		result: 0,
    		introPage: true,
    		questions: [],
    		history: [],
    		status: {
    			loading: false,
    			text: ''
    		},
    		details: [],
            user_quiz: {},
            share_link: '',
            quiz_name: '',
            quiz_rank: []
    	}
    },
    created() {
    	this.getQuestions();
    },
    methods: {
    	startQuiz() {
    		this.started = true;
    		this.introPage = false;
    	},
    	getQuestions() {
    		let baseUrl = axios.defaults.baseUrl + 'quiz/getQuiz/' + axios.defaults.params['quiz_id'] + '?api_token=' + axios.defaults.params['api_token'];
                axios.get(baseUrl)
                .then (res => {
                    this.questions = res.data;
                    //console.log(this.questions);
                }).catch (e => console.log('Error'))
    	},
    	handleAnswer(e) {
    		this.history.push(e);
    		if (this.currentQuestion + 1 === this.questions.length) {
    			this.handleResult();
    		} else {
    			this.currentQuestion++;
    		}
    		//console.log(this.history);
    	},
    	handleResult() {
    		let baseUrl = axios.defaults.baseUrl + 'quiz/handleResult/' + axios.defaults.params['quiz_id'] + '?api_token=' + axios.defaults.params['api_token'];
                axios.post(baseUrl, {
                	history: this.history
                })
                .then (res => {
                    this.result = res.data.result;
                    this.details = res.data.details;
                    this.user_quiz = res.data.user_quiz;
                    this.share_link = res.data.share_link;
                    this.quiz_name = res.data.quiz_name;
                    this.quiz_rank = res.data.quiz_rank;
                    //console.log(res.data);
                }).catch (e => console.log('Error'))
            this.status.loading = true;
    		this.started = false;
    		this.resultPage = true;
    		setTimeout(() => {
    			this.status.loading = false;
    		}, 1000)
    	},
    	takeAgain() {
    		//e.preventDefault();
    		this.resultPage = false;
    		this.started = true;
    		this.getQuestions();
    		this.currentQuestion = 0;
    		this.history = []
    	}
    }
});
