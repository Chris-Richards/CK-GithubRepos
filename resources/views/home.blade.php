<!DOCTYPE html>
<html>
<head>
	<title>CK Repos</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/style.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<div class="container">

	<div class="search_bar">
		<input type="text" name="search_input" onChange="check_repo(this.value)" id="search_input" placeholder="Search Repos">
	</div>

	<div id="repos">
		@foreach($repos as $repo)
			<div class="card" id="{{ $repo['name'] }}">
				<div class="card-header">
					<span>{{ $repo['name'] }}</span>
					<span>{{ $repo['fork'] }}</span>

					<a href="{{ $repo['url'] }}">View Repo</a>
				</div>
				<div class="card-body">
					<p>{{ $repo['description'] }}</p>
				</div>
				<div class="card-footer">
					<span>{{ $repo['created_at'] }}</span>
					<span class="stargazers">{{ $repo['stargazers'] }}</span>
				</div>
			</div>
		@endforeach
	</div>

</div>
</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$("#search_input").autocomplete({
    source: {!! json_encode($repoNames) !!},
    close: function( event, ui ) {
    	var search = $("#search_input").val();
    	if(search == "") {

    	} else {
    		$('.card').each(function(i, obj) {
	    		if($(this).attr('id').toLowerCase().indexOf(search) >= 0) {
	    			$(this).attr('hidden', false);
	    		} else {
	    			$(this).attr('hidden', true);
	    		}
			});
    	}
    }
});

function check_repo(val) {
	console.log(val);
}

$('#search_input').keyup(
	function() {
		var search = $("#search_input").val();
    	$('.card').each(function(i, obj) {
    		if($(this).attr('id').toLowerCase().indexOf(search) >= 0) {
    			$(this).attr('hidden', false);
    		} else {
    			$(this).attr('hidden', true);
    		}
		});
	}
);
</script>
<script type="text/javascript" src="{{ asset('/app.js') }}"></script>
</html>











