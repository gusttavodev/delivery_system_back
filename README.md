## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Usar a Lib https://botman.io/ para conversa
## TASKS
- [X] Trazer QR CODE
- [X] CreateOrUpdate de Contatos via QR CODE

- [] Aplicar Repository Patter com todas as querys lá
- [] Talvez aplicar uma camada de serviços com a logica de negocio 

- [x] Botão para ligar/desligar sessão
- [x] Mostrar Infos da sessão, colocar o ID do user no nome da sessão
- [] Sistema de Recorrencia para o envio de mensagens
- [] Aplicar o pacote image cache do laravel para ter as imagens redimensionadas
- [] Passar um filtro de, deseja importar todos que tem conversa, ou só os que tem como contato
- [] Adicionar Contato Manualmente
- [] Trats para ordenar os dados
- [] Mascara de input para o telefone e salvar ele sempre sem formatação e sem espaço
- [] Criar Grupos com contatos

- [] Tela de login com login/register/Usar Wpp 
- [] Usar Wpp vai receber um link com token após digitar o numero, e salvar oq for possivel desse numero
- [X] Tratar quando a sessão for removida do celular, ela deve ser iniciada novamente sem salvar outra no banco
- [] Criar um componente de layout, que fica em todas telas do sistema escutando echo, e mostrando alerts para cada mudançã na sessão
- [] Quando uma sessão é encerrada, ela precisa ser iniciada novamente para o QR code funcionar, então ao encerrar a sessão preciso salvar o status e não mostrar o QR code
- [] Tratar a modal do QR code para os momentos onde não tem sessão ou ela foi encerrada
- [] Desconectar socket ao scanear o QR code

# Melhorias
- [] Fazer uma Rule que proucura se o estabelecimento é desse user ou o user é admin caso não retorna 404/403 caso sim adiciona o estabelecimento na request(EstablishmentAddressCreateRequest)
- [] Tratar e instanciar os parametros na request
- [] Criar uma Exception Para esse caso
- [] Remover Imports não usados VueJs
- [] Adicionar uma camada de serviços
- [] Adicionar acrecimos, onde cada produto vai ter um select de acrescimos Acrecimos tem preço ou não, Nome e quantidade limite
- [] Remover ç e acentos do link publico do estabellecimento
- [] Ajustar todas as imagens com image cache do laravel pacote
- [] Configurar ou desabilitar as cores do gradiente, possibilidade de não ter background


# Interação entre os dados 
É criado uma sessão na rota http://localhost:3000/api/start?sessionName=session_userId 
com o sessionName sendo o session_userId


# O node vai chamar API do laravel que atualizam o socket
## Web Socket Usando Laravel Echo Server
Gerar chave laravel-echo-server client:add APP_ID
Rota para listar canais
- http://localhost:6001/apps/APP_ID/channels?auth_key=59bc350e4dd056580a4a269e1a98fb5b



## Componentes TailorWind
- Cardapio https://tailwindcomponents.com/component/list


## Fluxo de pedido
- Bot vai ser só para confirmar o pedido/Mandar mensagem agendada com o link para pedido web

## APIs Públicas
https://postmon.com.br/ ZIPCODE SEARCH
Lib CEP Canducci\Cep\Facades\Cep

## Manter valores do form(Importate para telas de update)
Colocar resetOnSuccess: false no form, caso seja true ele atualiza a tela porem n chama o mount do vue, nem puxa os dados novamente
