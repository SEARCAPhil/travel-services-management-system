{{csrf_field()}}
<p class="col-lg-10 text-right" style="margin-top: 1vh;margin-bottom: 10px;box-shadow: 0px 10px 25px rgba(200,200,200,0.2);padding-bottom:15px;padding-left: 50px;border-bottom:1px solid rgba(200,200,200,0.5);">

	<a href="#" class="vehicle">Add new <i class="material-icons">add_circle</i></a>

</p>


	
<article class="col col-md-9 col-sm-8 col-lg-8 col-lg-offset-1" style="height: 100vh; overflow-y: auto;">
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
		if(localStorage.getItem('role') === 'admin'){ bindAddAutomobile() }
	})
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-99081752-6"></script>


