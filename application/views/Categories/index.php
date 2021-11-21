<h2><?php echo $title; ?></h2>

<div>
	<select onfocus="getPreviousSelection(this.value)" onchange="showSubCategories(this.value)">
		<option value="">Select a category:</option>
	
<?php foreach ($categories as $category): ?>

		<option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>

<?php endforeach; ?>

	</select>
</div>

<script>
var selection = ""

function getPreviousSelection(id){
	selection = id
}

function showSubCategories(id) {
	// Remove previous sublist
	$('#sublist-'+selection).remove();
	
	$.ajax({
		url: "categories/view/"+id,
		dataType: "json",
		success: function(categories){
			
			// Build the next block
		  	var elemDiv = document.createElement('div');
			elemDiv.id = 'sublist-'+id;
			elemDiv.appendChild(document.createElement('br'));
			
			// If no subcategories, show label clarifying that
			if (categories.length === 0){
				// except if category is not selected
				if (id != ""){
					elemDiv.innerHTML = '<h4>This is the end of the hierarchy.</h4>';
					$('select:last').after(elemDiv);
				}
				return;
			}
			
			// Build next dropdown menu
			var elemSelect = document.createElement('select');
			elemSelect.addEventListener(
				'focus',
				function() { getPreviousSelection(this.value); },
				false,
			);
			elemSelect.addEventListener(
				'change',
				function() { showSubCategories(this.value); },
				false,
			);
			elemDiv.appendChild(elemSelect);
			
			// Populate the options
			var elemOption = document.createElement('option');
			elemOption.value="";
			elemOption.innerHTML = "Select a category:";
			elemSelect.appendChild(elemOption);
			
		    $.each(categories, function(idx, category){
				elemOption = document.createElement('option');
		    	elemOption.value = category.id;
		    	elemOption.innerHTML = category.name;
				elemSelect.appendChild(elemOption);
		    });
			
			// Append the sublist
			$('select:last').after(elemDiv);
	  }
   });
   $('select').blur();
}
</script>