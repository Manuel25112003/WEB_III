<?php
include("../model/empleadoClase.php");

$emp = new Empleado("", 0, "", "", "", "", "", "", "", "", "");
$resultado = $emp->listarEmpleado();
if (isset($_GET['partial']) && $_GET['partial'] == '1') {
	echo $emp->reportePdf();
	exit;
}

$reportHtml = $emp->reportePdf();
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Reporte - Empleados</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php echo $reportHtml; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', async () => {
			try {
				const opt = { margin:[0.5,0.4,0.5,0.4], filename: 'reporte_empleados.pdf', image:{type:'jpeg',quality:0.98}, html2canvas:{scale:2, useCORS:true}, jsPDF:{unit:'in', format:'letter', orientation:'landscape'} };
				const blob = await html2pdf().set(opt).from(document.getElementById('reporte-contenido')).output('blob');
				const url = URL.createObjectURL(blob);
				window.location.href = url;
				setTimeout(() => URL.revokeObjectURL(url), 30000);
			} catch (e) { console.error(e); }
		});
	</script>
</body>
</html>
<?php
