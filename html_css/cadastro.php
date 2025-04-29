<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Starplay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="formulario.css">
</head>
<body id="cadastro">

    <!-- Cabeçalho -->
    <header>
        <img src="img/logo-pp2.png" alt="Logo">
        <h1>Start Play</h1>
        <a href="#"></a>
        <nav>
            <a href="index.php">Home</a>
            <a href="card.php">Games</a>
            <a href="videogame.php">Consoles</a>
        </nav>
        <form class="search-bar">
          <input type="text" placeholder="Pesquisar..." />
          <button type="submit" aria-label="Pesquisar"></button>
      </form>
      <div class="auth-buttons">
        <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Entrar</button>
        <button onclick="location.href='cadastro.html'">Cadastro</button>
    </div>
    </header>

    <main>
        <!-- Formulário -->
        <section class="container">
            <!-- Cabeçalho do formulário -->
            <div class="form-header">
                <div class="form-header-top">
                    <img src="img/logo-pp2.png" alt="Logo Startplay">
                    <h1>StartPlay</h1>
                </div>
                <div class="form-header2">
                    <h2>CADASTRO:</h2>
                    <p>Complete com seus dados para efetuar cadastro.</p>
                </div>
            </div>
            <!-- Formulário de cadastro -->
            <form action="" method="POST" id="cadastro-form">
                <!-- Nome Completo -->
                <section class="mb-4">
                    <label for="nome_completo" class="form-label">Nome Completo:</label>
                    <p class="form-text">O campo deve ter no mínimo 15 e no máximo 80 caracteres alfabéticos.</p>
                    <input type="text" id="nome_completo" name="nome_completo" class="form-control" placeholder="Digite seu nome completo" required>
                    <?php
                        function validarNome($nome) {
                            $regexNome = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/'; 
                            if (strlen($nome) == 0) {
                                return "Este campo é obrigatório."; // Corrigido o acento.
                            }
                            if (!preg_match($regexNome, $nome)) {
                                return "O nome deve apenas conter caracteres alfabéticos.";
                            }
                            if (strlen($nome) < 15 || strlen($nome) > 80) {
                                return "O nome deve conter no mínimo 15 e no máximo 80 caracteres.";
                            }
                            return null; // Retorno null para indicar ausência de erros.
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $nome = $_POST['nome_completo'];

                            // Variável para acumular mensagens de erro
                            $mensagem = validarNome($nome);

                            // Exibir a mensagem de erro ou sucesso
                            if ($mensagem) {
                                echo '<p style="color: red;">' . $mensagem . '</p>'; // Mensagem de erro.
                            } else {
                                echo '<p style="color: #0d6efd;">O nome é válido!</p>'; // Mensagem de sucesso.
                            }
                        }
                    ?>
                </section>
                
                <!-- Data de Nascimento e Sexo -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $data_nascimento = $_POST['data_nascimento'];
                                
                                // Função para calcular idade
                                function calcularIdade($dataNascimento) {
                                    $dataAtual = new DateTime();
                                    $dataNascimento = new DateTime($dataNascimento);
                                    return $dataAtual->diff($dataNascimento)->y;
                                }

                                // Calcula idade e verifica
                                $idade = calcularIdade($data_nascimento);
                                if ($idade > 18 && $idade < 80) {
                                    echo '<p style="color: #0d6efd;>A idade é valida.</p>';
                                } elseif ($idade <= 18) {
                                    echo '<p class="text-danger">A idade é inválida, pois é menor de 18 anos.</p>';
                                } else {
                                    echo '<p class="text-warning">A idade é inválida, pois excede a idade de 80 anos.</p>';
                                }
                            }
                        ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sexo" class="form-label">Sexo:</label>
                        <select id="sexo" name="sexo" class="form-select" required>
                            <option value="S">Selecione</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                            <?php
                                function validarSexo($sexo){
                                if (($sexo != "masculino") && ($sexo != "feminino") && ($sexo != "outro")){
                                    return "Selecione um gênero";
                                }
                                if($sexo == "S"){
                                    return "Selecione um genêro";
                                }
                                return null;
                                }
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $sexo = $_POST['sexo'];

                                    // Variável para acumular mensagens de erro
                                    $mensagem = validarSexo($sexo);
                                    // Exibir as mensagens de erro, ou sucesso se estiver tudo correto
                                    if ($mensagem) {
                                        echo '<p style="color: red;">' . $mensagem . '</p>'; // Exibe todos os erros
                                    } else {
                                        echo '<p style="color: #0d6efd;">O gênero é válido!</p>'; // Mensagem de sucesso
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </section>

                <!-- Nome Materno -->
                <section class="mb-3">
                    <label for="nome_materno" class="form-label">Nome Materno:</label>
                    <input type="text" id="nome_materno" name="nome_materno" class="form-control" placeholder="Digite o nome da sua mãe" required>
                    <?php
                        function validarNomeMaterno ($nomeMaterno){
                            $regexNome = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/';
                            if(strlen($nomeMaterno) == 0){
                                return "Este campo é obrigatótio.";
                            }
                            if (!preg_match($regexNome, $nomeMaterno)){
                                return "O nome materno deve apenas conter caracteres alfabéticos";
                                
                            }
                            if (strlen($nomeMaterno) < 15 or strlen($nomeMaterno) > 80){
                                return "O nome materno deve conter no mínimo 15 e no máximo 80 caracteres";
                            }
                            return null;
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $nomeMaterno = $_POST['nome_materno'];
                            
                            // Variável para acumular mensagens de erro
                            $mensagem = validarNome($nome);

                            // Exibir a mensagem de erro ou sucesso
                            if ($mensagem) {
                                echo '<p style="color: red;">' . $mensagem . '</p>'; // Mensagem de erro.
                            } else {
                                echo '<p style="color: #0d6efd;">O nome materno é válido!</p>'; // Mensagem de sucesso.
                            }
                        }
                    ?>
                </section>

                <!-- CPF -->
                <section class="mb-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" maxlength="14" placeholder="000.000.000-00" required>

                    <?php
                    function validarCpf($cpf) {
                        if (!preg_match('/^(?:[0-9]{3}\.){2}(?:[0-9]{3}\-)(?:[0-9]{2})$/', $cpf)){
                            return "CPF inválido. Utilize o formato de digitação xxx.xxx.xxx-xx";
                        }
                        $cpf = preg_replace('/[\.\-]/', '', $cpf);
                    
                        //Primeiro dígito verificador
                        $soma = 0;
                        $soma += $cpf[0] * 10;
                        $soma += $cpf[1] * 9;
                        $soma += $cpf[2] * 8;
                        $soma += $cpf[3] * 7;
                        $soma += $cpf[4] * 6;
                        $soma += $cpf[5] * 5;
                        $soma += $cpf[6] * 4;
                        $soma += $cpf[7] * 3;
                        $soma += $cpf[8] * 2;
                        $soma = ($soma * 10) % 11;
                        if ($soma == 10 || $soma == 11) {
                            $soma = 0;
                        }
                        if ($soma != $cpf[9]) {
                            return "CPF inválido, de acordo com o Primeiro dígito verificador";
                        }
                        //Segundo dígito verificador
                        $soma = 0;
                        $soma += $cpf[0] * 11;
                        $soma += $cpf[1] * 10;
                        $soma += $cpf[2] * 9;
                        $soma += $cpf[3] * 8;
                        $soma += $cpf[4] * 7;
                        $soma += $cpf[5] * 6;
                        $soma += $cpf[6] * 5;
                        $soma += $cpf[7] * 4;
                        $soma += $cpf[8] * 3;
                        $soma += $cpf[9] * 2;
                        $soma = ($soma * 10) % 11;
                        if ($soma == 10 || $soma == 11) {
                            $soma = 0;
                        }
                        if ($soma != $cpf[10]) {
                            return "CPF invalido, de acordo com o Segundo dígito verificador";
                        }
                        return null;
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $cpf = $_POST['cpf'];

                        // Variável para acumular mensagens de erro
                        $mensagem = validarCpf($cpf);

                        // Exibir a mensagem de erro ou sucesso
                        if ($mensagem) {
                            echo '<p style="color: red;">' . $mensagem . '</p>'; // Mensagem de erro.
                        } else {
                            echo '<p style="color: #0d6efd;">O CPF é válido!</p>'; // Mensagem de sucesso.
                        }
                    }
                ?>
                </section>

                <!-- E-mail -->
                <section class="mb-3">    
                <label for="email" class="form-label">E-mail:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@email.com" required>
                    <?php
                        function validarEmail($email) {
                            $regex = "/^[a-zA-Z0-9._-]+@(gmail|hotmail|outlook|yahoo)\.com$/";
                            if (empty($email)){
                                return "O email é obrigatótio";
                            }
                            
                            if(!preg_match($regex, $email)){
                                return "O email deve ser preechido corretamente";
                            }
                            return null;
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $email = $_POST['email'];
                            // Variável para acumular mensagens de erro
                            $mensagem = validarEmail($email);

                            // Exibir a mensagem de erro ou sucesso
                            if ($mensagem) {
                                echo '<p style="color: red;">' . $mensagem . '</p>'; // Mensagem de erro.
                            } else {
                                echo '<p style="color: #0d6efd;">O Email é válido!</p>'; // Mensagem de sucesso.
                            }
                        }

                    ?>
                </section>

                <!-- Telefones -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefone_celular" class="form-label">Telefone Celular:</label>
                        <input type="tel" id="telefone_celular" name="telefone_celular" class="form-control" maxlength="17" placeholder="(+55)XX-XXXXXXXXX" required>
                        <?php
                            function validarCelular($celular) {
                                $regexCelular = '/^\(\+55\) \d{2}-\d{9}$/'; //Regex para Formatação (+55) xx-xxxxxxxxx

                                if (empty($celular)) {
                                    return "O campo celular é obrigatório.";
                                }
                                if (!preg_match($regexCelular, $celular)) {
                                    return "O número de celular não está em um formato válido. Use o formato (+55) xx-xxxxxxxxx.";
                                }
                                return null;
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $celular = $_POST['telefone_celular'];
                                // Variável para acumular mensagens de erro
                                $mensagem = validarCelular($celular);

                                // Exibir a mensagem de erro ou sucesso
                                if ($mensagem) {
                                    echo '<p style="color: red;">' . $mensagem . '</p>'; // Mensagem de erro.
                                } else {
                                    echo '<p style="color: #0d6efd;">O CPF é válido!</p>'; // Mensagem de sucesso.
                                }
                            }
                        ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefone_fixo" class="form-label">Telefone Fixo:</label>
                        <input type="tel" id="telefone_fixo" name="telefone_fixo" class="form-control" maxlength="16" placeholder="(+55)XX-XXXXXXXXX" required>
                        <?php
                            function validarFixo($telefone) {
                                $regexTelefone = '/^\(\+55\) \d{2}-\d{8}$/'; //Regex para Formatação (+55) xx-xxxxxxxx

                                if (empty($telefone)) {
                                    return "O campo telefone é obrigatório.";
                                }
                                if (!preg_match($regexTelefone, $telefone)) {
                                    return "O número de telefone não está em um formato válido. Use o formato (+55) xx-xxxxxxxx.";
                                }
                                return null;
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $telefone = $_POST['telefone_fixo'];
                                
                                // Variável para acumular mensagens de erro
                                $mensagem = validarFixo($telefone);

                                // Exibir a mensagem de erro ou sucesso
                                if ($mensagem) {
                                    echo '<p style="color: red;">' . $mensagem . '</p>'; // Mensagem de erro.
                                } else {
                                    echo '<p style="color: #0d6efd;">O CPF é válido!</p>'; // Mensagem de sucesso.
                                }
                            }
                    ?>
                    </div>
                </section>

                <!-- Endereço e CEP -->
                <section class="row">
                    <div class="col-md-8 mb-3">
                        <label for="endereco" class="form-label">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Digite seu endereço" required>
                        <?php
                            function validarEndereco($endereco){
                                if(empty($endereco)){
                                    return "Este campo é obrigatório";
                                }
                                if(strlen($endereco) > 20){
                                    return "Endereço Inválido";
                                }
                                return null;
                            }
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $endereco = $_POST['endereco'];
                                    
                                    // Variável para acumular mensagens de erro
                                    $mensagem = validarEndereco($endereco);

                                    // Exibir a mensagem de erro ou sucesso
                                    if ($mensagem){
                                        echo '<p style="color: red;">'. $mensagem .'</p>';
                                    }else{
                                        echo '<p style="color: #0d6efd;">O Endereço é válido!</p>';
                                    }
                                }
                        ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label">CEP:</label>
                        <input type="text" id="cep" name="cep" class="form-control" maxlength="9" placeholder="00000-000" required>
                        <?php
                            function validarCep($cep){
                                $regexCep = '/^\d{5}-\d{3}$/';
                                if (empty($cep)) {
                                    return "O campo CEP é obrigatório.";
                                }
                                if (!preg_match($regexCep, $cep)) {
                                    return "O CEP não está em um formato válido. Use o formato xxxxx-xxx.";
                                }
                                return null;
                            }
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $cep = $_POST['cep'];

                                // Variável para acumular mensagens de erro
                                $mensagem = validarCep($cep);

                                // Exibir a mensagem de erro ou sucesso
                                if ($mensagem) {
                                    echo '<p style="color: red;">' . $mensagem . '</p>'; //Mensagem de erro.
                                } else {
                                    echo '<p style="color: #0d6efd;">O CEP é válido!</p>'; // Mensagem de sucesso.
                                }
                            }
                        ?>
                    </div>
                </section>

                <!-- Complemento -->
                <section class="row">
                    <div class="col-md-12 mb-3">
                        <label for="complemento" class="form-label">Complemento:</label>
                        <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Apto, Bloco, etc.">
                    </div>
                </section>

                <!-- Número e UF -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="numero" class="form-label">Número:</label>
                        <input type="text" id="numero" name="numero" class="form-control" placeholder="Nº" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="uf" class="form-label">UF:</label>
                        <select id="uf" name="uf" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
                </section>

                <!-- Cidade e Bairro -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Digite sua cidade" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Digite seu bairro" required>
                    </div>
                </section>

                <!-- Login -->
                <section class="mb-3">
                    <label for="login" class="form-label">Login:</label>
                    <p class="form-text">Máximo de 6 caracteres alfabéticos.</p>
                    <input type="text" id="login" name="login" class="form-control" placeholder="Digite seu login" required>
                    <?php
                        function validarLogin($login){
                            $regexLogin = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/';
        
                            if (!preg_match($regexLogin, $login)){
                                return "O login só pode conter apenas caracteres alfabéticos";
                            }
                            if (strlen($login) < 6 || strlen($login) > 6){
                                return "O login deve conter exatamente 6 caracteres";
                            }
                            return null;
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $login = $_POST['login'];

                            // Variável para acumular mensagens de erro
                            $mensagem = validarLogin($login);
                            
                            // Exibir as mensagens de erro, ou sucesso se estiver tudo correto
                            if ($mensagem) {
                                echo '<p style="color: red;">' . $mensagem . '</p>'; // Exibe todos os erros
                            } else {
                                echo '<p style="color: #0d6efd;">O login é válido!</p>'; // Mensagem de sucesso
                            }
                        }
                    ?>
                </section>

                <!-- Senhas -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="senha" class="form-label">Insira uma senha:</label>
                        <p class="form-text">Máximo de 8 caracteres alfabéticos.</p>
                        <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
                        <?php 
                            function validarSenha($senha){
                                $regexSenha = '/^[a-zA-Z\s]+$/';

                                if (!preg_match($regexSenha, $senha)){
                                    return "A senha deve conter apenas caracteres alfabéticos";
                                }
                                if (strlen($senha) < 8){
                                    return "A senha deve conter no mínimo 8 caracteres";
                                }
                                return null;
                            }
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $senha = $_POST['senha'];

                                // Variável para acumular mensagens de erro
                                $mensagem= validarSenha($senha);

                                // Exibir as mensagens de erro, ou sucesso se estiver tudo correto
                                if ($mensagem) {
                                    echo '<p style="color: red;">' . $mensagem . '</p>'; // Exibe todos os erros
                                } else {
                                    echo '<p style="color: #0d6efd;">Senha validada!</p>'; // Mensagem de sucesso
                                }
                            }
                        ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar senha:</label>
                        <p class="form-text">Máximo de 8 caracteres alfabéticos.</p>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" placeholder="Confirme sua senha" required>
                        <?php
                            function confirmarSenha($senha, $confirmarSenha){
                                if($senha != $confirmarSenha){
                                    return "As senhas não são iguais";
                                }
                                return null;
                            }
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $confirmarSenha = $_POST['confirmar_senha'];

                                // Variável para acumular mensagens de erro
                                $mensagem = confirmarSenha($senha, $confirmarSenha);

                                // Exibir as mensagens de erro, ou sucesso se estiver tudo correto
                                if ($mensagem) {
                                    echo '<p style="color: red;">'. $mensagem. '</p>'; // Exibe todos os erros
                                } else {
                                    echo '<p style="color: #0d6efd;">As senhas são iguais!</p>'; // Mensagem de sucesso
                                }
                            }
                        ?>
                    
                    </div>
                </section>

                <!-- Botões -->
                <footer class="form-actions mt-4">
                    <button type="reset" class="btn btn-outline-secondary w-100 mt-2">Limpar</button>
                    <button type="submit" class="btn btn-outline-primary w-100 mt-2">Enviar</button>
                </footer>
            </form>
        </section>
    </main>

    <!-- Modal 1: Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 py-1">
                <!-- Botão de Fechar no canto superior direito -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Fechar"></button>
                <!-- Imagem e texto no topo do modal -->
                <div class="d-flex align-items-center justify-content-center mt-3 mb-3">
                    <img src="img/logo-pp2.png" alt="Logo Startplay" style="max-width: 40px; margin-right: 10px;">
                    <h1 class="fs-5 mb-0">StartPlay</h1>
                </div>
                <!-- Título do modal -->
                <h2 class="modal-title fs-2 text-center mt-3" id="loginModalLabel">Login</h2>
                <p class="text-center fs-6">Complete com os seus dados para efetuar o login.</p>
                <div class="modal-body">
                    <!-- Formulário de Login -->
                    <form id="login-form">
                      <div class="mb-3">
                          <label for="email" class="form-label">E-mail:</label>
                          <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
                      </div>
                      <div class="mb-3">
                          <label for="password" class="form-label">Senha:</label>
                          <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                      </div>
                      <div class="mb-3">
                          <label for="confirm-password" class="form-label">Confirmar Senha:</label>
                          <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Confirme sua senha" required>
                      </div>
                      <div class="form-actions mt-4 d-flex justify-content-between">
                          <button type="reset" class="btn btn-outline-secondary w-50"style="margin-right: 20px;">Limpar</button>
                          <button type="button" class="btn btn-outline-primary w-50" data-bs-target="#passwordModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                              Entrar
                          </button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <p class="mb-1 fs-6">Não tem uma conta? <a href="cadastro.php" class="text-primary">Cadastre-se aqui.</a></p>
                    <p class="mb-1 fs-6">Esqueceu a Senha? <a href="#" class="text-primary">Mudar aqui.</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: Segundo Fator de Autenticação -->
    <div class="modal fade" id="secondFactorModal" tabindex="-1" aria-labelledby="secondFactorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-4 py-1">
            <!-- Botão de Fechar no canto superior direito -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Fechar"></button>
            <!-- Imagem e texto no topo do modal -->
            <div class="d-flex align-items-center justify-content-center mt-3 mb-3">
              <img src="img/logo-pp2.png" alt="Logo Startplay" style="max-width: 40px; margin-right: 10px;">
              <h1 class="fs-5 mb-0">StartPlay</h1>
            </div>
            <!-- Título do modal -->
            <h2 class="modal-title fs-3 text-center mt-3" id="secondFactorModalLabel">Segundo Fator de <br> Autenticação</h2>
            <p class="text-center fs-6 mb-3">Responda à pergunta de segurança para continuar.</p>
            <div class="modal-body">
              <!-- Pergunta de Segurança -->
              <form id="second-factor-form" >
                <div class="mb-3">
                  <label for="security-answer" class="form-label">Qual o nome da sua mãe?</label>
                  <input type="text" id="security-answer" name="security-answer" class="form-control" placeholder="Digite a resposta" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary w-75 mt-3">Enviar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
          const loginForm = document.getElementById("login-form");
          const loginSubmitButton = document.getElementById("login-submit");
          const secondFactorModal = new bootstrap.Modal(document.getElementById("secondFactorModal"));
      
          // Intercepta o envio do formulário de login
          loginForm.addEventListener("submit", function (event) {
          event.preventDefault(); // Impede o envio padrão do formulário
      
            // Simula o envio do formulário (aqui você pode adicionar lógica de validação ou envio para o servidor)
            console.log("Formulário de login enviado!");
      
            // Fecha o modal de login
            const loginModal = bootstrap.Modal.getInstance(document.getElementById("loginModal"));
            loginModal.hide();
      
            // Abre o modal de segundo fator de autenticação
            secondFactorModal.show();
          });
        });
    </script>
</body>
</html>