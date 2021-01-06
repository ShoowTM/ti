<?php

echo empty($_GET['query']) ? "Query: OFF <br>" : $_GET['query'];

echo empty($_GET['id_fun']) ? "ID_FUN: OFF" : $_GET['id_fun'];


/*CORPO DO PDF*/
$html = "
<html>
	<head>
		<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
		<style type='text/css'>
		p.termo_titulo{
			 font-size: 10px; 
			 font-weight: bold;
		}
		p.texto{
			font-size:12px;
		}
		.titulo_segundario{
			font-weight: bold;
			font-size: 12px;
			text-decaration: sublime
		}
		table{
			font-size: 8px;
		}
		
		th{
			font-weight: bold;
		}
		</style>
	</head>
	<body>
		<header>
			<img id='logo' src='../img/logo.png' width='150' alt='Logo'>
		</header>
		<div id='termo_header'>
			<p class='text-center'>&ldquo;TERMO DE ENTREGA E DECLARAÇÃO&rdquo;</p>
		</div>
		<div id='termo_body'>
			<div id='termo_equipamento'>
				<p class='text-center termo_titulo'>EQUIPAMENTOS CORPORATIVOS</p>
			</div>
			<div id='text_departamento'>
				<span id='empresa_departamento'>
					<p class='texto'>Na condição de empregado(a) da filial <span class='titulo_segundario'>" . $row_fun['empresa'] . " - " . $row_fun['departamento'] . " / " . $row_fun['funcao'] . "</span>, estou recebendo neste ato equipamento conforme abaixo:
				</span>
			</div>
			<div id='tabela_equipamento'>
				<div id='tabela_titulo_principal'>
					<p class='titulo_segundario'><u>Descrição dos Produtos:</u></p>
				</div>
				<div id='termo_tabela'>
				<!--SE FOR CHIP, MOSTRAR APENAS CHIP E OPERADORA-->
					<table class='table table-sm'>
					  <tr>
					  	<th>EQUIP.</th>
						<th>MODELO</th>
						<th>PATRIMÔNIO</th>
					    <th>IMEI</th> 
					    <th>VALOR</th>
					    <th>NÚMERO</th>
					    <th>PLANOS</th>
					    <th>ACESSÓRIOS</th>
						<th>SITUAÇÃO</th>
						<th>ESTADO</th>		    
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
					</table>
				</div>
			</div>
			<div id='termo_texto'>
				<p class='text-sm-left texto'>Comprometendo-me a devolvê-lo, em perfeito estado de conservação, mediante simples solicitação da empresa ou no caso de rescisão contratual, independente do motivo. Declaro que a utilização do referido equipamento <span class='font-weight-bold'><u> será exclusivamente em minha atividade profissional</u></span>,(não esta autorizado fotos particulares, telefones particulares, redes sociais, facebook, instagram, tinder, badoo, happn) estou ciente, da minha responsabilidade por danificar culposamente(pelo extravio, queda, danos por contato com umidade, extravio de componentes(carregador), estando isento de responsabilidade por danos advindos de desgates natural por uso cotidiano). Ciente que em caso de mau funcionamento (bateria não carrega) ou defeito do aparelho devo notificar no prazo máximo de 3 dias, após a retirada.</p>
				<p class='text-sm-left texto'>Caso haja necessidade de portar, levar para casa este eletrônico, que devo notificar qualquer estrago ou avaria imediatamente a para área de T.I, que caso se faça necessários consertos, estes deverão preferencialmente ser realizados via T.I, só em caso de impossibilidade incompatibilidade (devido a distância) o conserto será feito de forma particular.

					Para os fins do par. 1º do Art. 462 da CLT, desde já autorizo o desconto salarial à conta de eventuais danos
					causados ao equipamento,(descritos acima) reembolsando a minha empregadora pelos reparos necessários ou até mesmo a substituição de um novo aparelho. Lembrando que o valor para ressarcimento será o vigente da data da ocorrência.<p>
			</div>
			<div id='tabela_titulo_principal'>
				<p class='titulo_segundario'><u>Observações:</u></p>
			</div>
			<div id='termo_texto'>";
if ($row_fun['obs'] != NULL) {

    $html .= "<p class='text-sm-left texto'>&raquo; " . $row_fun['obs'] . "</p>";
} else {
    $html .= "<br /><br />";
}

$html .=   "</div>
			<br>
			<div id='termo_data'>
				<p class='text-center'>____________, ____ de _____________ de ________</p>
			</div>
			<div id='termo_footer'>
				<p class='font-weight-light'>Colaborador(A): " . $row_fun['nome'] . "</p>
				<p class='font-weight-light'>CPF: " . $row_fun['cpf'] . "</p>
				<p class='font-weight-light'>Assinatura:_______________________________________________________________ </p>
			</div>
		</div>
	</body>
</html>";

require_once '../dompdf/autoload.inc.php';
require_once '../dompdf/lib/html5lib/Parser.php';
require_once '../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once '../dompdf/lib/php-svg-lib/src/autoload.php';
require_once '../dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
if ($_GET['pagina'] == 1) {
    $dompdf->stream('termo_' . $row_fun['nome'] . '.pdf', array("Attachment" => 0)); //1 - Download 0 - Previa
} else {
    $dompdf->stream('termo_' . $row_fun['nome'] . '.pdf', array("Attachment" => 1)); //1 - Download 0 - Previa
}

$conn->close();
?>

?>