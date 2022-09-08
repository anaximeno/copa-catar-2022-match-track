# Copa Catar 2022 Match Track
Aplicação fullstack estruturada a apresentar jogos da copa do mundo de futebol de 2022 em Catar.

## Como usar ?
Para testar a aplicação, os seguintes passos devem ser tomados:

1. Inicializar o servidor Laravel e a base de dados integrada com o docker:
```bash
docker compose up
```
2. Aguarde até ver uma mensagem semelhante no terminal:
```
[Note] /opt/bitnami/mariadb/sbin/mysqld: ready for connections.
```
3. Fazer os seed dos dados para teste na base de dados:
```bash
docker compose exec myapp php artisan db:seed
```
3. Executar a aplicação Flutter, com os seguintes comandos:
```bash
cd flutter_frontend
flutter run --no-sound-null-safety
```
4. Testar a aplicação
5. Pronto

### Notas
**Nota 1**: O segundo passo não tem a necessidade de ser feito toda vez que se deseje testar a aplicação, desde que os containers criados inicialmente estejam preservados. O primeiro seed (caso ocorrer com sucesso) será suficiente para testar a aplicação.

**Nota 2**: A aplicação em flutter tem todas as plataformas atualmente suportadas pela framework ativadas, então, pode ser testada em todas elas.

## Imagens
<img src="imagens/gui-example-image-01.png" alt="Example GUI image 01"/>


<img src="imagens/gui-example-image-02.png" alt="Example GUI image 02"/>

