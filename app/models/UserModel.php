    <?php
class UserModel
{

    public static function loginUsuario($dadosLogin)
    {
        require "../config/conexao.php";
        session_start();

        $sql = "SELECT * FROM tbusuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dadosLogin['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            if ($dadosLogin['password'] == $usuario['senha']) {
                $_SESSION['cod'] = $usuario['cod'];
                $_SESSION['perfil'] = $usuario['perfil'];
                $_SESSION['login'] = true;
                $_SESSION['nome'] = $usuario['nome'];
 
                return [
                    'status' => true,
                    'message' => 'Login realizado com sucesso.',
                    'usuario' => $usuario,
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Usuário ou senha incorreta.',
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Usuário ou senha incorreta.',
            ];
        }

        $conn->close();
    }
}