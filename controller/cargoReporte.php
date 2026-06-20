<?php
include("../model/cargoClase.php");

$car = new Cargo("", "");
$resultado = $car->listarCargo();
if (isset($_GET['partial']) && $_GET['partial'] == '1') {
	echo $car->reportePdf();
	exit;
}

$reportHtml = $car->reportePdf();
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Reporte - Cargos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php echo $reportHtml; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', async () => {
			try {
				const opt = { margin:[0.5,0.4,0.5,0.4], filename: 'reporte_cargos.pdf', image:{type:'jpeg',quality:0.98}, html2canvas:{scale:2, useCORS:true}, jsPDF:{unit:'in', format:'letter', orientation:'landscape'} };
				const blob = await html2pdf().set(opt).from(document.getElementById('reporte-contenido')).output('blob');
				const url = URL.createObjectURL(blob);
				window.location.href = url;
				setTimeout(() => URL.revokeObjectURL(url), 3000);
			} catch (e) { console.error(e); }
		});
	</script>
</body>
</html>
<?php
