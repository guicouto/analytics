<?php

	// Para referências de dimensões e métricas que podem 
	// ser utilziadas consulta na documentação do  do Google
	// em https://developers.google.com/analytics/devguides/reporting/core/dimsmets#cats=user,session
	// consulte também o blog para http://www.tiagomatos.com/blog/pegando-dados-do-google-analytics-com-php-atraves-da-classe-gapi
	
	require_once("gapi/gapi.class.php");
	$ga = new gapi('sua_conta_google', 'sua_senha_conta_google');
	
	$id = "seu_id_google";
	
	// Define o periodo do relatório
	$inicio = date('Y-m-01', strtotime('-12 month')); // 1° dia do mês passado
	$fim = date('Y-m-t', strtotime('-1 month')); // Último dia do mês passado

	// Busca os pageviews e visitas (total do mês passado)
	$ga->requestReportData($id, 'year', array('pageviews', 'visits'), null, null, '2013-01-01', '2014-12-01');
	foreach ($ga->getResults() as $dados) {
		echo 'Ano: ' . $dados . ': ' . $dados->getVisits() . ' Visita(s) e ' . $dados->getPageviews() . ' Pageview(s)<br />';
	}
	echo '<br />';
	
	// Busca os pageviews e visitas (total do mês passado)
	$ga->requestReportData($id, 'month', array('pageviews', 'visits'), null, null, $inicio, $fim);
	foreach ($ga->getResults() as $dados) {
		echo 'Mês ' . $dados . ': ' . $dados->getVisits() . ' Visita(s) e ' . $dados->getPageviews() . ' Pageview(s)<br />';
	}
	
	echo '<br />';
	
	// Busca os sessões (total do mês passado)
	$ga->requestReportData($id, 'month', array('sessions'), null, null, $inicio, $fim);
	foreach ($ga->getResults() as $dados) {
		echo 'Mês ' . $dados . ': Sessão:' . $dados->getSessions() . '<br />';
	}

	echo '<br />';
	
	// Busca os novos usuários (total do mês passado)
	$ga->requestReportData($id, 'month', array('newUsers'), null, null, $inicio, $fim);
	foreach ($ga->getResults() as $dados) {
		echo 'Mês ' . $dados . ': Novos Usuários:' . $dados->getNewUsers() . '<br />';
	}

	echo '<br />';


	// Busca os pageviews e visitas de cada dia do último mês
	$ga->requestReportData($id, 'day', array('pageviews', 'visits'), 'day', null, $inicio, $fim, 1, 50);
	foreach ($ga->getResults() as $dados) {
		echo 'Dia ' . $dados . ': ' . $dados->getVisits() . ' Visita(s) e ' . $dados->getPageviews() . ' Pageview(s)<br />';
	}
?>