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
             <?php
                $erros = []; // Array para armazenar mensagens de erro
                $dados = []; // Array para armazenar os dados do formulário

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Coleta os dados do formulário
                    $dados = [
                        "nome_completo" => $_POST["nome_completo"],
                        "data_nascimento" => $_POST["data_nascimento"],
                        "sexo" => $_POST["sexo"],
                        "nome_materno" => $_POST["nome_materno"],
                        "cpf" => $_POST["cpf"],
                        "email" => $_POST["email"],
                        "telefone_celular" => $_POST["telefone_celular"],
                        "telefone_fixo" => $_POST["telefone_fixo"],
                        "endereco" => $_POST["endereco"],
                        "cep" => $_POST["cep"],
                        "complemento" => $_POST["complemento"],
                        "numero" => $_POST["numero"],
                        "uf" => $_POST["uf"],
                        "cidade" => $_POST["cidade"],
                        "bairro" => $_POST["bairro"],
                        "login" => $_POST["login"],
                        "senha" => $_POST["senha"],
                        "confirmar_senha" => $_POST["confirmar_senha"]
                    ];

                    //Funções de validação
                    function validarNome($nome) {
                        if(empty($nome) && empty($nomeMaterno)) return "O nome é obrigatório.";
                        if (strlen($nome) < 15 || strlen($nome) > 80) return "O nome deve conter entre 15 e 80 caracteres.";
                        if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/', $nome)) return "O nome deve conter apenas caracteres alfabéticos.";
                        return null;
                    }

                    function validarSexo($sexo) {
                        if ($sexo == "s") return "O campo sexo é obrigatório.";
                        return null;
                    }

                    function validarNomeMaterno($nomeMaterno) {
                        if(empty($nomeMaterno)) return "O nome materno é obrigatório.";
                        if (strlen($nomeMaterno) < 15 || strlen($nomeMaterno) > 80) return "O nome materno deve conter entre 15 e 80 caracteres.";
                        if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/', $nomeMaterno)) return "O nome materno deve conter apenas caracteres alfabéticos.";
                        return null;
                    }

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
                            return "CPF inválido, de acordo com o Segundo dígito verificador";
                        }
                        return null;
                    }

                    function validarEmail($email) {
                        if (empty($email)) return "O e-mail é obrigatório.";
                        if (!preg_match('/^[a-zA-Z0-9._%+-]+@(gmail|hotmail|outlook|yahoo)\.com$/', $email)) return "E-mail inválido.";
                        return null;
                    }
                    function validarCelular($celular) {
                        if (empty($celular)) return "O campo celular é obrigatório.";
                        if (!preg_match('/\(\+\d{2}\)\(\d{2}\)\d{5}-\d{4}$/', $celular)) return "O número de celular não está em um formato válido. Use o formato (+xx)(xx)xxxxx-xxxx.";
                        return null;
                    }

                    function validarFixo($telefone) {
                        if (empty($telefone)) return "O campo telefone é obrigatório.";
                        if (!preg_match('/\(\+\d{2}\)\(\d{2}\)\d{4}-\d{4}$/', $telefone)) return "O número de telefone não está em um formato válido. Use o formato (+xx)(xx)xxxx-xxxx.";
                        return null;
                    }

                    function validarEndereco($endereco){
                        if(empty($endereco)) return "Este campo é obrigatório";
                        return null;
                    }

                    function validarCep($cep) {
                        if (empty($cep)) return "O CEP é obrigatório.";
                        if (!preg_match('/^\d{5}-\d{3}$/', $cep)) return "O CEP deve estar no formato xxxxx-xxx.";

                    }


                    function validarNumero($numero){
                        if(empty($numero)) return "Este campo é obrigatório";
                        if(!preg_match('/^[0-9]+$/', $numero)) return "Este campo deve apenas conter caracteres numéricos.";
                        return null;
                    }
                     
                    function validarLogin($login){
                        if (empty($login)) return "O login é obrigatório.";
                        if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/', $login)) return "O login só pode conter apenas caracteres alfabéticos";
                        if (strlen($login) < 6 || strlen($login) > 6) return "O login deve conter exatamente 6 caracteres";
                        return null;
                    }
                    function validarSenha($senha,$confirmarSenha){
                        if (empty($senha)) return "A senha é obrigatória.";
                        if (!preg_match('/^[a-zA-Z\s]+$/', $senha)) return "A senha deve conter apenas caracteres alfabéticos";
                        if (strlen($senha) < 8) return "A senha deve conter no mínimo 8 caracteres";
                        if ($senha != $confirmarSenha) return "As senhas não são iguais";
                        return null;
                    }
                    function buscarCep($cep) {
                        $cep = preg_replace('/\D/', '', $cep); // Remove caracteres não numéricos
                        $url = "https://viacep.com.br/ws/{$cep}/json/";
                    
                        // Usando cURL para buscar os dados
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                    
                        if ($response) {
                            $dados = json_decode($response, true);
                            if (!isset($dados['erro'])) {
                                return [
                                    "cidade" => $dados["localidade"],
                                    "bairro" => $dados["bairro"],
                                    "uf" => $dados["uf"],
                                    "endereco" => $dados["logradouro"]
                                ];
                            } else {
                                return ["erro" => "CEP não encontrado."];
                            }
                        }
                        return ["erro" => "Erro ao acessar a API ViaCEP."];
                        
                    }

                    // Validando os campos e armazenando mensagens de erro
                    $erros["nome_completo"] = validarNome($dados["nome_completo"]);
                    $erros["sexo"] = validarSexo($dados["sexo"]);
                    $erros["nome_materno"] = validarNomeMaterno($dados["nome_materno"]);
                    $erros["cpf"] = validarCpf($dados["cpf"]);
                    $erros["email"] = validarEmail($dados["email"]);
                    $erros["telefone_celular"] = validarCelular($dados["telefone_celular"]);
                    $erros["telefone_fixo"] = validarFixo($dados["telefone_fixo"]);
                    $erros["cep"] = validarCep($dados["cep"]);
                    $erros["numero"] = validarNumero($dados["numero"]);
                    $erros["login"] = validarLogin($dados["login"]);
                    $erros["senha"] = validarSenha($dados["senha"], $dados["confirmar_senha"]);
                    // Se o CEP for válido, busca os dados da API

                    // Se não houver erros, exibe o modal de sucesso
                    if (empty(array_filter($erros))) {
                        echo "
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Exibe o modal
                                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                successModal.show();
                    
                                // Redireciona automaticamente após 5 segundos
                                setTimeout(function () {
                                    window.location.href = 'index.php';
                                }, 5000);
                    
                                // Cancela o redirecionamento automático se o modal for fechado manualmente
                                document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                                    window.location.href = 'index.php';
                                });
                            });
                        </script>";
                    }
                }
             ?>
            <form action="" method="POST" id="cadastro-form">
                <!-- Nome Completo -->
                <section class="mb-4">
                    <label for="nome_completo" class="form-label">Nome Completo:</label>
                    <p class="form-text">O campo deve ter no mínimo 15 e no máximo 80 caracteres alfabéticos.</p>
                    <input type="text" id="nome_completo" name="nome_completo" class="form-control" value="<?php echo htmlspecialchars($dados["nome_completo"] ?? '')?>" placeholder="Digite seu nome completo" required>
                    <p style="color: red;"><?php echo $erros["nome_completo"] ?? ""; ?></p>
                </section>
                
                <!-- Data de Nascimento e Sexo -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?php echo htmlspecialchars($dados["data_nascimento"] ?? '')?>" required>
                        <p style="color: red;"><?php echo $erros["data_nascimento"] ?? ""; ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sexo" class="form-label">Sexo:</label>
                        <select id="sexo" name="sexo" class="form-select" required>
                            <option value="s"<?php echo htmlspecialchars($dados['sexo'] ?? '') ?> name = "s">Selecione</option>
                            <option value="masculino" <?php echo htmlspecialchars($dados['sexo'] ?? '')?>  name = "masculino">Masculino</option>
                            <option value="feminino" <?php echo htmlspecialchars($dados['sexo'] ?? '')?> name = "feminino">Feminino</option>
                            <option value="outro" <?php echo htmlspecialchars($dados['sexo'] ?? '')?> name = "outro">Outro</option>
                        </select>
                        <p style="color: red;"><?php echo $erros["sexo"] ?? ""; ?></p>
                    </div>
                </section>

                <!-- Nome Materno -->
                <section class="mb-3">
                    <label for="nome_materno" class="form-label">Nome Materno:</label>
                    <input type="text" id="nome_materno" name="nome_materno" class="form-control" value="<?php echo htmlspecialchars($dados['nome_materno'] ?? '')?>" placeholder="Digite o nome da sua mãe" required>
                    <p style="color: red;"><?php echo $erros["nome_materno"] ?? ""; ?></p>
                </section>

                <!-- CPF -->
                <section class="mb-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" maxlength="14" value = "<?php echo htmlspecialchars($dados['cpf'] ?? '')?>"placeholder="000.000.000-00" required>
                    <P style="color: red;"><?php echo $erros["cpf"] ?? ''; ?></p>
                </section>

                <!-- E-mail -->
                <section class="mb-3">    
                <label for="email" class="form-label">E-mail:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($dados['email'] ?? '')?>" placeholder="exemplo@email.com" required>
                    <p style="color: red;"><?php echo $erros["email"] ?? ""; ?></p>
                </section>

                <!-- Telefones -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefone_celular" class="form-label">Telefone Celular:</label>
                        <input type="tel" id="telefone_celular" name="telefone_celular" class="form-control" maxlength="22" value="<?php echo htmlspecialchars($dados['telefone_celular'] ?? '') ?>" placeholder="(+xx)(xx)xxxxx-xxxx" required>
                        <p style="color: red;"><?php echo $erros["telefone_celular"] ?? ""; ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefone_fixo" class="form-label">Telefone Fixo:</label>
                        <input type="tel" id="telefone_fixo" name="telefone_fixo" class="form-control" maxlength="22" value="<?php echo htmlspecialchars($dados['telefone_fixo'] ?? '') ?>" placeholder="(+xx)(xx)xxxx-xxxx" required>
                        <p style="color: red;"><?php echo $erros["telefone_fixo"] ?? ""; ?></p>
                    </div>
                </section>

                <!-- Endereço e CEP -->
                <section class="row">
                    <div class="col-md-8 mb-3">
                        <label for="endereco" class="form-label">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="form-control" value="<?php echo htmlspecialchars($dados['endereco'] ?? '') ?>" placeholder="Digite seu endereço" required>
                        <p style="color: red;"><?php echo $erros["endereco"] ?? ""; ?></p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label">CEP:</label>
                        <input type="text" id="cep" name="cep" class="form-control" maxlength="9" value="<?php echo htmlspecialchars($dados ['cep'] ?? '') ?>" oninput="buscarCep()" placeholder="00000-000" required>
                        <p style="color: red;"><?php echo $erros["cep"] ?? ""; ?></p>
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
                        <input type="text" id="numero" name="numero" class="form-control" value="<?php echo htmlspecialchars($dados['numero'] ?? '') ?>" placeholder="Nº" required>
                        <p style="color: red;"><?php echo $erros["numero"] ?? ""; ?></p>
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
                        <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo htmlspecialchars($dados ['cidade'] ?? '') ?>" placeholder="Digite sua cidade" required>
                        <p style="color: red;"><?php echo $erros["cidade"] ?? ""; ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo htmlspecialchars($dados['bairro'] ?? '') ?>" placeholder="Digite seu bairro" required>
                        <p style="color: red;"><?php echo $erros["bairro"] ?? ""; ?></p>
                    </div>
                </section>

                <!-- Login -->
                <section class="mb-3">
                    <label for="login" class="form-label">Login:</label>
                    <p class="form-text">Máximo de 6 caracteres alfabéticos.</p>
                    <input type="text" id="login" name="login" class="form-control" value="<?php echo htmlspecialchars($dados['login'] ?? '') ?>" placeholder="Digite seu login" required>
                    <p style="color: red;"><?php echo $erros["login"] ?? ""; ?></p>
                </section>

                <!-- Senhas -->
                <section class="row">
                    <div class="col-md-6 mb-3">
                        <label for="senha" class="form-label">Insira uma senha:</label>
                        <p class="form-text">Máximo de 8 caracteres alfabéticos.</p>
                        <input type="password" id="senha" name="senha" class="form-control" value="<?php echo htmlspecialchars($dados['senha'] ?? '') ?>" placeholder="Digite sua senha" required>
                        <p style="color: red;"><?php echo $erros["senha"] ?? ""; ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar senha:</label>
                        <p class="form-text">Máximo de 8 caracteres alfabéticos.</p>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" value="<?php echo htmlspecialchars($dados['confirmar_senha'] ?? '') ?>" placeholder="Confirme sua senha" required>
                        <p style="color: red;"><?php echo $erros["confirmar_senha"] ?? ""; ?></p>
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

    <!-- Modal de Cadastro Realizado -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 py-2">
                <!-- Botão de Fechar no canto superior direito -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Fechar"></button>
                <!-- Conteúdo do Modal -->
                <div class="modal-body text-center">
                    <h2 class="modal-title fs-3 text-success" id="successModalLabel">Cadastro Realizado</h2>
                    <p class="fs-5 mt-3">Seu cadastro foi concluído com sucesso!</p>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        let timeout = null; // Variável para controlar o tempo de espera antes da requisição

        function buscarCep() {
            clearTimeout(timeout); // Limpa o timeout anterior para evitar múltiplas chamadas

            timeout = setTimeout(async () => {
                let cep = document.getElementById("cep").value.replace(/\D/g, ''); // Remove caracteres não numéricos

                if (cep.length === 8) { // Confirma que o CEP tem 8 números
                    try {
                        let response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                        if (!response.ok) throw new Error("Erro na requisição");

                        let data = await response.json();

                        if (!data.erro) {
                            document.getElementById("cidade").value = data.localidade || "";
                            document.getElementById("bairro").value = data.bairro || "";
                            document.getElementById("uf").value = data.uf || "";
                            document.getElementById("endereco").value = data.logradouro || "";
                        } else {
                            console.warn("CEP não encontrado.");
                        }
                    } catch (error) {
                        console.error("Erro ao buscar CEP:", error);
                    }
                }
            }, 100); // Aguarda 500ms antes de fazer a requisição para evitar chamadas excessivas
        }
    </script>
    <script src="https://unpkg.com/imask"></script>
    <script src="js/mascara.js"></script>      
    <script>src="js/viacep.js"</script>
</body>
</html>