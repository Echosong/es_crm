<form action="#" method="post" enctype="multipart/form-data" >
   <input type="file" id="lefile" name="pic[]" value="" style="display: none;" >
   <input type="hidden" value="111212" name="types" />
   <a class="btn" onclick="$('input[id=lefile]').click();">Browse</a>
</form>
<script type="text/javascript">
	$(function(){
	    $('input').change(function(){
	        $("form").submit();
	    })
	})
</script>