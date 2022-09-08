import 'package:flutter/material.dart';

const descriptionText = """
Aplicação fullstack estruturada a apresentar jogos da copa do mundo de futebol de 2022 em Catar.

O frontend é feito completamente usando a framework Flutter com a linguagem de programação Dart, e o backend
usando o framework Laravel para a linguagem de programação PHP.

Caso aparecer a mensagem 'Connection Refused' nas outras secções, veja o ponto 2 da secção Como Usar do README na raíz do projeto.
Após isso faça um Hot restart da aplicação.
""";

const version = '0.9.0';

const author = 'Anaxímeno Brito';

class ViewSobre extends StatelessWidget {
  final double generalWidth;

  const ViewSobre({super.key, this.generalWidth = 1000});

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Center(
        child: SizedBox(
          width: generalWidth,
          child: Container(
            margin: const EdgeInsets.only(top: 10),
            child: Column(
              children: [
                Text(
                  'Match Tracker',
                  style: Theme.of(context).textTheme.headline4,
                ),
                Text(
                  'Versão $version',
                  style: Theme.of(context).textTheme.bodySmall,
                ),
                Container(
                  margin: const EdgeInsets.only(top: 40, bottom: 40),
                  child: Text(
                    descriptionText,
                    style: Theme.of(context).textTheme.headline6,
                    textAlign: TextAlign.center,
                  ),
                ),
                Text(
                  '2022 - $author',
                  style: Theme.of(context).textTheme.bodySmall,
                )
              ],
            ),
          ),
        ),
      ),
    );
  }
}
