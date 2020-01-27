<template>
	<div class="">
		<h4 class="display-4 text-center">Score: {{ user_quiz.perc }} %</h4>
		<small class="text-center d-block">You rank #{{ quiz_rank.rank }} Out of {{ quiz_rank.count }} Students</small>
		<hr />

		<div class="text-center mb-2">
		    <a :href="share_link" class="btn btn-info d-block d-md-inline mb-2 mb-md-0"
		    data-toggle="modal" data-target="#share-modal">
		        <i class="fas fa-share-alt"></i>
		        Share your score</a>
		    <a href="#" class="btn btn-primary d-block d-md-inline" @click="$emit('take-again', $event)">
		        <i class="fas fa-undo-alt"></i>
		        Take it again</a>
		</div>
		<!-- Modal -->
<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Share it with your friends</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        	<div class="d-inline mx-2 rounded-circle">
        		<a :href="'https://api.whatsapp.com/send?text='+ quiz_name + share_link" target="_blank">
        			<i class="fab fa-whatsapp fa-3x text-success"></i>
        		</a>
	        </div>
	         <div class="d-inline mx-2 rounded-circle">
	         	<a :href="'https://www.facebook.com/sharer/sharer.php?u=' + share_link"
	         		onclick="window.open(this.href); return false">
	        		<i class="fab fa-facebook fa-3x text-primary"></i>
				</a>
	        </div>
	        <div class="d-inline mx-2 rounded-circle">
	        	<a :href="'https://twitter.com/intent/tweet?url=' + share_link + '&text=' + quiz_name">
	        		<i class="fab fa-twitter fa-3x text-info"></i>
	        	</a>
	        </div> 
	        <!--div class="d-inline mx-2 rounded-circle">
	        	<a href="E">
	        		<i class="fab fa-reddit fa-3x" style="color: #e66c16"></i>
	        	</a>
	        </div-->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	</div>
</template>
<script>
	export default {
		props: [
			'user_quiz',
			'share_link',
			'quiz_name',
			'quiz_rank'
		],
		methods: {
			
		}
	}
</script>