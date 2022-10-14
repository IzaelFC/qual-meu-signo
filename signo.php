<?php
echo '<link rel="stylesheet" href="style.css">';
$data = $_POST['data']; //Pega o valor do input do formulário

$date = new DateTime($data);
$date = $date -> format('d/m'); //Pega apenas o dia e o mes


function separaDia($date){
	$dia = substr($date, 0, 2); // Pega o dia do formato data (DIA<-/mes)
    return $dia;
}


function separaMes($date){
    $mes = substr($date, 3, 2); // Pega o mes do formato data (dia/->MES)
    return $mes;
}


function nomeSigno($dia, $mes){
    $xml = simplexml_load_file('signos.xml');

    foreach($xml->signo as $signo){
		
        //Armazena em variaveis os valores das datas inicio e fim do XML
        $data_inicio = ($signo->dataInicio);
        $data_fim = ($signo->dataFim);
        
        //Separa da primeira data
        $dia1 = separaDia($data_inicio);
        $mes1 = separaMes($data_inicio);
        
        //Separa da segunda data
        $dia2 = separaDia($data_fim);
        $mes2 = separaMes($data_fim);
    
        //Faz a comparação das datas para pegar o valor correspondente e escrever na página
        if($mes == $mes1 && $dia >= $dia1 || $mes == $mes2 && $dia <= $dia2){
	    echo '<title>' . $signo->signoNome . '</title>';
            echo '<div class="page">';
            
            echo '<h1>Seu signo é: ' . $signo->signoNome . '</h1>';

            echo '<p>' . $signo->signoNome . ' (' . $signo->dataInicio . ' a ' . $signo->dataFim . ')</p><br>';
            
            echo '<p><span>Descrição:</span> ' . $signo->descricao . '</p>' . '<br>';
            echo '<a href="index.html"><button>Voltar</button></a>';

            echo '</div>';
        }
    }
}

//Chamada da função passando como parametro o dia e o mes ja separado
nomeSigno(separaDia($date), separaMes($date));
