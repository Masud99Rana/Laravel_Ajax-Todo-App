<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Todo List Project</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" class="css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>
<body>
	
	<div class="container">
		<div class="row">
			
			<div class="col-lg-offset-3 col-lg-6">
				<br>
				<div class="panel panel-default" >
					<div class="panel-heading">
					  	<h3>Ajax Todo List <a href="" class="pull-right" id="addNew" data-toggle="modal" data-target="#myModal"><i class=" fa fa-plus" arial-hidden="true"></i></a></h3>
					</div>
					  	<div class="panel-body" id="items">
						    <ul class="list-group" id="keree">
							
						    	@foreach($items as $item)
						    		<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{$item->item }}<input type="hidden" id="itemId" value="{{$item->id}}"></li>
						    		
						    	@endforeach
						    	
						    </ul>
					  	</div>
					</div>					
			</div>


			<div class="col-lg-2">
				<br>
				<!-- auto complete -->
				<input type="text" class="form-control" name="item" id="searchItem" placeholder="Search">
			</div>



			<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="title">Add New Item..</h4>
			      </div>
			      <div class="modal-body">
			        <input type="text" name="" placeholder="Write itme here" class="form-control" id="addItem">
			        <input type="hidden" id="id">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" id="delete" data-dismiss="modal" style="display: none;">Delete</button>
			        <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal"  style="display: none;">Save changes</button>
			        <button type="button" class="btn btn-primary" data-dismiss="modal" id="AddButton">Add Item</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->


		</div>
	</div>
	

{{ csrf_field() }}






	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


	<script>

		$(document).ready(function(){
			$(document).on('click', '.ourItem', function(event){

				var text = $(this).text();
				var id = $(this).find('#itemId').val();

				$('#title').text('Edit Item');
				$('#addItem').val(text);
				$('#delete').show('400');
				$('#saveChanges').show('400');
				$('#AddButton').hide('400');
				$('#id').val(id);
				console.log(text);
			});


			$(document).on('click', '#addNew', function(event){

				var text = $(this).text();
				$('#title').text('Add New Item');
				$('#addItem').val("");
				$('#delete').hide('400');
				$('#saveChanges').hide('400');
				$('#AddButton').show('400');
				console.log(text);
			});

			//add 
			$('#AddButton').click(function(event){
				var text = $('#addItem').val();

				if (text == "") {
					alert('Faizalamie Nakie??');
				}else{
					$.post('list', {'text': text, '_token':$('input[name=_token]').val()}, function(data){
						$('#items').load(location.href + ' #items')
					});
				}

				
			});

			// delete
			$('#delete').click(function(event){
				var id = $('#id').val();
				$.post('delete', {'id': id, '_token':$('input[name=_token]').val()}, function(data){
					$('#items').load(location.href + ' #items')
					//console.log(data);
				});
			});

			// update
			$('#saveChanges').click(function(event){
				var id = $('#id').val();
				var value = $('#addItem').val();
				$.post('update', {'id': id,'value':value, '_token':$('input[name=_token]').val()}, function(data){
					$('#keree').load(location.href + ' #keree')
					//console.log(data);
				});
			});



			//auto complete
			//https://jqueryui.com/autocomplete/

			$( function() {
			  var availableTags = [
			    
			  ];
			  $( "#searchItem" ).autocomplete({
			    source: 'http://laravel57.mr/search'
			    // source:'{{ asset('search') }}'
			  });
			} );

		});
	</script>
</body>
</html>