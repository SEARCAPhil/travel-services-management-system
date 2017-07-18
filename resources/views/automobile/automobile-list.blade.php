{{csrf_field()}}
<p class="col col-md-8 col-sm-8 col-md-offset-1 text-right" style="margin-top: 2vh;">

	<a href="#" class="vehicle"><i class="material-icons md-36">add_box</i></a>

</p>


	
<article class="col col-md-9 col-sm-8 col-lg-8 col-lg-offset-1">
	<section class="col col-md-12  row automobile-list"></section>
</article>

<div class="backdrop">
		<div class="modalx">
			
		</div>
	</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript" src="js/automobile.js"></script>
<script type="text/javascript" src="js/validator.min.js"></script>	
<script type="text/javascript">
$(document).ready(function(){
	showAutomobileList();

	if(localStorage.getItem('priv')==='admin'){
		bindAddAutomobile()
	}

})
</script>

