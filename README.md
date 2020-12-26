## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Usar a Lib https://botman.io/ para conversa
## TASKS
- [X] Trazer QR CODE
- [X] CreateOrUpdate de Contatos via QR CODE

- [] Aplicar Repository Patter com todas as querys lá
- [] Talvez aplicar uma camada de serviços com a logica de negocio 

- [] Botão para ligar/desligar sessão
- [] Mostrar Infos da sessão, colocar o ID do user no nome da sessão
- [] Sistema de Recorrencuia para o envio de mensagens
- [] Aplicar o pacote image cache do laravel para ter as imagens redimensionadas
- [] Passar um filtro de, deseja importar todos que tem conversa, ou só os que tem como contato
- [] Adicionar Contato Manualmente
- [] Trats para ordenar os dados
- [] Mascara de input para o telefone e salvar ele sempre sem formatação e sem espaço
- [] Criar Grupos com contatos

- [] Tela de login com login/register/Usar Wpp 
- [] Usar Wpp vai receber um link com token após digitar o numero, e salvar oq for possivel desse numero


# Interação entre os dados 
É criado uma sessão na rota http://localhost:3000/api/start?sessionName=session_userId 
com o sessionName sendo o session_userId


# O node vai chamar API do laravel que atualizam o socket
## Socket
É criado um Event que instancia um model para ser escutado no Listeners




