<?php
include("../model/productoClase.php");

$prod = new Producto("", 0, "", "", "Activo", 0, 0, "", "");
$resultado = $prod->listarProducto();
// If requested as a partial, return only the inner HTML (useful for AJAX)
if (isset($_GET['partial']) && $_GET['partial'] == '1') {
	// Use the model helper to generate the HTML fragment
	echo $prod->reportePdf();
	exit;
}

// Otherwise render a full page with basic head + the report HTML
$reportHtml = $prod->reportePdf();
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Reporte - Productos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
	<style>
		body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f8fafc; }
		.pagina { max-width: 1100px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
		table { width: 100%; border-collapse: collapse; }
		th, td { padding: .6rem; border: 1px solid #e6eef6; text-align: left; }
		thead th { background: #f1f5f9; font-weight: 600; }
		.producto-img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }
	</style>
</head>
<body>
	<?php echo $reportHtml; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
	<script>
		// Auto-generate PDF when visiting this page and open in the same tab
		window.addEventListener('DOMContentLoaded', async () => {
			try {
				const opt = { margin:[0.5,0.4,0.5,0.4], filename: 'reporte_productos.pdf', image:{type:'jpeg',quality:0.98}, html2canvas:{scale:2, useCORS:true}, jsPDF:{unit:'in', format:'letter', orientation:'landscape'} };
				const blob = await html2pdf().set(opt).from(document.getElementById('reporte-contenido')).output('blob');
				const url = URL.createObjectURL(blob);
				// Navigate current tab to the blob URL so browser displays the PDF inline
				window.location.href = url;
				// Revoke after some time
				setTimeout(() => URL.revokeObjectURL(url), 30000);
			} catch (e) { console.error(e); }
		});
	</script>
</body>
</html>

<?php
