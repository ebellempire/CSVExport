<!-- This is an efficient, but unorthodox way to create a plugin view... time was of the essence :) -->
<style>
#data-table{
	max-width: 100%;
	overflow-x: scroll;
}
#data-table tr{
	font-size: 10px;
}
#data-table tr:nth-child(1) > th:nth-child(5){
	padding-right: 200px;
}
/* hide the "save" button since we're not saving anything here... */
#content form section.alpha{
	width: 100% !important;
}
#content form section.omega{
	display: none;
}
</style>
<h3>Usage Instructions</h3>
<p>Use the button below to open the table data in a new window. In the new window, <strong>select all</strong> data (Control + A on PC or &#8984; + A on Mac) and <strong>copy</strong> it to your clipboard (Control + C on PC or &#8984; + C on Mac), then <strong>paste</strong> the text (Control + V on PC or &#8984; + V on Mac) into a spreadsheet program such as Excel. Save the file to the CSV format.</p>
<a class="button" href="/items?output=export-csv" target="_blank">View Data in New Window</a><br><br>

<div id="data-table"></div>
<script>
	jQuery("#data-table").load("/items?output=export-csv", function(){
		jQuery('#data-table').prepend('<h2>Data Preview:</h2>');
		if ( status == "error" ){
			console.log('Data preview FAILED...');
		}else{
			console.log('Data preview loaded...');
		}
		
	}); 
</script>