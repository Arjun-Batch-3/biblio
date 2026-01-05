<?php
include("includes/header.php");
include("../includes/connection.php");
include("functions/process_index.php");
?>
<script>
	window.onload = function () {
		// CanvasJS.addColorSet("neonShades",
		//         [//colorSet Array

		//         "#39FF14 ",
		//         "#00BFFF",
		//         "#7859c4",
		//         "#2323ff",
		//         "#f20bf8",
		//         "#8c13d0",
		//         "#cc353c"                
		//         ]);

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light2",
			backgroundColor: "#ffffff00",
			colorSet: "neonShades",
			title: {
				text: "Bibliophile's Corner"
			},
			axisX: {
				labelFontColor: "#000000"
			},
			axisY: {
				labelFontColor: "#000000"
			},
			data: [{
				type: "column",
				// yValueFormatString: "#,##0\"\"",
				// indexLabel: "{y}",
				indexLabelPlacement: "inside",
				indexLabelFontColor: "white",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
	}
</script>


<div class="container min-vh-100 mt-5">
	<div class="px-md-4">
		<div class="mx-auto" id="chartContainer" style="height: 500px; width: 75%;"></div>
	</div>
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
	integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
	integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>

<!-- index grp btn prblm -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php
include("includes/footer.php");
?>