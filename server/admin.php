<?php
include 'database.php';

$nomeLocal = isset($_POST['nome']) ? $_POST['nome'] : null;
$desc = isset($_POST['desc']) ? $_POST['desc'] : null;
$tel = isset($_POST['tel']) ? $_POST['tel'] : null;
$pa = isset($_POST['pa']) ? $_POST['pa'] : null;
$pc = isset($_POST['pc']) ? $_POST['pc'] : null;
$pi = isset($_POST['pi']) ? $_POST['pi'] : null;
$ri = isset($_POST['ri']) ? $_POST['ri'] : null;
if (empty($nomeLocal) || empty($desc) || empty($tel) || empty($pa) || empty($pc) || empty($pi) || empty($ri))
{
    echo "Volte e preencha todos os campos";
    exit;
}
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = 'imagens / ' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            // echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />'
            $sql = "INSERT INTO locais(nome, descricao, img, telefone, precoAdulto, precoCrianca, precoIdoso, restricao) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $res = $stmt->execute([ $nomeLocal, $desc, $destino, $tel, $pa, $pc, $pi, $ri ]);
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';