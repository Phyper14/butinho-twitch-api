# Comando Followage :timer_clock:

O comando Followage é usado para retornar o tempo em que um espectador está seguindo o canal da live.

## Como Usar

1. Primeiro crie um comando no seu bot com o nome que desejar.
2. Adicione a url https://butinho-twitch-api.herokuapp.com/?function ao comando.
3. Adicionar a função followage na url: https://butinho-twitch-api.herokuapp.com/?function=followage
4. Passar os parâmetros do bot na url: https://butinho-twitch-api.herokuapp.com/?function=followage/variavel_canal/variavel_usuario

## Exemplo no Nightbot

$(urlfetch https://butinho-twitch-api.herokuapp.com/?function=followage/$(channel)/$(user))

